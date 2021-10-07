<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_answers extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_id',
        'answer_id',
        'question_id',

    ];
    protected $with=[
        'answer',
        'team'
 
    ];
    public function answer(){
        return $this->belongsTo('App\Models\Answers');
    }
    public function team(){
        return $this->belongsTo('App\Models\Teams');
    }
  
}
