<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cats_vet_logs', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
            $table->dropForeign(['cat_id']);

            $table->dropColumn('cat_id');
            $table->string('cat_name');
            $table->foreign(array('user_email', 'cat_name'))->references(array(
                'user_email',
                'cat_name'
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
        Schema::table('cats_vet_logs', function (Blueprint $table) {
            $table->dropForeign(array('user_email', 'cat_name'));
            $table->dropColumn('cat_name');

            $table->unsignedInteger('cat_id');
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade')->onUpdate('cascade');

        });
    }
}
