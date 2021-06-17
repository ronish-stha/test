<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTableMigration extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('position', false, true);
            $table->integer('real_depth', false, true);
            $table->string('slug')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });

        Schema::create('category_closure', function (Blueprint $table) {
            $table->increments('closure_id');

            $table->integer('ancestor', false, true);
            $table->integer('descendant', false, true);
            $table->integer('depth', false, true);

            $table->foreign('ancestor')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('category_closure', function (Blueprint $table) {
            Schema::dropIfExists('category_closure');
        });

        Schema::table('categories', function (Blueprint $table) {
            Schema::dropIfExists('categories');
        });
    }
}
