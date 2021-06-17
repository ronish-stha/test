<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('code')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('available')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('status')->default('incomplete');
            $table->string('image')->nullable();
            $table->boolean('is_rejected')->default(0);
            $table->text('rejection_message')->nullable();
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
        Schema::dropIfExists('seller_products');
    }
}
