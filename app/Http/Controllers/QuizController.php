<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Quiz;
use App\Models\Questions;
use App\Models\Categories;
use App\Models\Answers;
use Illuminate\Support\Facades\DB;


class QuizController extends Controller
{
    /* ************************************************************* */
    /* ************************** CRUD ***************************** */
    /* ************************************************************* */

    /* **************************CREATE QUIZ ********************** */
    function create(Request $request){

        $quiz = new Quiz;  
        $quiz->name = $request->input('name');  
        $quiz->categorie_id =$request->input('categorie');   
        $quiz->save();  

        return response()->json([         
              "message" => "creation du quiz reussi",         
               "data"=> $quiz        
          ], 201);  
}

    /* **************************INDEX QUIZ ********************** */

function index(){
    $quiz = Quiz::all();   
    return response()->json([    
   'message'=> 'Quizzes affichés',     
   'data'=> $quiz]);  
}

    /* **************************SHOW QUIZ ********************** */

    function show($id){
        $quiz=Quiz::find($id);
        if(!$quiz){
            return response()->json(['message'=>'ressource not found'], 403);
        }

            $quiz = DB::table('quizzes')->select('quizzes.name as quizName', 'quizzes.id as quizId')
            ->join('categories', 'categories.id', '=', 'quizzes.categorie_id')
            ->where('quizzes.id', '=', $id)
            ->get();

            $row2[]=$quiz;

            $questions = DB::table('questions')->select('questions.name as questionName', 'questions.id as questionId')
                                                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                                                ->where('quizzes.id', '=', $id)
                                                ->get();

            $row3[]=$questions;

            $answers = DB::table('answers')->select('answers.name as answerName', 'answers.id as answerId', 'answers.is_valid as answerValid')
                                            ->join('questions', 'questions.id', '=', 'answers.question_id')
                                            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                                            ->where('quizzes.id', '=', $id)
                                            ->get();
        
            $row4[]=$answers;
            $data=Arr::crossJoin($row2, $row3, $row4);
    return response()->json($data);
    }

    /* **************************UPDATE QUIZ ********************** */

function update(Request $request, $id){
    $quiz = Quiz::findOrFail($id);
    $quiz->update($request->all());
      return response([             
      'message'=> 'mise a jour du quiz reussie',       
       'data'=> $quiz       
]); 
}

    /* **************************DELETE QUIZ ********************** */

function delete(Request $request, $id){

    $quiz = Quiz::findOrFail($id);
    $quiz->delete();
   return response([          
                'message'=> 'suppression reussie'   
      ], 204);  
}
  
}
