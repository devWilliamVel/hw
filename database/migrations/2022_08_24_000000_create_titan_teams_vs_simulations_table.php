<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('a_titan_id')->index();
            $table->integer('a_titan_power');
            $table->tinyInteger('a_titan_stars');
            $table->tinyInteger('a_titan_range_color');
            $table->integer('b_titan_id')->index();
            $table->integer('b_titan_power');
            $table->tinyInteger('b_titan_stars');
            $table->tinyInteger('b_titan_range_color');
            $table->integer('c_titan_id')->index();
            $table->integer('c_titan_power');
            $table->tinyInteger('c_titan_stars');
            $table->tinyInteger('c_titan_range_color');
            $table->integer('d_titan_id')->index();
            $table->integer('d_titan_power');
            $table->tinyInteger('d_titan_stars');
            $table->tinyInteger('d_titan_range_color');
            $table->integer('e_titan_id')->index();
            $table->integer('e_titan_power');
            $table->tinyInteger('e_titan_stars');
            $table->tinyInteger('e_titan_range_color');
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
        Schema::dropIfExists('users');
    }
}
