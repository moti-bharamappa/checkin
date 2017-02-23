<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() == 'production') {
            exit('I just stopped you from getting fired, Love Moti');
        }
        Eloquent::unguard();
        $tabels = ['users'];
        foreach ($tabels as $table) {
            DB::table($table)->truncate();
        }
        $this->call(UsersTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(MerchantsTableSeeder::class);
        $this->call(OppsTableSeeder::class);
    }
}
