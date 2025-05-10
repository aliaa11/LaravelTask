<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;


class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $replies = Reply::all();
        return view('posts.comments.replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReplyRequest $request)
    {
        $request["user_id"] = Auth::id();
        // dd($request->all());
        $reply = Reply::create($request->all());
        return to_route('posts.show', ['post' => $reply->comment->post_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment, Reply $reply)
    {
        // dd($reply);
        Gate::authorize('update-delete-reply', $reply);
        return view('posts.comments.replies.edit', compact('comment','reply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReplyRequest $request, Comment $comment, Reply $reply)
    {

        $reply->update($request->all());
        return to_route('posts.show', ['post' => $reply->comment->post_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, Reply $reply)
    {
        Gate::authorize('update-delete-reply', $reply);
        $reply->delete();
        return to_route('posts.show', ['post' => $reply->comment->post_id]);
    }
}
