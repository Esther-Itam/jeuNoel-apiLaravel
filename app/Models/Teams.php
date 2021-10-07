<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'color',
        'user_id',
        'color_id',

    ];
    protected $with=[
        'user',
        'color'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function color(){
        return $this->belongsTo('App\Models\Colors');
    }

    public function team_answers(){
        return $this->hasMany('App\Models\Team_answers');
    } 
      
}
