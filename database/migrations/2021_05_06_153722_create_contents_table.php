<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('heading1')->nullable();
            $table->string('heading2')->nullable();
            $table->string('heading3')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->text('content1')->nullable();
            $table->text('content2')->nullable();
            $table->text('content3')->nullable();
            $table->string('url1')->nullable();
            $table->string('url2')->nullable();
            $table->string('button1')->nullable();
            $table->string('button2')->nullable();
            $table->integer('position')->nullable();
            $table->string('page')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
