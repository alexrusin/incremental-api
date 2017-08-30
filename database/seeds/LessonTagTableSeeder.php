<?php

use App\Lesson;
use App\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

    	$lessonsIds = Lesson::pluck('id')->all();
    	$tagsIds = Tag::pluck('id')->all();
       	

       	foreach (range(1, 30) as $index) {

       		DB::table('lesson_tag')->insert([
       			'lesson_id' => $faker->randomElement($lessonsIds),
       			'tag_id' => $faker->randomElement($tagsIds)
       		]);

       	}
    }
}
