<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pictures extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("foods", function (Blueprint $table) {
			if (Schema::hasColumn("foods", "picture")) {
				$table->dropColumn("picture");
			}
		});

		Schema::table("users", function (Blueprint $table) {
			if (Schema::hasColumn("users", "profile_picture")) {
				$table->dropColumn("profile_picture");
			}
		});

		Schema::table("cats", function (Blueprint $table) {
			if (Schema::hasColumn("cats", "profile_picture")) {
				$table->dropColumn("profile_picture");
			}
		});

		Schema::table("cats_vet_logs", function (Blueprint $table) {
			if (Schema::hasColumn("cats_vet_logs", "prescription_picture")) {
				$table->dropColumn("prescription_picture");
			}
		});

		Schema::table("products", function (Blueprint $table) {
			if (Schema::hasColumn("products", "picture")) {
				$table->dropColumn("picture");
			}
		});

		Schema::table("foods", function (Blueprint $table) {
			if (!Schema::hasColumn("foods", "picture")) {
				$table->binary("picture")->nullable();
			}
		});

		Schema::table("users", function (Blueprint $table) {
			if (!Schema::hasColumn("users", "profile_picture")) {
				$table->binary("profile_picture")->nullable();
			}
		});

		Schema::table("cats", function (Blueprint $table) {
			if (!Schema::hasColumn("cats", "profile_picture")) {
				$table->binary("profile_picture")->nullable();
			}
		});

		Schema::table("cats_vet_logs", function (Blueprint $table) {
			if (!Schema::hasColumn("cats_vet_logs", "prescription_picture")) {
				$table->binary("prescription_picture")->nullable();
			}
		});

		Schema::table("products", function (Blueprint $table) {
			if (!Schema::hasColumn("products", "picture")) {
				$table->binary("picture")->nullable();
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
		Schema::table("foods", function (Blueprint $table) {
			if (Schema::hasColumn("foods", "picture")) {
				$table->dropColumn("picture");
			}
		});

		Schema::table("users", function (Blueprint $table) {
			if (Schema::hasColumn("users", "profile_picture")) {
				$table->dropColumn("profile_picture");
			}
		});

		Schema::table("cats", function (Blueprint $table) {
			if (Schema::hasColumn("cats", "profile_picture")) {
				$table->dropColumn("profile_picture");
			}
		});

		Schema::table("cats_vet_logs", function (Blueprint $table) {
			if (Schema::hasColumn("cats_vet_logs", "prescription_picture")) {
				$table->dropColumn("prescription_picture");
			}
		});

		Schema::table("products", function (Blueprint $table) {
			if (Schema::hasColumn("products", "picture")) {
				$table->dropColumn("picture");
			}
		});

		Schema::table("foods", function (Blueprint $table) {
			if (!Schema::hasColumn("foods", "picture")) {
				$table->string("picture")->nullable();
			}
		});

		Schema::table("users", function (Blueprint $table) {
			if (!Schema::hasColumn("users", "profile_picture")) {
				$table->string("profile_picture")->nullable();
			}
		});

		Schema::table("cats", function (Blueprint $table) {
			if (!Schema::hasColumn("cats", "profile_picture")) {
				$table->string("profile_picture")->nullable();
			}
		});

		Schema::table("cats_vet_logs", function (Blueprint $table) {
			if (!Schema::hasColumn("cats_vet_logs", "prescription_picture")) {
				$table->string("prescription_picture")->nullable();
			}
		});

		Schema::table("products", function (Blueprint $table) {
			if (!Schema::hasColumn("products", "picture")) {
				$table->string("picture")->nullable();
			}
		});
	}
}

?>

