<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamTitansFullInformationModel extends Model
{
    public $timestamps = true;

    protected $table = 'teams_titans_full_information';
    protected $primaryKey = 'id';

    protected $fillable = [
        'winner_a_titan_id',
        'winner_a_titan_power',
        'winner_a_titan_stars',
        'winner_b_titan_id',
        'winner_b_titan_power',
        'winner_b_titan_stars',
        'winner_c_titan_id',
        'winner_c_titan_power',
        'winner_c_titan_stars',
        'winner_d_titan_id',
        'winner_d_titan_power',
        'winner_d_titan_stars',
        'winner_e_titan_id',
        'winner_e_titan_power',
        'winner_e_titan_stars',
        'looser_a_titan_id',
        'looser_a_titan_power',
        'looser_a_titan_stars',
        'looser_b_titan_id',
        'looser_b_titan_power',
        'looser_b_titan_stars',
        'looser_c_titan_id',
        'looser_c_titan_power',
        'looser_c_titan_stars',
        'looser_d_titan_id',
        'looser_d_titan_power',
        'looser_d_titan_stars',
        'looser_e_titan_id',
        'looser_e_titan_power',
        'looser_e_titan_stars',
        'created_at',
        'updated_at',
    ];
}
