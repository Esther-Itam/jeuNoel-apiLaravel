<?php namespace App\Interfaces;

use Illuminate\Http\Request;

interface CategorieRepositoryInterface{

    public function index();
    public function store(Request $request);
    public function categorieUsed();
    public function categorieShow($id);
    public function show($id);
    public function update(Request $request, $id);
    public function updateUsed();
    public function delete($id);
}
	