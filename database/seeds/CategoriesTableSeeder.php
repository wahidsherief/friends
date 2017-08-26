<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

		$limit = 33;

		for ($i = 0; $i < $limit; $i++) {
		    Category::insert([ //,
		        'category' => $faker->catchPhrase,
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now')
		    ]);
	    }
    }
}
