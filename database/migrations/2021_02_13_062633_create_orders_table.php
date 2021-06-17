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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('shipping', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('discount_percentage', 10, 2)->nullable();
            $table->decimal('service_charge', 10, 2)->nullable();
            $table->decimal('service_charge_percentage', 10, 2)->nullable();
            $table->text('note')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('zone')->nullable();
            $table->string('status')->default('new');
            $table->boolean('payment_status')->default(0);
            $table->string('payment_type');
            $table->timestamp('due-date')->nullable();
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
