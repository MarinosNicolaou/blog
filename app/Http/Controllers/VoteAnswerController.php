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
        $votesCount = auth()->user()->voteAnswer($answer, $vote);


        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Thanks for the feedback',
                'votesCount' => $votesCount
            ]);
            }

        return back();
    }
}
