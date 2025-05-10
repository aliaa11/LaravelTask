<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{


    function __construct(){
        $this->middleware("auth")->except(["index","show"]);
    }

   public function index()
   {
    $posts=  Post::latest()->paginate(3); 
    return view('posts.index', compact('posts'));
   }
    public function create()
    {
     return view('posts.create');
    }
    function store(StorePostRequest $request )
    {
        $request["user_id"] = Auth::id();
        Post::create($request->all());
        return to_route('posts.index');
    }
    function show(Post $post){
        return view('posts.show', compact('post'));
    }
    function edit(Post $post){
        Gate::authorize('update-delete-post', $post);
        return view('posts.edit', compact('post'));
    }
    function update( UpdatePostRequest $request,  Post $post){

        $post->update($request->all());
        return to_route('posts.index');
    }
    function destroy(Post $post){
        Gate::authorize('update-delete-post', $post);
        $post->delete();
        return to_route('posts.index');
    }

}