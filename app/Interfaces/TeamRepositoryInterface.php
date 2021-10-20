<?php namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Validation\TeamValidation;
use App\Models\Colors;

interface TeamRepositoryInterface{

    public function index();
    public function show($id);
    public function store(Request $request, TeamValidation $validation, Colors $color);
    public function delete();
}
	