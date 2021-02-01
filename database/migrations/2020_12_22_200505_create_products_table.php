<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('sub_category_id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->mediumText('small_description');
            $table->string('image')->nullable();

            $table->string('highlight_heading')->nullable();
            $table->longText('p_highlights')->nullable();
            $table->string('description_heading')->nullable();
            $table->longText('p_description')->nullable();
            $table->string('details_heading')->nullable();
            $table->longText('p_details')->nullable();

            $table->string('sale_tag',50)->nullable();
            $table->integer('original_price')->nullable();
            $table->integer('offer_price')->nullable();
            $table->integer('quantity');
            $table->integer('priority')->nullable();

            $table->tinyInteger('new_arrival')->default('0');
            $table->tinyInteger('featured_products')->default('0');
            $table->tinyInteger('popular_products')->default('0');
            $table->tinyInteger('offer_products')->default('0');
            $table->tinyInteger('status')->default('0');

            $table->mediumText('meta_title')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->mediumText('meta_keyword')->nullable();

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
        Schema::dropIfExists('products');
    }
}
