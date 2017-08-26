<?php

use Illuminate\Database\Seeder;
use App\Mood;

class MoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $moods = [
        	'Happy', 'Sad', 'Loved', 'Fantastic', 'Down', 'Awesome', 'Funny',
        	'Drained', 'Tensed', 'Dissapointed', 'Satisfied', 'Missing', 'Crazy', 
        	'Emotional', 'Angry', 'Alone', 'Positive', 'Peaceful', 'Thougtful', 
        	'Incomplete', 'Excited'
        ];

        foreach ($moods as $mood) {
		    Mood::insert([
		        'mood' => $mood,
		        'emo' => 'url of emo image',
		        'color' => $faker->colorName,
		        'created_at' => $faker->dateTime($max = 'now'),
		        'updated_at' => $faker->dateTime($max = 'now')
		    ]);
	    }
    }
}
