<?php
namespace App;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ApiAuthorization;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(ApiAuthorization::class, function (Faker $faker) {
    return [
        'username' => 'ieltsbooking',
        'password' => Hash::make('datebooking')
    ];
});
