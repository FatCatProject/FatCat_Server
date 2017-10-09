<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatsAndCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->index(array('id', 'user_email'));
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedInteger('cat_id');

            $table->foreign(array('cat_id', 'user_email'))->references(array(
                'id',
                'user_email'
            ))->on('cats')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(array('cat_id', 'user_email'));
            $table->dropColumn('cat_id');
        });

        Schema::table('cats', function (Blueprint $table) {
            $table->dropIndex(array('id', 'user_email'));
        });
    }
}
