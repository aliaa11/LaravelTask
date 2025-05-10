<?php

namespace App\Providers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('update-delete-post', function (User $user,Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('update-delete-comment', function (User $user,Comment $comment) {
            return $user->id === $comment->user_id;
        });
        Gate::before(function($user){
            if($user->role == "admin"){
                return true;
            }
        });
        Gate::define('update-delete-reply', function (User $user,Reply $reply) {
            return $user->id === $reply->user_id;
        });


    }
}
