<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');

            }
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('buy_food_reminder')->default(false);
            $table->boolean('daily_reminder')->default(false);
            $table->boolean('not_eating_reminder')->default(false);
        });

        Schema::create('cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('cat_name');
            $table->string('profile_picture')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('cat_race')->nullable();
            $table->float('current_weight')->nullable();
            $table->float('target_weight')->nullable();
            $table->integer('daily_calories')->nullable();
            $table->string('wiki_page')->nullable();
            $table->timestamps();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'cat_name'));
        });

        Schema::create('notification_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('notification_email');
            $table->boolean('active')->default(true);

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'notification_email'));
        });

        Schema::create('brainboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('brainbox_id');
            $table->string('brainbox_ip')->nullable();
            $table->boolean('synced_to_client')->default(true);
            $table->dateTime('last_seen');
            $table->timestamps();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'brainbox_id'));
        });

        Schema::create('veterinarians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('clinic_name');
            $table->string('vet_name');
            $table->string('address')->nullable();
            $table->string('hours')->nullable();
            $table->string('phone')->nullable();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'clinic_name', 'vet_name'));
        });

        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('shop_name');
            $table->string('url')->nullable();
            $table->string('address')->nullable();
            $table->string('hours')->nullable();
            $table->string('phone')->nullable();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'shop_name'));
        });

        Schema::create('cats_vet_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->unsignedInteger('cat_id');
            $table->date('visit_date');
            $table->string('subject')->nullable();
            $table->string('description')->nullable();
            $table->string('clinic_name')->nullable();
            $table->string('prescription_picture')->nullable();
            $table->float('price')->nullable();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('food_name');
            $table->float('weight_left')->default(0);
            $table->date('date_bought')->nullable();;

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'food_name'));
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('product_name');
            $table->string('picture')->nullable();
            $table->float('weight');
            $table->float('price');
            $table->boolean('is_food');

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'product_name', 'weight'));
        });

        Schema::create('shopping_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->date('shopping_date');
            $table->string('description')->nullable();
            $table->float('price');

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('foodboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->unsignedInteger('food_id')->nullable();
            $table->string('foodbox_id');
            $table->string('foodbox_name');
            $table->boolean('synced_to_brainbox')->default(true);
            $table->dateTime('last_seen');
            $table->timestamps();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('set null')->onUpdate('cascade');

            $table->index('foodbox_id');

            $table->unique(array('user_email', 'foodbox_id'));
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('foodbox_id');
            $table->string('card_id');
            $table->string('card_name');
            $table->boolean('active')->default(true);
            $table->boolean('synced_to_brainbox')->default(false);
            $table->timestamps();

            $table->foreign(array('user_email', 'foodbox_id'))->references(array(
                'user_email',
                'foodbox_id'
            ))->on('foodboxes')->onDelete('cascade')->onUpdate('cascade');

            $table->index('card_id');

            $table->unique(array('user_email', 'card_id'));
        });

        Schema::create('admin_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('card_id');
            $table->string('card_name');
            $table->boolean('active')->default(true);
            $table->boolean('synced_to_brainbox')->default(false);
            $table->timestamps();

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(array('user_email', 'card_id'));
        });

        Schema::create('feeding_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email');
            $table->string('foodbox_id')->nullable();
            $table->string('card_id')->nullable();
            $table->string('feeding_id');
            $table->dateTime('open_time');
            $table->dateTime('close_time');
            $table->float('start_weight');
            $table->float('end_weight');

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('foodbox_id')->references('foodbox_id')->on('foodboxes')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('card_id')->references('card_id')->on('cards')->onDelete('set null')->onUpdate('cascade');

            $table->unique(array('user_email', 'foodbox_id', 'feeding_id'));
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name');
            }
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('country');
            $table->dropColumn('phone');
            $table->dropColumn('buy_food_reminder');
            $table->dropColumn('daily_reminder');
            $table->dropColumn('not_eating_reminder');

        });

        Schema::table('feeding_logs', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
            $table->dropForeign(['foodbox_id']);
            $table->dropForeign(['card_id']);
        });

        Schema::table('admin_cards', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(array('user_email', 'foodbox_id'));
        });

        Schema::table('foodboxes', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
            $table->dropForeign(['food_id']);
        });

        Schema::table('shopping_logs', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('foods', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('cats_vet_logs', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
            $table->dropForeign(['cat_id']);
        });

        Schema::table('shops', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('veterinarians', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('brainboxes', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('notification_emails', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::table('cats', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
        });

        Schema::dropIfExists('feeding_logs');
        Schema::dropIfExists('admin_cards');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('foodboxes');
        Schema::dropIfExists('shopping_logs');
        Schema::dropIfExists('products');
        Schema::dropIfExists('foods');
        Schema::dropIfExists('cats_vet_logs');
        Schema::dropIfExists('shops');
        Schema::dropIfExists('veterinarians');
        Schema::dropIfExists('brainboxes');
        Schema::dropIfExists('notification_emails');
        Schema::dropIfExists('cats');

    }
}
