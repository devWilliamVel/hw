<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamTitansFullPowerModel extends Model
{
    public $timestamps = false;

    protected $table = 'teams_titans_full_power';
    protected $primaryKey = 'id';

    protected $fillable = [
        'winner_a_titan_id',
        'winner_b_titan_id',
        'winner_c_titan_id',
        'winner_d_titan_id',
        'winner_e_titan_id',
        'looser_a_titan_id',
        'looser_b_titan_id',
        'looser_c_titan_id',
        'looser_d_titan_id',
        'looser_e_titan_id',
        'created_at',
    ];
}
