<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;
    protected $fillable = [

        'color',
        'is_used'

    ];

    public function teams(){
        return $this->hasMany('App\Models\Teams');
    } 
}
