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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'nama' => $faker->nama,
        'jabatan' => $faker->jabatan,
        'email' => $faker->safeEmail,
        'status' => $faker->status,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'foto' => $faker->foto
    ];
});