<?php namespace App\Interfaces;

use Illuminate\Http\Request;

interface TeamAnswerRepositoryInterface{

    public function index();
    public function show();
    public function showAnswers();
    public function store(Request $request);
    public function delete();
}
	