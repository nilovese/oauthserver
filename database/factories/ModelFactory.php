<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt("c0mm0n"),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\OauthClient::class, function (Faker\Generator $faker) {
    return [
            'id' => rand(10,100),
        'secret' => bcrypt($faker->word()),
          'name' => $faker->word(),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
          'title' => $faker->sentence($nbWords = 6),
        'content' => $faker->paragraph($nbSentences = 3)
    ];
});
