<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultiplierToJoinTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reward_user', function (Blueprint $table) {
            $table->integer('multiplier')->default(1);
        });

        Schema::table('action_user', function (Blueprint $table) {
            $table->integer('multiplier')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reward_user', function (Blueprint $table) {
            $table->dropColumn('multiplier');
        });

        Schema::table('action_user', function (Blueprint $table) {
            $table->dropColumn('multiplier');
        });
    }
}
