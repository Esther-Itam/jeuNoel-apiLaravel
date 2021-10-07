<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'categorie_id',
  

    ];
    protected $with=[
        'categorie',
    ];


    public function categorie(){
        return $this->belongsTo('App\Models\Categories');
    }

    public function question(){
        return $this->hasMany('App\Models\Questions');
    } 
}
