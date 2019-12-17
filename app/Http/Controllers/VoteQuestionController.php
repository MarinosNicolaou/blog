<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{   
    /**
     * Calling middleware because
     * if the user wants to vote 
     * has to log in 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * capture the vote
     */
    public function __invoke(Question $question)
    {
        $vote = (int) request()->vote;
        //this get the current user
        auth()->user()->voteQuestion($question, $vote);
        return back();
    }
}
