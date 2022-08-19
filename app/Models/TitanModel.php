<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitanModel extends Model
{
    public $timestamps = false;

    protected $table = 'titans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'element',
        'very_strong_against',
        'strong_against',
        'very_weak_against',
        'weak_against',
    ];
}
