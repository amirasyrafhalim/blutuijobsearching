<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Job;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Job::class, function (Faker $faker) {
    return [
        'user_id' => function() { return factory(App\User::class)->create()->id; },
        'category' => Job::CATEGORY_DEFAULT,
        'title' => Str::limit($faker->text, 25),
        'description' => $faker->paragraph,
        'status' => Job::STATUS_PUBLISHED,
        'price' => $faker->numberBetween(1, 1000)
    ];
});
