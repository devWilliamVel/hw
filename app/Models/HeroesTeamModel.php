<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroesTeamModel extends Model
{
    public $timestamps = false;

    protected $table = 'hero_teams';
    protected $primaryKey = 'id';

    protected $fillable = [
        'a_hero_id',
        'b_hero_id',
        'c_hero_id',
        'd_hero_id',
        'e_hero_id',
        'pet_id',
        'very_surely_win',
        'surely_win',
        'very_surely_lose',
        'surely_lose',
    ];
}
