<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuildModel extends Model
{
    public $timestamps = false;

    protected $table = 'guilds';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function members ()
    {
        return $this->belongsToMany(PlayerModel::class, 'guilds_players', 'guild_id', 'player_id');
    }
}
