<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Avatars;


class AvatarController extends Controller
{

    public function displayAvatar(){
        $avatars=Avatars::all();
        return response()->json($avatars);
    }


   
}
