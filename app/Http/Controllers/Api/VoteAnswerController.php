<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Answer;
use App\Http\Controllers\Controller;


class VoteAnswerController extends Controller
{   
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
