<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraphs(rand(2, 5), true),
        //random user for diff comments 
        'user_id' =>  App\User::pluck('id')->random(),
        'likes_count' => rand(0, 5),
    ];
});
