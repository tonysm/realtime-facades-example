<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SourceProvider;
use App\User;
use Faker\Generator as Faker;

$factory->define(SourceProvider::class, function (Faker $faker) {
    return [
        'type' => 'Github',
        'name' => $faker->word,
        'meta' => [
            'token' => env('GITHUB_TEST_TOKEN'),
        ],
        'user_id' => factory(User::class),
    ];
});
