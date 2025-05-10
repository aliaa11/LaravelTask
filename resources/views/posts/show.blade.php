@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                {{-- {{ dd($post) }} --}}
                {{-- {{dd($post->user->image)}} --}}
                @if ($post->user && $post->user->image)
                <p class="text-black fw-bold fs-3 p-3"><img src="{{ asset('storage/images/' . $post->user->image) }}" alt="{{ $post->user->name }}" class="rounded-circle me-2" width="50" height="50">{{ $post->user ? $post->user->name : "No Creator" }}</p>
                
                @endif
               
                <img src="{{ asset('images/' . $post['image']) }}" class="card-img-top img-fluid" alt="{{ $post['title'] }}" style="height: 500px; object-fit: cover;">
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $post['title'] }}</h1>
                    <p class="card-text lead">{{ $post['description'] }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <small class="text-muted">
                            <i class="far fa-clock"></i> {{ $post->created_at ? $post->created_at->diffForHumans() : 'N/A' }}
                        </small>
                       
                    </div>

                    <div class="border-top pt-3 mb-4">
                        <h4 class="mb-3">Add Comment</h4>
                        <form action="{{ route('posts.comments.store', ['post' => $post]) }}" method="POST">
                            @csrf
                            <input type="text" hidden name="post_id" value="{{ $post->id }}">

                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 50px" name="message_prompt"></textarea>
                                <label for="floatingTextarea2">Your comment...</label>
                                @error('message_prompt')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex">
                                <button type="submit" class="btn btn-primary me-md-2">Add Comment</button>
                                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Back to Posts</a>
                            </div>
                        </form>
                    </div>

                    <div class="border-top pt-3">
                        <h4 class="mb-4 fw-bold text-secondary">
                            <i class="far fa-comments"></i> Comments ({{ $post->comments->count() }})
                        </h4>
                        
                        @foreach ($post->comments as $comment)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        @if ($comment->user && $comment->user->image)
                                        <small class="text-muted">
                                        <p class="text-black fw-bold fs-5 p-3"><img src="{{ asset('storage/images/' . $comment->user->image) }}" alt="{{ $comment->user->name }}" class="rounded-circle me-2" width="40" height="40">{{ $comment->user ? $comment->user->name : "No Creator" }}</p>
                                        </small>

                                        @endif
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    
                                    <p class="card-text mb-3 fs-5">{{ $comment->message_prompt }}</p>
                                    
                                    @can('update-delete-comment', $comment)
                                    <div class="btn-group mb-3">
                                        <a href="{{ route('posts.comments.edit', [$post->id, $comment->id]) }}" class="btn btn-sm btn-outline-warning me-md-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger "  onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endcan

                                    @if($comment->replies->count())
                                        <div class="mt-3 ms-3 border-start ps-3">
                                            <h6 class="mb-3">
                                                <i class="fas fa-reply"></i> Replies ({{ $comment->replies->count() }})
                                            </h6>
                                            @foreach ($comment->replies as $reply)
                                                <div class="card mb-2 shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <div class="content">
                                                                <div class="image">
                                                                    @if ($reply->user && $reply->user->image)
                                                                        <small class="text-muted">
                                                                        <p class="text-black fw-bold fs-5 p-3"><img src="{{ asset('storage/images/' . $reply->user->image) }}" alt="{{ $reply->user->name }}" class="rounded-circle me-2" width="40" height="40">{{ $reply->user ? $reply->user->name : "No Creator" }}</p>
                                                                        </small>
                                                                    @endif 
                                                                    <br>
                                                                    <p class="card-text fs-5">{{ $reply->reply_prompt }}</p>
                                                                    <br>
                                                                    <small class="text-muted">
                                                                        <i class="far fa-clock"></i> {{ $reply->created_at->diffForHumans() }}
                                                                    </small>
                                                                </div>
                                                                @can('update-delete-reply', $reply)
                                                                    <div class="btn-group mt-3">
                                                                        <a href="{{ route('comments.replies.edit',['comment' => $comment->id, 'reply' => $reply->id] ) }}" class="btn btn-sm btn-outline-warning  me-md-3">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </a>
                                                                        <form action="{{ route('comments.replies.destroy',['comment' => $comment->id, 'reply' => $reply->id]) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-outline-danger"  onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                                                <i class="fas fa-trash"></i> Delete
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <form action="{{ route('comments.replies.store', $comment->id) }}" method="POST" class="mt-3 ms-3">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="reply_prompt" placeholder="Write a reply..." required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane"></i> Reply
                                            </button>
                                        </div>
                                        @error('reply_prompt')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection