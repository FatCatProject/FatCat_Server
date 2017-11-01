<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FoodPicture extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('foods', function (Blueprint $table) {
			if (!Schema::hasColumn('foods', 'picture')) {
				$table->string('picture')->nullable();
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
		Schema::table('foods', function (Blueprint $table) {
			if (Schema::hasColumn('foods', 'picture')) {
				$table->dropColumn('picture');
			}
		});
	}
}
