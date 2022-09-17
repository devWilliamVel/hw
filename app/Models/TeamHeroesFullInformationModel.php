<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamHeroesFullInformationModel extends Model
{
    public $timestamps = true;

    protected $table = 'teams_heroes_full_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'winner_a_hero_id',
        'winner_a_hero_power',
        'winner_a_hero_stars',
        'winner_a_hero_range',
        'winner_a_hero_pet',
        'winner_b_hero_id',
        'winner_b_hero_power',
        'winner_b_hero_stars',
        'winner_b_hero_range',
        'winner_b_hero_pet',
        'winner_c_hero_id',
        'winner_c_hero_power',
        'winner_c_hero_stars',
        'winner_c_hero_range',
        'winner_c_hero_pet',
        'winner_d_hero_id',
        'winner_d_hero_power',
        'winner_d_hero_stars',
        'winner_d_hero_range',
        'winner_d_hero_pet',
        'winner_e_hero_id',
        'winner_e_hero_power',
        'winner_e_hero_stars',
        'winner_e_hero_range',
        'winner_e_hero_pet',
        'winner_pet_id',
        'winner_pet_power',
        'winner_pet_stars',
        'winner_pet_range',

        'looser_a_hero_id',
        'looser_a_hero_power',
        'looser_a_hero_stars',
        'looser_a_hero_range',
        'looser_a_hero_pet',
        'looser_b_hero_id',
        'looser_b_hero_power',
        'looser_b_hero_stars',
        'looser_b_hero_range',
        'looser_b_hero_pet',
        'looser_c_hero_id',
        'looser_c_hero_power',
        'looser_c_hero_stars',
        'looser_c_hero_range',
        'looser_c_hero_pet',
        'looser_d_hero_id',
        'looser_d_hero_power',
        'looser_d_hero_stars',
        'looser_d_hero_range',
        'looser_d_hero_pet',
        'looser_e_hero_id',
        'looser_e_hero_power',
        'looser_e_hero_stars',
        'looser_e_hero_range',
        'looser_e_hero_pet',
        'looser_pet_id',
        'looser_pet_power',
        'looser_pet_stars',
        'looser_pet_range',

        'created_at',
        'updated_at',
    ];
}
