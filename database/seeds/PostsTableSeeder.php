<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

		$limit = 3;

		for ($i = 0; $i < $limit; $i++) {
		    Post::insert([
		        'body' => $faker->paragraph,
		        'user_id' => 1,
		        'categories_id' => 1,
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now')
		    ]);
	    }
	}
}
