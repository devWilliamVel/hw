<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarDefenseTitanModel extends Model
{
    public $timestamps = false;

    protected $table = 'war_defense_titans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'player_id',
        'titan_id',
        'power',
    ];
}
