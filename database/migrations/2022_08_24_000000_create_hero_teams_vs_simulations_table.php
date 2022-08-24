<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroTeamsVSSimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_teams_vs_simulations', function (Blueprint $table) {
            $table->id();
            $table->integer('a_hero_id')->index();
            $table->integer('a_hero_power');
            $table->tinyInteger('a_hero_stars');
            $table->tinyInteger('a_hero_range_color');
            $table->integer('b_hero_id')->index();
            $table->integer('b_hero_power');
            $table->tinyInteger('b_hero_stars');
            $table->tinyInteger('b_hero_range_color');
            $table->integer('c_hero_id')->index();
            $table->integer('c_hero_power');
            $table->tinyInteger('c_hero_stars');
            $table->tinyInteger('c_hero_range_color');
            $table->integer('d_hero_id')->index();
            $table->integer('d_hero_power');
            $table->tinyInteger('d_hero_stars');
            $table->tinyInteger('d_hero_range_color');
            $table->integer('e_hero_id')->index();
            $table->integer('e_hero_power');
            $table->tinyInteger('e_hero_stars');
            $table->tinyInteger('e_hero_range_color');
            $table->integer('pet_id')->index();
            $table->integer('pet_power');
            $table->tinyInteger('pet_stars');
            $table->tinyInteger('pet_range_color');
            $table->string('very_surely_win')->default('');
            $table->string('surely_win')->default('');
            $table->string('very_surely_lose')->default('');
            $table->string('surely_lose')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hero_teams_vs_simulations');
    }
}
