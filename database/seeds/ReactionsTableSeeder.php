<?php

use Illuminate\Database\Seeder;
use FrancescoMalatesta\LaravelReactions\Models\Reaction;

class ReactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $reactions = [
        	'like', 'love', 'sad', 'wow', 'angry'
        ];

        foreach ($reactions as $reaction) {
		    Reaction::insert([
		        'name' => $reaction,
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now')
		    ]);
	    }
    }
}
