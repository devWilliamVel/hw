<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTitansFullInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_titans_full_information', function (Blueprint $table) {
            $table->id();
            $table->integer('winner_a_titan_id')->index()->nullable();
            $table->integer('winner_a_titan_power')->nullable();
            $table->tinyInteger('winner_a_titan_stars')->nullable();
            $table->integer('winner_b_titan_id')->index()->nullable();
            $table->integer('winner_b_titan_power')->nullable();
            $table->tinyInteger('winner_b_titan_stars')->nullable();
            $table->integer('winner_c_titan_id')->index()->nullable();
            $table->integer('winner_c_titan_power')->nullable();
            $table->tinyInteger('winner_c_titan_stars')->nullable();
            $table->integer('winner_d_titan_id')->index()->nullable();
            $table->integer('winner_d_titan_power')->nullable();
            $table->tinyInteger('winner_d_titan_stars')->nullable();
            $table->integer('winner_e_titan_id')->index()->nullable();
            $table->integer('winner_e_titan_power')->nullable();
            $table->tinyInteger('winner_e_titan_stars')->nullable();

            $table->integer('looser_a_titan_id')->index()->nullable();
            $table->integer('looser_a_titan_power')->nullable();
            $table->tinyInteger('looser_a_titan_stars')->nullable();
            $table->integer('looser_b_titan_id')->index()->nullable();
            $table->integer('looser_b_titan_power')->nullable();
            $table->tinyInteger('looser_b_titan_stars')->nullable();
            $table->integer('looser_c_titan_id')->index()->nullable();
            $table->integer('looser_c_titan_power')->nullable();
            $table->tinyInteger('looser_c_titan_stars')->nullable();
            $table->integer('looser_d_titan_id')->index()->nullable();
            $table->integer('looser_d_titan_power')->nullable();
            $table->tinyInteger('looser_d_titan_stars')->nullable();
            $table->integer('looser_e_titan_id')->index()->nullable();
            $table->integer('looser_e_titan_power')->nullable();
            $table->tinyInteger('looser_e_titan_stars')->nullable();

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
        Schema::dropIfExists('teams_titans_full_information');
    }
}
