<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuildPlayerModel extends Model
{
    public $timestamps = false;

    protected $table = 'guilds_players';

    protected $fillable = [
        'guild_id',
        'player_id',
    ];
}
