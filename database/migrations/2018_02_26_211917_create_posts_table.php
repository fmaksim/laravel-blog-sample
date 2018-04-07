<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->text('content')->nullable(false);
            $table->string('title')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->string('image')->nullable(true);
            $table->integer('category_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('views')->default(0);
            $table->integer('status')->default(0);
            $table->integer('is_featured')->default(0);

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
        Schema::dropIfExists('posts');
    }
}
