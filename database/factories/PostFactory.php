<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
  
        return [
            'title' => $faker->word(),
            'desc' => $faker->sentence(),
            'user_id' => random_int(1,30),
            'like' => 0,
            'dislike' => 0   
        ];

});
