<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_titans', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->index();
            $table->integer('titan_id')->index();
            $table->integer('level')->nullable();
            $table->integer('power')->nullable();
            $table->tinyInteger('stars')->nullable();
            $table->tinyInteger('range_color')->nullable();
            $table->integer('stat_vitality')->nullable();
            $table->integer('stat_attack')->nullable();
            $table->integer('stat_elemental_damage')->nullable();
            $table->integer('stat_elemental_armor')->nullable();
            $table->unique(['player_id', 'titan_id'], 'pk_players_titans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_titans');
    }
}
