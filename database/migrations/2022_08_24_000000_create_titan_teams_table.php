<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitanTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titan_teams', function (Blueprint $table) {
            $table->id();
            $table->integer('a_titan_id')->index();
            $table->integer('b_titan_id')->index();
            $table->integer('c_titan_id')->index();
            $table->integer('d_titan_id')->index();
            $table->integer('e_titan_id')->index();
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
        Schema::dropIfExists('titan_teams');
    }
}
