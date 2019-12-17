@csrf
    <div class="form-group">
        <label for="post-title">Post Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" id="post-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
        
        @if ($errors->has('title'))
        <div class="invalid-feedback">
           <strong>{{ $errors->first('title') }}</strong>
        </div>
        @endif
    </div>
                        
        <div class="form-group">
            <label for="post-body">Explain what do you think!!!</label>
            <textarea name='body' id='post-body' value="{{old('body')}}" class="form-control {{$errors->has('body')? 'is-invalid':''}}" rows="10">{{$post->body}}</textarea>
            @if ($errors->has('body'))
                <div class="invalid-feedback">
                     <strong>{{ $errors->first('body') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group">
             <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
        </div>