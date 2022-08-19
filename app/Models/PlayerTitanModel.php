<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerTitanModel extends Model
{
    public $timestamps = false;

    protected $table = 'players_titans';

    protected $fillable = [
        'player_id',
        'titan_id',
        'level',
        'power',
        'stat_vitality',
        'stat_attack',
        'stat_elemental_damage',
        'stat_elemental_armor',
    ];
}
