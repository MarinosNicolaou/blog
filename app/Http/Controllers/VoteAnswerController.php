<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class VoteAnswerController extends Controller
{   
    /**
     * Call middlewate to check 
     * ig the user is log in
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;
        //get current user
        auth()->user()->voteAnswer($answer, $vote);
        return back();
    }
}
