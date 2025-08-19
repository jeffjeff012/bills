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
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

}
