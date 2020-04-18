<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->define(stallowner::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'birthday' => $faker->date,
        'class' => $faker->randomElement($array=array('A','B','C')),
        'stall_number' => Str::random(2),
        'profile_image' => 'stallowner5debec7b0bdf4071219.png',
        'date_of_contract' => now(),
        'renewal_date' => now(),
        'payment' => $faker->randomElement($array=array('Paid','Unpaid')),
        'remember_token' => Str::random(10),
    ];
});
