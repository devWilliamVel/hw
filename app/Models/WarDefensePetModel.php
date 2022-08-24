<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarDefensePetModel extends Model
{
    public $timestamps = false;

    protected $table = 'war_defense_pets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'player_id',
        'player_pet_id',
    ];
}
