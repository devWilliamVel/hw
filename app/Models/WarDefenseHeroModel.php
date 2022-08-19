<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarDefenseHeroModel extends Model
{
    public $timestamps = false;

    protected $table = 'war_defense_heroes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'player_id',
        'hero_id',
        'power',
    ];
}
