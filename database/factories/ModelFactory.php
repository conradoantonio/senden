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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	'user_type_id' => function () {
            return factory(App\UserType::class)->create()->id;
        },
		'business_id' => function () {
            return factory(App\Business::class)->create()->id;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
		'photo' => 'img/default.jpg',
		'street' => $faker->streetName,
		'ext_number' => $faker->buildingNumber,
		'int_number' => $faker->buildingNumber,
		'colony' => $faker->city,
		'municipality' => $faker->city,
		'state' => $faker->country,
		'postal_code' => $faker->postcode,
		'isPanelUser' => $faker->boolean,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\UserType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Business::class, function (Faker\Generator $faker) {
    return [
		'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
        'tradename' => $faker->company,
        'latitude' => $faker->latitude,
		'longitude' => $faker->longitude,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});