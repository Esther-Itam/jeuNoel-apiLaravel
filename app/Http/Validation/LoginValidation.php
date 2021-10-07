<?php
namespace App\Http\Validation;

class LoginValidation{
    public function rules(){
        return [

            'email'=>['required', 'email'],
            'password'=>['required', 'string'],

        ];
    }
    public function messages(){
        return [
 
            'email.required'=>'Veuillez renseigner un email',
            'password.required'=>'Veuillez renseigner un mot de passe',

        ];
    }
}