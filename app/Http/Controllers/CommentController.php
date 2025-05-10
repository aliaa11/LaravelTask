<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
class CommentController extends Controller
{
    function __construct(){
        $this->middleware("auth")->only(["create", "edit", "destroy"]);
    }
    public function index()
    {
        $comments = Comment::all();
        return view('posts.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        
        $request["user_id"] = Auth::id();
        Comment::create($request->all());

        return to_route('posts.show', $request->post_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post,Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, Comment $comment)
    {
        Gate::authorize('update-delete-comment', $comment);
        return view('posts.comments.edit', compact('post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Post $post, Comment $comment)
    {
     

        $comment->update($request->all());

        return to_route('posts.show', $comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post,Comment $comment)
    {
        Gate::authorize('update-delete-comment', $comment);
        $comment->delete();
        return to_route('posts.show', $comment->post_id);
    }
}
