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
            $user->posts()
                ->saveMany(
                    factory(App\Post::class,rand(1,3))->make()
                )
                //this will create comments for posts
                ->each(function ($q) {
                $q->comments()->saveMany(factory(App\Comment::class, rand(2, 5))->make());
                });
        });
        
    }
}
