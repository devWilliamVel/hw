<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamHeroesFullPowerModel extends Model
{
    public $timestamps = false;

    protected $table = 'teams_heroes_full_power';
    protected $primaryKey = 'id';

    protected $fillable = [
        'winner_a_hero_id',
        'winner_b_hero_id',
        'winner_c_hero_id',
        'winner_d_hero_id',
        'winner_e_hero_id',
        'winner_pet_id',
        'looser_a_hero_id',
        'looser_b_hero_id',
        'looser_c_hero_id',
        'looser_d_hero_id',
        'looser_e_hero_id',
        'looser_pet_id',
        'created_at',
    ];
}
