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
        'a_hero_stars',
        'a_hero_range_color',
        'b_hero_id',
        'b_hero_power',
        'b_hero_stars',
        'b_hero_range_color',
        'c_hero_id',
        'c_hero_power',
        'c_hero_stars',
        'c_hero_range_color',
        'd_hero_id',
        'd_hero_power',
        'd_hero_stars',
        'd_hero_range_color',
        'e_hero_id',
        'e_hero_power',
        'e_hero_stars',
        'e_hero_range_color',
        'pet_id',
        'pet_power',
        'pet_stars',
        'pet_range_color',
        'very_surely_win',
        'surely_win',
        'very_surely_lose',
        'surely_lose',
    ];
}
