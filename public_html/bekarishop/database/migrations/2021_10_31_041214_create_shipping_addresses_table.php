<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('order_id');
            $table->string('s_fname')->nullable();
            $table->string('s_lname')->nullable();
            $table->string('s_address')->nullable();
            $table->string('s_address2')->nullable();
            $table->string('s_city')->nullable();
            $table->string('s_zipcode')->nullable();
            $table->string('s_phone')->nullable();
            $table->string('s_email')->nullable();
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
        Schema::dropIfExists('shipping_addresses');
    }
}
