<?php

use App\Place;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < Config::get('seeding.places'); $i++) { 
            $places = Place::create([
                    'name' => $faker->company,
                    'lat' => $faker->latitude,
                    'long' => $faker->longitude,
                    'address1' => $faker->streetAddress,
                    'address2' => $faker->country,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip' => $faker->postcode,
                    'website' => $faker->url,
                    'phone' => $faker->phoneNumber
                ]);
        }
    }
}
