<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\AskPostRequest;


class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show the latest 5 posts per page
        $posts = Post::with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Post();
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskPostRequest  $request)
    {
        $request->user()->posts()->create($request->only('title', 'body'));

        return redirect()->route('posts.index')->with('success', "Post submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->increment('views');
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (\Gate::denies('update-post', $post)) {
            abort(403, "Access denied");
        }
        return view("posts.edit", compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskPostRequest $request, Post $post)
    {
        if (\Gate::denies('update-post', $post)) {
            abort(403, "Access denied");
        }

        $post->update($request->only('title', 'body'));

        return redirect('/posts')->with('success', "Post updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (\Gate::denies('delete-post', $post)) {
            abort(403, "Access denied");
        }
        
        $post->delete();
        return redirect('/posts')->with('success', "Post deleted.");

    }
}
