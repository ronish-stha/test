<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('seller_product_id')->unsigned()->nullable();
            $table->foreign('seller_product_id')->references('id')->on('seller_products')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('seller_volume_id')->unsigned()->nullable();
            $table->foreign('seller_volume_id')->references('id')->on('seller_volumes')->onDelete('cascade');
            $table->integer('product_variant_id')->unsigned()->nullable();
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->float('price');
            $table->string('volume')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->boolean('available')->default(1);
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
        Schema::dropIfExists('seller_product_variants');
    }
}
