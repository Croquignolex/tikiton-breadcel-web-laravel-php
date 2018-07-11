<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('password',255);
            $table->string('token', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('address', 255)->nullable();
            $table->string('post_code', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('shipping_address', 255)->nullable();
            $table->string('shipping_post_code', 255)->nullable();
            $table->string('shipping_city', 255)->nullable();
            $table->string('shipping_country', 255)->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_super_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
