<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;

class Bill extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'title',
        'content', 
        'user_id',
        'due_date',
        'authored_by',
        'attachment',
    ];

    protected $casts = [
        'due_date' => 'date', 
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

   // Likes relationship
    public function likes()
    {
        return $this->hasMany(Like::class)->where('like', true);
    }

    // Dislikes relationship
    public function dislikes()
    {
        return $this->hasMany(Like::class)->where('like', false);
    }
}
