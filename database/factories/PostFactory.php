<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'user_id' => factory(User::class),
        'title' => $faker->sentence(rand(1,4)),
        'post_image' => $faker->imageUrl('900', '300'),
        'body' => $faker->paragraph(rand(1,5), true),

    ];
});
