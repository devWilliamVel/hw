<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerPetModel extends Model
{
    public $timestamps = false;

    protected $table = 'players_pets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'player_id',
        'pet_id',
        'level',
        'power',
        'stars',
        'range_color',
    ];
}
