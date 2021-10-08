<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Colors;
use Illuminate\Support\Facades\DB;


class ColorController extends Controller
{

/* **************************INDEX COLOR ********************** */

    public function index(){
        $color = Colors::all();
        $color = DB::table('colors')->select('colors.color as colorName', 'colors.id as colorId', 'colors.is_used as colorUsed')
        ->get();
        $row[]=$color;   
        return response()->json([    
            'message'=> 'Couleurs affichées',     
            'data'=> $row]);  
         }

         
/* **************************UPDATE COLOR ********************** */

    function update(Request $request, $id){
        $color = Colors::findOrFail($id);
        $color->update($request->all());
        return response()->json([             
        'message'=> 'mise a jour de la couleur reussie',       
        'data'=> $color       
    ]); 
    }

/* **************************UPDATE USED COLOR ********************** */

function updateUsed(){
    $color=DB::table('colors')->update(['is_used' => 0]);
    return response()->json([             
    'message'=> 'mise a jour de la colonne is_used des couleurs reussie',       
    'data'=> $color       
]); 
}

/* **************************SHOW COLOR ********************** */

   function show($id){
    $color=Colors::find($id);
    if(!$color){
        return response()->json(['message'=>'ressource not found'], 403);
    }

        $color = DB::table('colors')->select('colors.color as colorName', 'colors.id as colorId', 'colors.is_used as colorUsed')
        ->join('teams', 'teams.color_id', '=', 'colors.id')
        ->where('colors.id', '=', $id)
        ->get();

        $row[]=$color;
        return response()->json($row);
    }
}