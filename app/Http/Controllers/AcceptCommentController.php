<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class AcceptCommentController extends Controller
{   
    /**
     * this method authorize
     * the user that have created the post
     * to choose a comment to be
     * as the best 
     * 
     */
    public function __invoke(Comment $comment)
    {
        $this->authorize('accept', $comment);
        $comment->post->acceptBestAnswer($comment);
        
        return back();
    }
}
