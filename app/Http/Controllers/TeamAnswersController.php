<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team_answers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class TeamAnswersController extends Controller
{


  /* ************************************************************* */
    /* ************************** CRUD ***************************** */
    /* ************************************************************* */

    /* **************************CREATE TEAM ANSWERS ********************** */
    function create(Request $request){

        $teamAnswers= new Team_answers;
        $teamAnswers->question_id=$request->input('question_id');  
        $teamAnswers->team_id=15; 
        $teamAnswers->answer_id=$request->input('answer_id'); 
        $teamAnswers->save();  
                
        return response()->json([         
              "message" => "Réponse envoyée",         
               "data"=> $teamAnswers        
          ], 201);  
    }
  /* **************************INDEX TEAM ANSWERS ********************** */

  function index(){
    $teamAnswers = Team_answers::all();   
    return response()->json([    
   'message'=> 'Réponses validées',     
   'data'=> $teamAnswers]);  
}

   /* **************************SHOW TEAM ANSWERS ********************** */

   function show(){
   

            $data = DB::table('team_answers')
            ->join('questions', 'questions.id', '=', 'team_answers.question_id')
            ->join('answers', 'answers.id', '=', 'team_answers.answer_id')
            ->where('answers.is_valid', '=', 1)
            ->whereNotNull('team_answers.id')
            ->whereTime('team_answers.created_at', '<', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->select('questions.name as questionName', 'answers.name as answerName', 'answers.id as answerId', 'team_answers.answer_id as team_answersId')
            ->get();

    return response()->json([    
        'message'=> 'Réponses validées affichées',     
        'data'=> $data]);
}
}