<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Comment extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'bill_id',
        'content',
        'title',
    ];

     protected static $logAttributes = [
        'user_id',
        'bill_id',
        'content',
        'title',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logOnly([
                    'user_id',
                    'bill_id',
                    'content',
                    'title',
            ]);
    }

    // In App\Models\Comment.php
    public function canEdit(): bool
    {
        return $this->user_id === auth()->id() && $this->created_at->diffInMinutes(now()) <= 5;
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
