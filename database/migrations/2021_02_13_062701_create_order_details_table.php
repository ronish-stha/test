<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('seller_order_id')->unsigned();
            $table->foreign('seller_order_id')->references('id')->on('seller_orders')->onDelete('cascade');
            $table->integer('product_variant_id')->unsigned();
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('discount_percentage', 10, 2)->nullable();
            $table->decimal('service_charge', 10, 2)->nullable();
            $table->decimal('service_charge_percentage', 10, 2)->nullable();
            $table->string('status')->default('new');
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
        Schema::dropIfExists('order_details');
    }
}
