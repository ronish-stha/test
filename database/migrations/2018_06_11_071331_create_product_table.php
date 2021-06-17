<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('code')->nullable();
            $table->float('price')->default(0)->nullable();
            $table->float('least_price')->default(0)->nullable();
            $table->float('max_price')->default(0)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('available')->nullable();
            $table->boolean('featured')->default(0);
            $table->integer('discount')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->boolean('is_rejected')->default(0);
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
