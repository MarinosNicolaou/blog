<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
             //Slug is basicallt the title and basically it is to constructed and make pretty URL
             $table->string('slug')->unique();
             $table->text('body');
             //How many times the post has been viewed and it is 
             //unsignedInteger because after creation nobady has view it yet
             $table->unsignedInteger('views')->default(0);
             //How many answers and it the same with views
             $table->unsignedInteger('answers')->default(0);
             //votes are integer because the can be negative
             $table->integer('votes')->default(0);
             //The creator of the post can choose an anwser to be the best or not
             $table->unsignedInteger('best_answers_id')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
