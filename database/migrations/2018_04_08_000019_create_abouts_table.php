<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255);
            $table->string('extension', 50)->default('jpg');
            $table->string('fr_about_section_1_normal_zone', 255);
            $table->string('fr_about_section_1_important_zone', 255);
            $table->string('fr_about_section_2_normal_zone', 255);
            $table->string('fr_about_section_2_important_zone', 255);
            $table->string('en_about_section_1_normal_zone', 255);
            $table->string('en_about_section_1_important_zone', 255);
            $table->string('en_about_section_2_normal_zone', 255);
            $table->string('en_about_section_2_important_zone', 255);
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
        Schema::dropIfExists('abouts');
    }
}
