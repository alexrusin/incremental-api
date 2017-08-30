<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(
        	[
        		'name' => 'Alex',
        		'password' => bcrypt('password'),
        		'email' => 'alex@alex.com'
        	]
        	);
    }
}
