<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    
 /* ************************************************************* */
    /* ************************** CRUD ***************************** */
    /* ************************************************************* */

    /* **************************CREATE Categories ********************** */
    function create(Request $request){


        $categorie = new Categories;
        $categorie->name = $request->input('name');  
        $categorie->is_used = 0;  
        $categorie->save();  

        return response()->json([         
              "message" => "creation de la catégorie reussi",         
               "data"=> $categorie        
          ], 201);  
}

    /* **************************INDEX Categories ********************** */

function index(){
    $categorie = Categories::all();  
    return response()->json([    
   'message'=> 'Catégories affichées',     
   'data'=> $categorie]); 

}
  /* **************************SHOW Categories ********************** */

  function categorieShow($id){
    $categorieShow=Categories::find($id);
    if(!$categorieShow){
        return response()->json(['message'=>'ressource not found'], 403);
    }
            $categorieShow = DB::table('categories')->select('categories.name as categorieName', 'categories.id as categorieId')
            ->where('categories.id', '=', $id)
            ->get();
            $row[]=$categorieShow;
            return response()->json([    
                'message'=> 'Catégories affichées',     
                'data'=> $row]); 
        }
        
    /* **************************SHOW Categories ********************** */

function show($id){
    $categorie=Categories::find($id);
    if(!$categorie){
        return response()->json(['message'=>'ressource not found'], 403);
    }
            $categorie = DB::table('categories')->select('categories.name as categorieName', 'categories.id as categorieId')
            ->where('categories.id', '=', $id)
            ->get();
            $row1[]=$categorie;

            $quiz_id=DB::table('quizzes')
            ->where('categorie_id', '=', $id)
            ->pluck('id')
            ->random(1);
            [$quiz_id_random]=$quiz_id;

            $quiz = DB::table('quizzes')->select('quizzes.name as quizName', 'quizzes.id as quizId')
            ->join('categories', 'categories.id', '=', 'quizzes.categorie_id')
            ->where('categories.id', '=', $id)
            ->where('quizzes.id', '=', $quiz_id_random)
            ->get();

            $row2[]=$quiz;
            $question_answer_id=DB::table('team_answers')
            ->pluck('question_id');
           
            $question_id=DB::table('questions')
            ->where('quiz_id', '=', $quiz_id_random)
            ->whereNotIn('questions.id', $question_answer_id)
            ->pluck('id')
            ->random(1);
            [$question_id_random]=$question_id;

          

            $questions = DB::table('questions')->select('questions.name as questionName', 'questions.id as questionId')
                                                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                                                ->where('quizzes.id', '=', $quiz_id_random)
                                                ->where('questions.id', '=', $question_id_random)            
                                                ->get();

            $row3[]=$questions;

            $answers = DB::table('answers')->select('answers.name as answerName', 'answers.id as answerId')
                                            ->join('questions', 'questions.id', '=', 'answers.question_id')
                                            ->where('answers.question_id', '=', $question_id_random)
                                            ->get();
        
            $row4[]=$answers;
            $data=Arr::crossJoin($row1, $row2, $row3, $row4);
    return response()->json($data);
}

    /* **************************UPDATE Categories ********************** */

function update(Request $request, $id){
    $categorie = Categories::findOrFail($id);
    $categorie->update($request->all());
      return response([             
      'message'=> 'mise a jour de la catégorie reussie',       
       'data'=> $categorie       
]); 
}

    /* **************************DELETE Categories ********************** */

function delete(Request $request, $id){

    $categorie = Categories::findOrFail($id);
    $categorie->delete();
   return response([          
                'message'=> 'suppression reussie'   
      ], 204);  
}



}
