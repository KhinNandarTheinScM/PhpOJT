<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unsigned(false);
            $table->string('title', 225);
            $table->string('description');
            $table->integer('status')->default('1');
            $table->integer('create_user_id');
            $table->foreign('create_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('updated_user_id');
            $table->foreign('updated_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('deleted_user_id')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
