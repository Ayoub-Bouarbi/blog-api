<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'description' => $faker->text,
        'published' => $faker->boolean,
        'user_id' => rand(1,20),
        'category_id' => rand(1,20),
        'featured' => $faker->boolean,
        'enable_comments' => $faker->boolean,
        'views' => rand(0,1000),
    ];
});
