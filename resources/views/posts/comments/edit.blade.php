@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
<div class="display-inline-block text-center ">
    <h1 class="mb-4">Edit Comments</h1>
</div>

    <div class="card w-50 mx-auto mt-4 p-4">
        <p class="mb-4">Editing comment for post: <strong>{{ $post->title }}</strong></p>
        <form action="{{ route('posts.comments.update', [$post->id, $comment->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-floating mb-3">
                <textarea class="form-control" name="message_prompt" id="message_prompt" style="height: 100px">{{ old('message_prompt', $comment->message_prompt) }}</textarea>
                <label for="message_prompt">Edit Comment</label>
                @error('message_prompt')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Comment</button>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
