<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGoalRelationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goal_reward', function (Blueprint $table) {
            $table->timestamps();

            $table->integer('goal_id')->references('id')->on('goals');
            $table->integer('reward_id')->references('id')->on('rewards');
        });
        Schema::create('action_goal', function (Blueprint $table) {
            $table->timestamps();

            $table->integer('action_id')->references('id')->on('actions');
            $table->integer('goal_id')->references('id')->on('goals');
        });
        Schema::create('goal_user', function (Blueprint $table) {
            $table->timestamps();

            $table->integer('user_id')->references('id')->on('users');
            $table->integer('goal_id')->references('id')->on('goals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goal_team');
        Schema::dropIfExists('goal_reward');
        Schema::dropIfExists('action_goal');
    }
}
