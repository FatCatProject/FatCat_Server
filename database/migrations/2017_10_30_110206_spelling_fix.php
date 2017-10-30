<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpellingFix extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("foodboxes", function (Blueprint $table) {
			if (Schema::hasColumn("foodboxes", "bowel_weight"))
			{
				$table->renameColumn("bowel_weight", "bowl_weight");
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
		Schema::table("foodboxes", function (Blueprint $table) {
			if (Schema::hasColumn("foodboxes", "bowl_weight"))
			{
				$table->renameColumn("bowl_weight", "bowel_weight");
			}
		});
	}
}
