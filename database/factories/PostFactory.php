<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        //use rtrim to remove the dot(.)at the end of a sentence
        'title' => rtrim($faker->sentence(rand(5, 15)),"."),
        //use true at the end to seperaed each paragraphs with a new line
        'body' =>$faker->paragraphs(rand(3,6), true),
        'views' => rand(0,10),
        'comments_count' => rand(0,10),
        //A comment can have negative votes so we generate some random negative number
        'likes' => rand(-2,10)
    ];
});
