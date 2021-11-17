<?php namespace App\Repositories;

use App\Interfaces\TeamRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Validation\TeamValidation;
use Illuminate\Support\Facades\Validator;
use App\Models\Teams;
use Illuminate\Support\Facades\Auth;
use App\Models\Colors;
use Illuminate\Support\Facades\DB;
use App\Events\MyEvent;
use App\Events\StatusLiked;
use App\Events\TeamEvent;
use App\Events\RandomEvent;

class TeamRepository implements TeamRepositoryInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    /* **************************INDEX COLOR ********************** */
    public function index()
    {

            $teams=Teams::all();
            event(new TeamEvent($teams));
            return response()->json([
                'message' => 'Equipes affichées',
                'error' => false,
                'data' => $teams
            ]);

    }

    /* **************************SHOW Teams ********************** */
    public function show($id)
    {
        try{
            $user = DB::table('users')->select('users.name as userName', 'users.id as userId', 'users.is_admin as userAdmin', 'teams.id as teamId', 'teams.name as teamName', 'teams.color as teamColor', 'teams.avatar as teamAvatar')
            ->join('teams', 'teams.user_id', '=', 'users.id')
            ->where('users.api_token', '=', $id)
            ->get();
            $row[]=$user;
            return $this->success("Utilisateurs et Equipes affichés", $row);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }

    /* **************************SHOW TEAM ********************** */
    public function store(Request $request, TeamValidation $validation, Colors $color)
    {    
        $validator= Validator::make($request->all(), $validation->rules(), $validation->messages());

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 401);
        }

        if($request->input('color')==="green"){$color=1;
        }elseif($request->input('color')==="red"){$color=2;
        }elseif($request->input('color')==="blue"){$color=3;
        }elseif($request->input('color')==="yellow"){$color=4;
        }else{$color=5;
        }
        try{
            $team=Teams::create([
                'name'=>$request->input('name'),
                'avatar'=>$request->input('avatar'),
                'color'=>$request->input('color'),
                'user_id'=>Auth::user()->id,
                'color_id'=>$color,  
                ]);
            return $this->success("Equipes crées", $team);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }     
    }

    /* **************************DELETE Teams ********************** */
    public function delete()
    {
        try{
            $team=DB::table('teams')->delete();
            return $this->success("Equipes supprimées", $team);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    } 

      /* *******************************RANDOM COLOR ************************ */
    public function showRandom(){
        try{
            $random=DB::table('teams')
            ->select('color')
            ->pluck('color')
            ->random(1);
            [$random_color]=$random;
            event(new RandomEvent($random_color));
            return $this->success("random color", $random_color);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }


}