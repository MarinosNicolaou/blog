<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use App\Answer;

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //return all collections of user instance
        $users = User::all();
        //how many users are there
        $numberOfUsers = $users->count();
        //the possible votes
        $votes = [-1, 1];

        foreach (Question::all() as $question)
        {   
            //every single question will be voted up or be voted down
            //by at least one user 
            for ($i = 0; $i < rand(1, $numberOfUsers); $i++)
            {
                $user = $users[$i];
                //user vote question
                $user->voteQuestion($question, $votes[rand(0, 1)]);
            }
        }
        foreach (Answer::all() as $answer)
        {
            for ($i = 0; $i < rand(1, $numberOfUsers); $i++)
            {
                $user = $users[$i];
                $user->voteAnswer($answer, $votes[rand(0, 1)]);
            }
        }
    
    }
}
