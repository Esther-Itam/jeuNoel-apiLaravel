<?php namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Validation\RegisterValidation;
use App\Http\Validation\UpdateValidation;
use App\Http\Validation\LoginValidation;

interface UserRepositoryInterface{

    public function register(Request $request, RegisterValidation $validation);
    public function login(Request $request, LoginValidation $validation);
    public function index();
    public function show($id);
    public function update(Request $request, $id, UpdateValidation $validation);
}
	