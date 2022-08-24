<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_teams', function (Blueprint $table) {
            $table->id();
            $table->integer('a_hero_id')->index();
            $table->integer('b_hero_id')->index();
            $table->integer('c_hero_id')->index();
            $table->integer('d_hero_id')->index();
            $table->integer('e_hero_id')->index();
            $table->integer('pet_id')->index();
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
        Schema::dropIfExists('hero_teams');
    }
}
