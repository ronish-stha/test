<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('discount_percentage', 10, 2)->nullable();
            $table->decimal('service_charge', 10, 2)->nullable();
            $table->decimal('service_charge_percentage', 10, 2)->nullable();
            $table->decimal('shipping', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('status')->default('new');
            $table->boolean('payment_status')->default(0);
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
        Schema::dropIfExists('seller_orders');
    }
}
