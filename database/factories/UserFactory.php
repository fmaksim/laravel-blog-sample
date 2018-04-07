<?php

use Faker\Generator as Faker;
use App\Entities\Post;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Entities\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->text(2000),
        'description' => $faker->text(300),
        'image' => 'default.jpg',
        'category_id' => $faker->numberBetween(1,5),
        'user_id' => 1,
        'views' => $faker->numberBetween(10, 5000),
        'status' => 1,
        'is_featured' => 0,
        'date' => '25/03/18'
    ];
});


$factory->define(\App\Entities\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});