@extends('layouts.app')

@section('title', 'Edit Your Reply')

@section('content')
    <div class="card w-50 mx-auto mt-4 p-4">
        <form action="{{ route('comments.replies.update', ['comment' => $comment->id, 'reply' => $reply->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-floating mb-3">
                <textarea class="form-control" name="reply_prompt" id="reply_prompt" style="height: 100px">{{ old('reply_prompt', $reply->reply_prompt) }}</textarea>
                <label for="reply_prompt">Edit Reply</label>
                @error('reply_prompt')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Reply</button>
            <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
