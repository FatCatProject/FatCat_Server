<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatBreeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_breeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('breed_name');
            $table->string('link', 255);
            $table->string('description', 1000);
            $table->timestamps();

            $table->unique('breed_name');
        });

        Schema::table('cats', function (Blueprint $table) {
            $table->renameColumn('cat_race', 'cat_breed');

            $table->foreign('cat_breed')->references('breed_name')->on('cat_breeds')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropForeign(['cat_breed']);
            $table->dropIndex('cats_cat_breed_foreign');

            $table->renameColumn('cat_breed', 'cat_race');

        });

        Schema::dropIfExists('cat_breeds');
    }
}
