<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reply;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
  
    public function index()
    {
         return ReplyResource::collection(Reply::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReplyRequest $request)
    {
        $comment = Comment::find($request->comment_id);

    if (!$comment) {
        return response()->json(['error' => 'Comment not found'], 404);
    }
        $request["user_id"] = Auth::id();
        $reply = Reply::create($request->all());
        return ReplyResource::make($reply);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReplyRequest $request, Comment $comment, Reply $reply)
    {
        if ($request->comment_id != $comment->id) {
            return response()->json(['error' => 'Invalid comment'], 400);
        }
        $user = Auth::user();
        if ($user->id !== $reply->user_id && !($user->role=='admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $reply->update($request->all());
        return ReplyResource::make($reply);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, Reply $reply)
    {
        $user = Auth::user();
        if ($user->id !== $reply->user_id && !($user->role=='admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
            
        $reply->delete();
        return response()->json(['message' => 'Reply deleted successfully'], 200);
    }
}
