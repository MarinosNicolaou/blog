<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //get user id 
        $users = User::pluck('id')->all();
        //count all users
        $numberOfUsers = count($users);
        /**
         * iterate the questions
         * Make every question to be favourited by at least one user
         */
        foreach (Question::all() as $question)
        {
            for ($i = 0; $i < rand(1, $numberOfUsers); $i++)
            {   
                //get random user
                $user = $users[$i];
                //attach the question to favourated by a user
                $question->favorites()->attach($user);
            }
        }
    }
}
