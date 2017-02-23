

use App\User;
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < Config::get('seeding.users') ; $i++) { 
            $user = User::create([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt($faker->randomElement(['temp1234', 'moti1234'])),
                    'active' => $i === 0 ? true : rand(0, 1),
                    'gender' => rand(0, 1) ? 'male' : 'female',
                    'timezone' => rand(-10, 10),
                    'birthday' => rand(0, 1) ? $faker->dateTimeBetween('-40 years', '-18years') : null,
                    'location' => rand(0, 1) ? "{$faker->city}, {$faker->state}" : null,
                    'had_feedback_email' => (bool) rand(0, 1),
                    'sync_name_bio' => (bool) rand(0, 1),
                    'bio' => $faker->sentence(100),
                    'picture_url' => $faker->imageUrl($width = 640, $height = 480)
                ]);
        }
    }
}