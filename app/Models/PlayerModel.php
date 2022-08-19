<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    public $timestamps = false;

    protected $table = 'players';
    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    /** ################################################################################################################
     *  ##########    RELATIONSHIPS    #################################################################################
     *  ##############################################################################################################*/
    public function guilds ()
    {
        return $this->belongsToMany(GuildModel::class, 'guilds_players', 'player_id', 'guild_id');
    }
}
