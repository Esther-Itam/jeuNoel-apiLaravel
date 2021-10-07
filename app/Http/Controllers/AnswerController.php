<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Quiz;
use App\Models\Questions;
use App\Models\Categories;
use App\Models\Answers;
use Illuminate\Support\Facades\DB;


class AnswerController extends Controller
{
    /* ************************************************************* */
    /* ************************** CRUD ***************************** */
    /* ************************************************************* */

    /* **************************CREATE Answer ********************** */
    function create(Request $request){

        $id = DB::table('questions')->orderBy('id', 'DESC')->value('id');

        $answer = new Answers;
        $answer->name = $request->input('answer'); 
        $answer->question_id = $id;
        $answer->is_valid = $request->input('is_valid');
        $answer->save();  
 
                
        return response()->json([         
              "message" => "creation de la réponse reussi",         
               "data"=> $answer        
          ], 201);  
    }

 /* **************************SHOW Answer ********************** */

 function index(){
    $answer = Answers::all();   
    return response()->json([    
   'message'=> 'Réponses affichées',     
   'data'=> $answer]);  
}

    /* **************************UPDATE Answer ********************** */

    function update(Request $request, $id){
      $answer = Answers::findOrFail($id);
      $answer->update($request->all());
        return response([             
        'message'=> 'mise a jour de la réponse reussie',       
         'data'=> $answer       
  ]); 
  }
   
}
