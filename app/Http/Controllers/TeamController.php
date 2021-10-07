<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Validation\TeamValidation;
use Illuminate\Support\Facades\Validator;
use App\Models\Teams;
use Illuminate\Support\Facades\Auth;
use App\Models\Colors;

class TeamController extends Controller
{

    public function registerTeam(Request $request, TeamValidation $validation, Colors $color){
       
         $validator= Validator::make($request->all(), $validation->rules(), $validation->messages());

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 401);
        }

        if($request->input('color')==="green"){
            $color=1;
        }
        elseif($request->input('color')==="red"){
             $color=2;
         }
         elseif($request->input('color')==="blue"){
             $color=3;
         }
         elseif($request->input('color')==="yellow"){
             $color=4;
         }
         else{
             $color=5;
         }
        $team=Teams::create([
            'name'=>$request->input('name'),
            'avatar'=>$request->input('avatar'),
            'color'=>$request->input('color'),
            'user_id'=>Auth::user()->id,
            'color_id'=>$color,

            
        ]);
        return response()->json($team);
    }

    /* **************************SHOW TEAM ********************** */
    public function presentationTeam(){
        $teams=Teams::all();
        return response()->json($teams);
    }

   
}
