<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerHeroModel extends Model
{
    public $timestamps = false;

    protected $table = 'players_heroes';

    protected $fillable = [
        'player_id',
        'hero_id',
        'level',
        'power',
        'stat_vitality',
        'stat_physical_attack',
        'stat_magik_attack',
        'stat_physical_defense',
        'stat_magik_defense',
        'stat_physical_penetration',
        'stat_magik_penetration',
        'stat_dodge',
        'stat_vampirism',
        'stat_critical_hit',
    ];
}
