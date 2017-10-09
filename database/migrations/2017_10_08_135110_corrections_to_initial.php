<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectionsToInitial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brainboxes', function (Blueprint $table) {
            $table->dateTime('last_seen')->nullable()->change();
        });

        Schema::table('foodboxes', function (Blueprint $table) {
            $table->dateTime('last_seen')->nullable()->change();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brainboxes', function (Blueprint $table) {
            $table->dateTime('last_seen')->nullable(false)->change();
        });

        Schema::table('foodboxes', function (Blueprint $table) {
            $table->dateTime('last_seen')->nullable(false)->change();
        });


    }
}
