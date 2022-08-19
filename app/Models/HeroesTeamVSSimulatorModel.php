<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroesTeamVSSimulatorModel extends Model
{
    public $timestamps = false;

    protected $table = 'hero_teams_vs_simulations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'a_hero_id',
        'a_hero_power',
        'b_hero_id',
        'b_hero_power',
        'c_hero_id',
        'c_hero_power',
        'd_hero_id',
        'd_hero_power',
        'e_hero_id',
        'e_hero_power',
        'pet_id',
        'pet_power',
        'very_surely_win',
        'surely_win',
        'very_surely_lose',
        'surely_lose',
    ];
}
