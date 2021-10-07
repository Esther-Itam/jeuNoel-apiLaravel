<?php
namespace App\Http\Validation;

class TeamValidation{
    public function rules(){
        return [

            'name'=>['required'],
            'avatar'=>['required'],
            'color'=>['required'],

        ];
    }
    public function messages(){
        return [
 
            'name.required'=>'Veuillez rentrer un nom d\'équipe',
            'avatar.required'=>'Veuillez sélectionner un avatar',
            'color.required'=>'Veuillez sélectionner une couleur d\'équipe',


        ];
    }
}