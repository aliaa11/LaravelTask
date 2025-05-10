<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    public function index()
    {
         return CommentResource::collection(Comment::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request , Post $post, Comment $comment)
    {
        $request["user_id"] = Auth::id();
        $comment = Comment::create($request->all());
        return  CommentResource::make($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return CommentResource::make($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $user = Auth::user();
        if ($user->id !== $comment->user_id && !($user->role=='admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
           
        $comment->update($request->all());
        return CommentResource::make($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();
        if ($user->id !== $comment->user_id && !($user->role=='admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
           
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
