<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamTitansWithPowerModel extends Model
{
    public $timestamps = false;

    protected $table = 'teams_titans_with_power';
    protected $primaryKey = 'id';

    protected $fillable = [
        'winner_a_titan_id',
        'winner_a_titan_power',
        'winner_b_titan_id',
        'winner_b_titan_power',
        'winner_c_titan_id',
        'winner_c_titan_power',
        'winner_d_titan_id',
        'winner_d_titan_power',
        'winner_e_titan_id',
        'winner_e_titan_power',
        'looser_a_titan_id',
        'looser_a_titan_power',
        'looser_b_titan_id',
        'looser_b_titan_power',
        'looser_c_titan_id',
        'looser_c_titan_power',
        'looser_d_titan_id',
        'looser_d_titan_power',
        'looser_e_titan_id',
        'looser_e_titan_power',
        'created_at',
    ];
}
