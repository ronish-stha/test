<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('zone')->nullable();
            $table->string('phone', '20')->nullable();
            $table->string('phone2', '20')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('verified')->default(0);
            $table->boolean('document')->default(0);
            $table->integer('user_type_id')->nullable();
            $table->double('lat', 20)->nullable();
            $table->double('lng', 20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
