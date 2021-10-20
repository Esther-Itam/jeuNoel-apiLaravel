<?php namespace App\Interfaces;

use Illuminate\Http\Request;

interface ColorRepositoryInterface{

    public function index();
    public function show($id);
    public function update(Request $request, $id);
    public function updateUsed();
}
	