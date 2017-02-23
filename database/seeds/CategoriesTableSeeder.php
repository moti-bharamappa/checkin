<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Config::get('seeding.categories') as $category) {
            $category = Category::create([
                    'name' => $category,
                    'display_name' => ucwords(str_ireplace('_', ' ', $category))
                ]);
        }
    }
}
