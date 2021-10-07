<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quiz_id'


    ];
    protected $with=[
        'quiz'
    ];

    
    public function quiz(){
        return $this->belongsTo('App\Models\Quiz');
    }
    public function answers(){
        return $this->hasMany('App\Models\Answers');
    } 

}
