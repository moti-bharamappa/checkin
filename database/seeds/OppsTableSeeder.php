<?php

use App\Opp;
use App\Place;
use App\Image;
use App\Category;
use App\Merchant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OppsTableSeeder extends Seeder
{
    protected $category;

    protected $places;

    protected $imageArray = [
            'http://example.com/images/example1.jpg',
            'http://example.com/images/example2.jpg',
            'http://example.com/images/example3.jpg',
            'http://example.com/images/example4.jpg'
        ];

    public function __construct(Category $category, Place $places)
    {
        $this->category = $category;
        $this->places = $places;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (Merchant::all() as $merchant) {
            foreach(range(1, rand(2, 4)) as $i) {
                $image = Image::create([
                        'name' => "{$merchant->name} Image #{$i}",
                        'url' => $faker->randomElement($this->imageArray)
                    ]);
                $starts = Carbon::now();
                if ($i == 1) {
                    $ends = Carbon::now()->addDays(2);
                    $teaser = "Something about cheese";
                } else {
                    $ends = Carbon::now()->addDays(60);
                    $teaser = $faker->sentence(rand(5, 3));
                }
                $category = Category::orderBy(\DB::raw('RAND()'))->first();
                $opp = Opp::create([
                        'name' => $faker->sentence(rand(5, 3)),
                        'teaser' => $teaser,
                        'details' => $faker->paragraph(3),
                        'starts' => $starts->format('Y-m-d H:i:s'),
                        'ends' => $ends->format('Y-m-d H:i:s'),
                        'category_id' => $category->id,
                        'merchant_id' => $merchant->id,
                        'published' => true
                    ]);
                // $opp->images()->attach($image, ['published' => true]);
                echo "$i opps for $merchant->name \n";
            }
        }
    }
}
