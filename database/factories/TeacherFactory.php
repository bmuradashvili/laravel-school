<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Teacher;
use App\Position;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'position_id' => function() {
            return factory(Position::class)->create()->id;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'biography' => $faker->realText($faker->numberBetween(150,200)),
        'certified' => $faker->boolean(50),
    ];
});
