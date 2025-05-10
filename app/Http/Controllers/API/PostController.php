<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\User;
use App\Http\Resources\PostResource;

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request ,Post $post, Comment $comment)
    {
        $request["user_id"] = Auth::id();
        $post = Post::create($request->all());
        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
    return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $user = Auth::user();
        if ($user->id !== $post->user_id && !($user->role=='admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
           
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        if ($user->id !== $post->user_id && !($user->role=='admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
           
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
