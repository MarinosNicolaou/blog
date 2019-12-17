<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 10)->create()->each(function($user){
            $user->questions()
                ->saveMany(
                    factory(App\Question::class,rand(1,3))->make()
                )
                //this will create answers for questions
                ->each(function ($q) {
                $q->answers()->saveMany(factory(App\Answer::class, rand(2, 5))->make());
                });
        });
        
    }
}
