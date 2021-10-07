<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'question_id',
        'is_valid'


    ];

    protected $with=[
        'question'
 
    ];


    public function question(){
        return $this->belongsTo('App\Models\Questions');
    }
    public function team_answers(){
        return $this->hasMany('App\Models\Team_answers');
    } 
  
}
