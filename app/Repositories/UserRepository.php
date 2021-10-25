<?php namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Validation\RegisterValidation;
use App\Http\Validation\UpdateValidation;
use App\Http\Validation\LoginValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\NewUserRegistered;

class UserRepository implements UserRepositoryInterface
{

    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    /* ************************************************REGISTER ************************************************* */
    public function register(Request $request, RegisterValidation $validation)
    {
        $validator= Validator::make($request->all(), $validation->rules(), $validation->messages());

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 401);
        }
     
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email'); 
            $user->password = bcrypt($request->input('password')); 
            $user->api_token = Str::random(60); 
            $user->is_admin = 0;  
            $user->save(); 
            event(new NewUserRegistered($user)); 
            return response()->json([
                'message' => 'creation de l\'utilisateur reussi',
                'error' => false,
                'data' => $user
            ]);
             
    }

    /* ************************************************UPDATE ************************************************* */
    public function update(Request $request, $id, UpdateValidation $validation)
    {
        $validator= Validator::make($request->all(), $validation->rules(), $validation->messages());

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 401);
        }
        try{
        $user = User::findOrFail($id);
        $user->update([
                        'name' => $request->name,
                        'password' => bcrypt($request->password)
                      ]);
            return $this->success("Compte modifié", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /* ************************************************LOGIN ******************************************************* */
    public function login(Request $request, LoginValidation $validation)
    {
        $validator= Validator::make($request->all(), $validation->rules(), $validation->messages());

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 401);
        }

        if(Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')])){
            $user = User::where('email', $request->input('email'))->firstOrFail();
            return response()->json($user);
        }else{
            return response()->json(['errors' =>'bad_credentials'], 401);        
        }
    }

    /* **************************INDEX User ********************** */
    public function index()
    {
        try{
            $user = User::all();
            return $this->success("Utilisateurs affichés", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }

    /* **************************SHOW User ********************** */
    public function show($id)
    {
        try{
            $user = DB::table('users')->select('users.name as userName', 'users.id as userId', 'users.is_admin as userAdmin', 'users.email as userEmail')
            ->where('users.api_token', '=', $id)
            ->get();
            $row[]=$user;
            return $this->success("Utilisateurs affichés", $row);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }
}