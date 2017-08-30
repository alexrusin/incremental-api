<?php

use Illuminate\Database\Capsule\Eloquent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    private $tableNames = ['lessons', 'tags', 'lesson_tag', 'users'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	$this->cleanTables();
        $this->call(LessonsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(LessonTagTableSeeder::class);
        $this->call(UsersSeeder::class);
    }

    private function cleanTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        foreach($this->tableNames as $table) {
             DB::table($table)->truncate();
        }
       
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
