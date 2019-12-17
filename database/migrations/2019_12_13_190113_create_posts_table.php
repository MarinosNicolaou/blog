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
            $table->bigIncrements('id');
            $table->string('title');
             //Slug is basicallt the title and basically it is to constructed and make pretty URL
             $table->string('slug')->unique();
             $table->text('body');
             //How many times the post has been viewed and it is 
             //unsignedInteger because after creation nobady has view it yet
             $table->unsignedInteger('views')->default(0);
             //How many comments and it the same with views
             $table->unsignedInteger('comments')->default(0);
             //likes are integer because the can be negative
             $table->integer('likes')->default(0);
             //The creator of the post can choose a comment to be the best or not
             $table->unsignedInteger('best_comment_id')->nullable();
             $table->unsignedBigInteger('user_id');
             $table->timestamps();
 
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
 
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
