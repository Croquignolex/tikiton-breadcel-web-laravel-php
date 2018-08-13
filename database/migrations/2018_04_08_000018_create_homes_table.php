<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_1', 255);
            $table->string('banner_extension_1', 50)->default('jpg');
            $table->string('banner_2', 255);
            $table->string('banner_extension_2', 50)->default('jpg');
            $table->string('banner_3', 255);
            $table->string('banner_extension_3', 50)->default('jpg');
            $table->string('offer_1', 255);
            $table->string('offer_extension_1', 50)->default('jpg');
            $table->string('offer_2', 255);
            $table->string('offer_extension_2', 50)->default('jpg');
            $table->string('offer_3', 255);
            $table->string('offer_extension_3', 50)->default('jpg');
            $table->string('offer_4', 255);
            $table->string('offer_extension_4', 50)->default('jpg');
            $table->string('magic', 255);
            $table->string('magic_extension', 50)->default('jpg');
            $table->string('fr_banner_1_text_1', 255);
            $table->string('fr_banner_1_text_2', 255);
            $table->string('fr_banner_2_text_1', 255);
            $table->string('fr_banner_2_text_2', 255);
            $table->string('fr_banner_3_text_1', 255);
            $table->string('fr_banner_3_text_2', 255);
            $table->string('fr_offer_1_text_1', 255);
            $table->string('fr_offer_1_text_2', 255);
            $table->string('fr_offer_2_text_1', 255);
            $table->string('fr_offer_2_text_2', 255);
            $table->string('fr_offer_3_text_1', 255);
            $table->string('fr_offer_3_text_2', 255);
            $table->string('fr_offer_4_text_1', 255);
            $table->string('fr_offer_4_text_2', 255);
            $table->string('fr_magic_header', 255);
            $table->string('fr_magic_title', 255);
            $table->string('fr_magic_description', 255);
            $table->string('en_banner_1_text_1', 255);
            $table->string('en_banner_1_text_2', 255);
            $table->string('en_banner_2_text_1', 255);
            $table->string('en_banner_2_text_2', 255);
            $table->string('en_banner_3_text_1', 255);
            $table->string('en_banner_3_text_2', 255);
            $table->string('en_offer_1_text_1', 255);
            $table->string('en_offer_1_text_2', 255);
            $table->string('en_offer_2_text_1', 255);
            $table->string('en_offer_2_text_2', 255);
            $table->string('en_offer_3_text_1', 255);
            $table->string('en_offer_3_text_2', 255);
            $table->string('en_offer_4_text_1', 255);
            $table->string('en_offer_4_text_2', 255);
            $table->string('en_magic_header', 255);
            $table->string('en_magic_title', 255);
            $table->string('en_magic_description', 255);
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
        Schema::dropIfExists('homes');
    }
}
