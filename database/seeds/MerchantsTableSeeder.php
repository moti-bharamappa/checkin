<?php

use App\Merchant;
use Illuminate\Database\Seeder;

class MerchantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < Config::get('seeding.merchants'); $i++) { 
            $merchant = Merchant::create([
                    'name' => $faker->company,
                    'website' => $faker->url,
                    'phone' => $faker->phoneNumber,
                    'description' => $faker->text(200)
                ]);
        }
    }
}
