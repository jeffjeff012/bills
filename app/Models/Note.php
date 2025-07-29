<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Note extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'title',
        'content', 
        'user_id',
        'due_date',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}


