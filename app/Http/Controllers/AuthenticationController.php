<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Validation\RegisterValidation;
use App\Http\Validation\LoginValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{

/* ************************************************REGISTER ************************************************* */
    public function register(Request $request, RegisterValidation $validation){
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

            return response()->json([         
                "message" => "creation de l'utilisateur reussi",         
                 "data"=> $user        
            ], 201); 
    }


/* ************************************************UPDATE ************************************************* */

    public function update(Request $request, User $user){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'

            ]);
            if($validator->fails()){
            return $validator->errors();       
            }
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->save();
        return response()->json([
        "success" => true,
        "message" => "Account updated successfully.",
        "data" => $user
        ]);

    }
    public function userInfo() 
    {
 
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
 
    }
/* ************************************************LOGIN ******************************************************* */
    public function login(Request $request, LoginValidation $validation){
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

   function index(){
    $user = User::all();   
    return response()->json([    
   'message'=> 'Utilisateurs affichés',     
   'data'=> $user]);  
}

/* **************************SHOW User ********************** */
    public function show($id){

        $user = DB::table('users')->select('users.name as userName', 'users.id as userId', 'users.is_admin as userAdmin', 'teams.id as teamId', 'teams.name as teamName', 'teams.color as teamColor')
        ->join('teams', 'teams.user_id', '=', 'users.id')
        ->where('users.api_token', '=', $id)
        ->get();
        $row[]=$user;
        return response()->json([    
            'message'=> 'Utilisateurs affichées',     
            'data'=> $row]); 
    }

}
