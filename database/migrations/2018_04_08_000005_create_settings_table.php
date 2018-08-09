<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 255)->unique();
            $table->string('slogan', 255)->nullable();
            $table->string('address_1', 255)->nullable();
            $table->string('address_2', 255)->nullable();
            $table->string('phone_1', 255)->nullable();
            $table->string('phone_2', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('googleplus', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->boolean('receive_email_from_contact')->default(true);
            $table->boolean('receive_email_from_new_order')->default(true);
            $table->boolean('receive_email_from_canceled_order')->default(true);
            $table->boolean('receive_email_from_register')->default(true);
            $table->boolean('is_activated')->default(false);
            $table->double('tva')->default(19.25);
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
        Schema::dropIfExists('settings');
    }
}
