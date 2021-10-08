<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team_answers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ResultController extends Controller
{


  /* ************************************************************* */
    /* ************************** CRUD ***************************** */
    /* ************************************************************* */

   /* **************************SHOW TEAM ANSWERS ********************** */

   function show(){

            $team_answers = DB::table('team_answers')
            ->join('teams', 'teams.id', '=', 'team_answers.team_id')
            ->join('answers', 'answers.id', '=', 'team_answers.answer_id')
            ->where('answers.is_valid', '=', 1)
            ->whereNotNull('team_answers.id')
            ->select('teams.name as teamName', DB::raw('count(team_answers.answer_id) as userCount'))
            ->groupBy('teams.name')
            ->orderByDesc('userCount')
            ->get();
            $data[]=$team_answers;

    return response()->json([    
        'message'=> 'bilan affiché',     
        'data'=> $data]);
}
}