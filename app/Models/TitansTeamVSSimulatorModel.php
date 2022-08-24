<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitansTeamVSSimulatorModel extends Model
{
    public $timestamps = false;

    protected $table = 'titan_teams_vs_simulations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'a_titan_id',
        'a_titan_power',
        'a_titan_stars',
        'a_titan_range_color',
        'b_titan_id',
        'b_titan_power',
        'b_titan_stars',
        'b_titan_range_color',
        'c_titan_id',
        'c_titan_power',
        'c_titan_stars',
        'c_titan_range_color',
        'd_titan_id',
        'd_titan_power',
        'd_titan_stars',
        'd_titan_range_color',
        'e_titan_id',
        'e_titan_power',
        'e_titan_stars',
        'e_titan_range_color',
        'very_surely_win',
        'surely_win',
        'very_surely_lose',
        'surely_lose',
    ];
}
