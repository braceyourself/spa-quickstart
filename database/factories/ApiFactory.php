<?php

use App\ApiAuthType;
use Faker\Generator as Faker;

$factory->define(App\Api::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
		'base_url' => $faker->url,
		'auth_type_id' => factory(ApiAuthType::class)->create()->id,
		'callback_url' => $faker->url,
		'bearer' => "Bearer"
    ];
});
