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
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->integer('price');
            $table->string('image');
            $table->longText('description');
            $table->string('status');
            $table->string('wholesale')->default("off");
            $table->string('wholesale_size')->nullable();
            $table->string('wholesale_price')->nullable();
            $table->string('size')->nullable();
            $table->boolean('prescription')->default(false);
            $table->integer('stock');
            $table->integer('wholesale_stock')->nullable();
            $table->integer('shipping_cost')->nullable();
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('sale_type')->nullable();
            $table->string('sale_mode')->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
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
