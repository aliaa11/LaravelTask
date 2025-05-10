@extends('layout')

@section('title', 'Edit Posts')

@section('content')
<div class="display-inline-block w-100 text-center">
    <h1 class="mb-4">Edit Posts</h1>
</div>

    <form action="{{ route('posts.update',  $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" 
                value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description" 
                value="{{ old('description', $post->description) }}">
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="text" class="form-control" name="image" 
                value="{{ old('image', $post->image) }}">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Edit Post</button>
    </form>
@endsection
