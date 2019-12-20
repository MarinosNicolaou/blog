<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    /**
     * authorise the user that
     * has created the post to 
     * choose an answers as tje
     * best answer
     */
    public function __invoke(Answer $answer)
    {   
        //authorization for only the creator of the post
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);

            return response()->json([
                'message' => "You have accepted this answer as best answer"
            ]);
    }
}
