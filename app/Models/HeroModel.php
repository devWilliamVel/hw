<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroModel extends Model
{
    public $timestamps = false;

    protected $table = 'heroes';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'very_strong_against',
        'strong_against',
        'very_weak_against',
        'weak_against',
    ];
}
