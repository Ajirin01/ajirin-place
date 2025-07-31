<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('user_email');
            $table->integer('order_number');
            $table->integer('order_total');
            $table->string('payment_method');
            $table->string('sale_mode')->nullable();
            $table->longText('shipping_details');
            $table->longText('cart');
            $table->string('status')->default('pending');
            $table->boolean('pickup')->default(false);
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
