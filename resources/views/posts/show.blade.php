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
                            <a title="Post is useful" class="vote-up">
                                <i class="fas fa-thumbs-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="Post is not useful" class="vote-down off">
                                <i class="fas fa-thumbs-down fa-3x"></i>
                            </a>
                            <a title="Mark as favorite post (Click again to undo)" class="favorite mt-2 favorited">
                                <i class="fas fa-heart fa-2x"></i>
                                <span class="favorites-count">123</span>
                            </a>
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