<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsHeroesWithPowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_heroes_with_power', function (Blueprint $table) {
            $table->id();
            $table->integer('winner_a_hero_id')->index()->nullable();
            $table->integer('winner_a_hero_power')->nullable();
            $table->integer('winner_b_hero_id')->index()->nullable();
            $table->integer('winner_b_hero_power')->nullable();
            $table->integer('winner_c_hero_id')->index()->nullable();
            $table->integer('winner_c_hero_power')->nullable();
            $table->integer('winner_d_hero_id')->index()->nullable();
            $table->integer('winner_d_hero_power')->nullable();
            $table->integer('winner_e_hero_id')->index()->nullable();
            $table->integer('winner_e_hero_power')->nullable();
            $table->integer('winner_pet_id')->index()->nullable();
            $table->integer('winner_pet_power')->nullable()->nullable();
            $table->integer('looser_a_hero_id')->index()->nullable();
            $table->integer('looser_a_hero_power')->nullable();
            $table->integer('looser_b_hero_id')->index()->nullable();
            $table->integer('looser_b_hero_power')->nullable();
            $table->integer('looser_c_hero_id')->index()->nullable();
            $table->integer('looser_c_hero_power')->nullable();
            $table->integer('looser_d_hero_id')->index()->nullable();
            $table->integer('looser_d_hero_power')->nullable();
            $table->integer('looser_e_hero_id')->index()->nullable();
            $table->integer('looser_e_hero_power')->nullable();
            $table->integer('looser_pet_id')->index()->nullable();
            $table->integer('looser_pet_power')->nullable();
            $table->date('created_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_DATE'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_heroes_with_power');
    }
}
