<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Director;
use App\Position;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Director::class, function (Faker $faker) {
    return [
        'position_id' => function() {
            return factory(Position::class)->create()->id;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'biography' => $faker->realText($faker->numberBetween(150,200)),
    ];
});
