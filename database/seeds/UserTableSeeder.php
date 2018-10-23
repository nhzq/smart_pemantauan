<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 1000; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => 'admin' . $i . '@email.com',
                'password' => bcrypt('123456')
            ]);
        }
    }
}
