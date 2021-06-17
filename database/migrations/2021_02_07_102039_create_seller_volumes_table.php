<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_volumes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('volume');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('seller_product_id')->unsigned();
            $table->foreign('seller_product_id')->references('id')->on('seller_products')->onDelete('cascade');
            $table->integer('volume_id')->unsigned()->nullable();
            $table->foreign('volume_id')->references('id')->on('volumes')->onDelete('cascade');
            $table->integer('quantity')->default('1');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('seller_volumes');
    }
}
