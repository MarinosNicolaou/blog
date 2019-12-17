@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $post->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Back to Posts</a>
                            </div>
                        </div>                        
                    </div>

                    <hr>

                    <div class="media">
                        <div class="d-fex flex-column vote-controls">
<<<<<<< HEAD:resources/views/posts/show.blade.php
                            <a title="Post is useful" class="vote-up">
                                <i class="fas fa-thumbs-up fa-3x"></i>
                            </a>
                            <span class="likes-count">1230</span>
                            <a title="Post is not useful" class="vote-down off">
                                <i class="fas fa-thumbs-down fa-3x"></i>
                            </a>
                            <a title="Mark as favorite post (Click again to undo)" class="favorite mt-2 favorited">
=======
                            <a title="Question is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();">
                                
                                <i class="fas fa-thumbs-up fa-3x"></i>
                            </a>

                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count">{{ $question->votes_count }}</span>
                            <a title="Question is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();"
                            >
                                <i class="fas fa-thumbs-down fa-3x"></i>
                            </a>

                            <form id="down-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <a title="Click to mark as favorite question (Click again to undo)" 
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();"
                                >
>>>>>>> v16:resources/views/questions/show.blade.php
                                <i class="fas fa-heart fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
                            <form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display:none;">
                                @csrf
                                @if ($question->is_favorited)
                                    @method ('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            {!! $post->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Commented {{ $post->created_date }}</span>
                                <div class="media mt-2">
                                    <a href="{{ $post->user->url }}" class="pr-2">
                                        <img src="{{ $post->user->avatar }}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $post->user->url }}">{{ $post->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('comments._index', [
        'comments'=> $post->comments,
        'commentsCount' => $post->comments_count,
    ])
    @include ('comments._create')
</div>
@endsection