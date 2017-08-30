<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

		$limit = 10;

		for ($i = 0; $i < $limit; $i++) {
		    User::insert([ //,
		        'email' => $faker->email,
		        'firstname' => $faker->name,
		        'lastname' => $faker->name,
		        'password' => bcrypt('12345'),
		        'bio' => 'demo bio',
		        'bday' => '06',
		        'bmonth' => '08',
		        'byear' => '1990',
		        'gender' => 'male',
		        'religion' => 'islam',
		        'profile_pic' => '',
		        'cover_pic' => '',
		        'about' => 'demo about',
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now')
		    ]);
	    }
	}
}
