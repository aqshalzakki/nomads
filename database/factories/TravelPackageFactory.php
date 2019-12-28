<?php

/** 
	@var \Illuminate\Database\Eloquent\Factory $factory 
*/

use App\TravelPackage;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(TravelPackage::class, function (Faker $faker) { 
    return [
        'title'      	 => $faker->city,
        'slug'			 => Str::slug($faker->city),
        'location'   	 =>"{$faker->city}, $faker->countryCode",
        'about'	     	 => $faker->realText(110, 2),
        'featured_event' => "Travels",
        'language'		 => $faker->country,
        'foods'			 => 'Nasi Goreng',
        'departure_date' => $faker->date(),
        'duration'	     => "{$faker->numberBetween(1, 7)}D {$faker->numberBetween(1, 7)}N",
        'type'			 => $faker->randomElement(['Open Trip', 'Closed Trip']),
        'price'			 => $faker->numberBetween(100, 500)
    ];
});
