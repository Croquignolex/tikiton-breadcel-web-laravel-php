<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('image', 255);
            $table->string('fr_name', 255);
            $table->string('en_name', 255);
            $table->string('fr_featured_title', 255)->nullable();
            $table->string('en_featured_title', 255)->nullable();
            $table->text('fr_description');
            $table->text('en_description');
            $table->text('fr_featured_description')->nullable();
            $table->text('en_featured_description')->nullable();
            $table->double('price');
            $table->smallInteger('discount')->default(0);
            $table->tinyInteger('ranking')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
