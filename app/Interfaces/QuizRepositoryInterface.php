<?php namespace App\Interfaces;

use Illuminate\Http\Request;

interface QuizRepositoryInterface{

    public function index();
    public function show($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function delete(Request $request, $id);
}
	