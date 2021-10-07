<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Quiz;
use App\Models\Questions;
use App\Models\Categories;
use App\Models\Answers;


class QuestionController extends Controller
{
    /* ************************************************************* */
    /* ************************** CRUD ***************************** */
    /* ************************************************************* */

    /* **************************CREATE Question ********************** */
    function create(Request $request){
        $id = DB::table('quizzes')->orderBy('id', 'DESC')->value('id');

        $question= new Questions;
        $question->name = $request->input('question'); 
        $question->quiz_id=$id; 
        $question->save();  
                
        return response()->json([         
              "message" => "creation du question reussi",         
               "data"=> $question        
          ], 201);  
    }

    /* **************************SHOW Question ********************** */

    function index(){
        $question = Questions::all();   
        return response()->json([    
       'message'=> 'Questions affichées',     
       'data'=> $question]);  
    }
    

    /* **************************UPDATE Question ********************** */

    function update(Request $request, $id){
        $question = Questions::findOrFail($id);
        $question->update($request->all());
          return response([             
          'message'=> 'mise a jour de la question reussie',       
           'data'=> $question       
    ]); 
    }
   
}
