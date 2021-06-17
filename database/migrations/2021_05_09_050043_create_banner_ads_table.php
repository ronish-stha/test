<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Coupon Codes
        Schema::create('banner_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('heading1');
            $table->string('heading2');
            $table->string('image');
            $table->integer('discount')->default(0);
            $table->string('offer')->nullable();
            $table->boolean('status')->default(0);
            $table->string('type');
            $table->string('code')->unique();
            $table->date('expiry_date')->nullable();
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
        Schema::dropIfExists('banner_ads');
    }
}
