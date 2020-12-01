<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'approved' => $faker->boolean,
        'user_id' => rand(1,20),
        'post_id' => rand(1,20),
    ];
});
