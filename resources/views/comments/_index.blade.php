<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $commentsCount . " " . str_plural('Comment', $commentsCount) }}</h2>
                    </div>
                    <hr>
                    @include ('layouts._messages')
                    @foreach ($comments as $comment)
                        <div class="media">
                            <div class="d-fex flex-column vote-controls">
                                <a title="Comment is useful" class="vote-up">
                                    <i class="fas fa-thumbs-up fa-3x"></i>
                                </a>
                                <span class="likes-count">1230</span>
                                <a title="Comment is not useful" class="vote-down off">
                                    <i class="fas fa-thumbs-down fa-3x"></i>
                                </a>
                                <a title="Comment is the best" class="{{ $comment->status }} mt-2">
                                    <i class="fas fa-check fa-2x"></i>                                    
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $comment->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @can ('update', $comment)
                                                <a href="{{ route('posts.comments.edit', [$post->id, $comment->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                            @endcan
                                            @can ('delete', $comment)
                                                <form class="form-delete" method="post" action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete it?')">Delete</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <span class="text-muted">Comented {{ $comment->created_date }}</span>
                                        <div class="media mt-2">
                                            <a href="{{ $comment->user->url }}" class="pr-2">
                                                <img src="{{ $comment->user->avatar }}">
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $comment->user->url }}">{{ $comment->user->name }}</a>
                                            </div>
                                        </div>
                                </div>
                                </div>
                               
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>