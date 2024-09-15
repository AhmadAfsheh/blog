<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];
    
    // A post belongs to a user (admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

