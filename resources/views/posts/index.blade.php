@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Posts</h2>
                        <div class="ml-auto">
                            <a href="{{ route('posts.create') }}" class="btn btn-outline-secondary">Create a Post</a>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @include ('layouts._messages')
                   @foreach ($posts as $post)
                        <div class="media">
                            <div class="d-flex flex-column counters">
<<<<<<< HEAD:resources/views/posts/index.blade.php
                                <div class="like">
                                    <strong>{{ $post->likes }}</strong> {{ str_plural('like', $post->likes) }}
=======
                                <div class="vote">
                                    <strong>{{ $question->votes_count }}</strong> {{ str_plural('vote', $question->votes_count) }}
>>>>>>> v16:resources/views/questions/index.blade.php
                                </div>                            
                                <div class="status {{ $post->status }}">
                                    <strong>{{ $post->comments_count }}</strong> {{ str_plural('comment', $post->comments_count) }}
                                </div>                            
                                <div class="view">
                                    {{ $post->views . " " . str_plural('view', $post->views) }}
                                </div>                            
                            </div>

                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0">
                                        <a href="{{ $post->url }}">{{ $post->title }}
                                    </h3>
                                    <div class="ml-auto">
                                        @if(Auth::check() && Auth::user()->can('update-post', $post))
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endif

                                        @if(Auth::check() && Auth::user()->can('delete-post', $post))
                                        <form class="form-delete" method="post" action="{{ route('posts.destroy', $post-> id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete it')">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>

                                <p class="lead">
                                    Posted by
                                    <a href="{{ $post->user->url }}">{{ $post->user->name }}</a> 
                                    <small class="text-muted">{{ $post->created_date }}</small>
                                </p>
                                {{ str_limit($post->body, 250) }}
                            </div>                        
                        </div>
                        <hr>
                   @endforeach

                    <div class="mx-auto">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection