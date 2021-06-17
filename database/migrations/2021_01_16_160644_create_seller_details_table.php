<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('store_name')->unique();
            $table->string('owner_name')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('business_registration')->nullable();
            $table->string('description')->nullable();
//            $table->string('pan_vat')->nullable();
//            $table->string('citizenship')->nullable();
            $table->timestamp('verified_at')->nullable();
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
        Schema::dropIfExists('seller_details');
    }
}
