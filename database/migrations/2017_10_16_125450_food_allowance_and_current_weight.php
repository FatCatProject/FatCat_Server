<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FoodAllowanceAndCurrentWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cats', function (Blueprint $table) {
            if (!Schema::hasColumn('cats', 'food_allowance')) {
                $table->integer('food_allowance')->default(0);
            }
        });

        Schema::table('foodboxes', function (Blueprint $table) {
            if (!Schema::hasColumn('foodboxes', 'current_weight')) {
                $table->float('current_weight')->default(0);
            }
            if (!Schema::hasColumn('foodboxes', 'bowel_weight')) {
                $table->float('bowel_weight')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foodboxes', function (Blueprint $table) {
            if (Schema::hasColumn('foodboxes', 'current_weight')) {
                $table->dropColumn('current_weight');
            }
            if (Schema::hasColumn('foodboxes', 'bowel_weight')) {
                $table->dropColumn('bowel_weight');
            }
        });
    }
}
