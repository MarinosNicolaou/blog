<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;


class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        $post->comments()->create( $request->validate ([
            'body' => 'required'
        ]) + ['user_id' => \Auth::id()]);
        return back()->with('success', "Comment submitted ");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post,  Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('comments.edit', compact('post', 'comment'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validate([
            'body' => 'required',
        ]));


        return redirect()->route('posts.show', $post->slug)->with('success', 'Comment updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', "Comment removed");
    }
}
