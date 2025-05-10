<?php

namespace App\Models;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];
    use HasFactory;
    protected static function PostSeeder()
    {
        return PostFactory::new();
    }
    function Comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
