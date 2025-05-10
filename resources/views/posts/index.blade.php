@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create Post</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @foreach($posts as $post)
            <div class="card mb-4 shadow-sm">
                <!-- Post Header -->
                <div class="card-header bg-white d-flex align-items-center p-3">
                    @if ($post->user && $post->user->image)
                    <img src="{{ asset('storage/images/' . $post->user->image) }}" 
                         class="rounded-circle me-3" width="50" height="50" 
                         alt="{{ $post->user->name }}">
                    @else
                    <img src="{{ asset('storage/images/default.jpg') }}" 
                         class="rounded-circle me-3" width="50" height="50" 
                         alt="Default User">
                    @endif
                    <div>
                        <h5 class="mb-0">{{ $post->user ? $post->user->name : "No Creator" }}</h5>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                
                <!-- Post Content -->
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text mb-3">{{ $post->description }}</p>

                        @can('update-delete-post', $post)
                        <div class="dropdown">
                            <button class="btn btn-light rounded-0 py-2" 
                                    type="button" 
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" 
                                       href="{{ route('posts.edit', $post) }}">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('posts.destroy', $post->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="dropdown-item text-danger"
                                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            <i class="fas fa-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endcan
                    </div>
                    @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}" 
                         class="img-fluid rounded mb-3" 
                         alt="{{ $post->title }}">
                    @endif
                </div>
                
                <!-- Post Stats -->
                <div class="px-3 pb-2">
                    <div class="d-flex justify-content-between text-muted">
                        <span>
                            <i class="far fa-comment me-1"></i> {{ $post->comments->count() }} comments
                        </span>
                    </div>
                </div>
                
                <!-- Post Actions -->
                <div class="card-footer bg-white p-0">
                    <div class="d-flex justify-content-between border-top">
                        <a href="{{ route('posts.show', $post) }}" 
                           class="btn btn-light flex-grow-1 rounded-0 py-2">
                            <i class="far fa-comment me-2"></i> Comment
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .card {
        border-radius: 8px;
        border: none;
    }
    .card-header {
        border-bottom: 1px solid #e4e6eb;
    }
    .btn-light {
        background-color: #f0f2f5;
        color: #65676b;
        border: none;
    }
    .btn-light:hover {
        background-color: #e4e6e9;
    }
    .img-fluid {
        max-height: 500px;
        object-fit: cover;
        width: 100%;
    }
    
</style>
@endsection