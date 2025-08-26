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
            $table->id();
            $table->integer('admin_id');
            $table->string('name');
            $table->string('slug');
            $table->string('code')->nullable();
            $table->string('sku')->nullable();

            $table->double('buying_price', 15, 8)->nullable();
            $table->double('sell_price', 15, 8)->nullable();
            $table->string('discount')->nullable();
            $table->double('discount_price', 15, 8)->nullable();

            $table->integer('qty')->nullable();
            $table->integer('total_sell')->nullable();
            $table->integer('total_product')->nullable();

            $table->integer('min_order_qty')->nullable();
            $table->integer('max_order_qty')->nullable();

            $table->string('warranty')->nullable();
            $table->string('description')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_des')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->string('image')->nullable();
            $table->string('product_image_thumb')->nullable();
            $table->string('product_image_medium')->nullable();
            $table->string('product_image_small')->nullable();
            $table->string('product_image_large')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_des')->nullable();
            
            $table->string('note')->nullable();
            $table->integer('status');
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
