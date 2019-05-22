<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['none','oauth','basic','key']),
		'description' => $faker->sentence
    ];
});
