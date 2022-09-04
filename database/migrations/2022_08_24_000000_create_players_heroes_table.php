<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_heroes', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->index();
            $table->integer('hero_id')->index();
            $table->integer('level')->nullable();
            $table->integer('power')->nullable();
            $table->tinyInteger('stars')->nullable();
            $table->tinyInteger('range_color')->nullable();
            $table->integer('stat_vitality')->nullable();
            $table->integer('stat_physical_attack')->nullable();
            $table->integer('stat_magik_attack')->nullable();
            $table->integer('stat_physical_defense')->nullable();
            $table->integer('stat_magik_defense')->nullable();
            $table->integer('stat_physical_penetration')->nullable();
            $table->integer('stat_magik_penetration')->nullable();
            $table->integer('stat_dodge')->nullable();
            $table->integer('stat_vampirism')->nullable();
            $table->integer('stat_critical_hit')->nullable();
            $table->unique(['player_id', 'hero_id'], 'pk_playrs_heroes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_heroes');
    }
}
