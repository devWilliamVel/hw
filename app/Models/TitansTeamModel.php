<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitansTeamModel extends Model
{
    public $timestamps = false;

    protected $table = 'titan_teams';
    protected $primaryKey = 'id';

    protected $fillable = [
        'a_titan_id',
        'b_titan_id',
        'c_titan_id',
        'd_titan_id',
        'e_titan_id',
        'very_surely_win',
        'surely_win',
        'very_surely_lose',
        'surely_lose',
    ];
}
