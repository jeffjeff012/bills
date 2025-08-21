<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;

class Comment extends Model
{
   

    protected $fillable = [
    'user_id',
    'bill_id',
    'content',
    ];
    
    // In App\Models\Comment.php
    public function canEdit(): bool
    {
        return $this->user_id === auth()->id() && $this->created_at->diffInMinutes(now()) >= 5;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

}
