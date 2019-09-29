<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Position;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Position::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->jobTitle,
    ];
});
