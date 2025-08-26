<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('invoice_id');
            $table->integer('shipping_address_id');
            $table->integer('billing_address_id');
            $table->integer('total_qty');
            $table->decimal('total_cost', 15, 2);
            $table->decimal('discount', 15, 2)->nullable();;
            $table->string('coupone_code')->nullable();;
            $table->string('shipping_charge')->nullable();;
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
