<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Bill extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'content', 
        'user_id',
        'due_date',
        'authored_by',
        'attachment',
        'contributorType',
        'sponsored_by',
        'committee_id',
    ];

    protected static $logAttributes = [
        'title',
        'content', 
        'user_id',
        'due_date',
        'authored_by',
        'attachment',
        'committee_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'title',
                'content',
                'user_id',
                'due_date',
                'contributorType',
                'authored_by',
                'sponsored_by',
                'attachment',
                'committee_id',
            ])
            ->dontLogIfAttributesChangedOnly(['likes', 'dislikes']);
    }

    protected $casts = [
        'due_date' => 'date', 
    ];

    public function getContributorDisplayAttribute()
    {
         if ($this->contributorType === 'author') {
            return $this->authored_by ?? 'Unknown Author';
        } elseif ($this->contributorType === 'sponsor') {
            return $this->sponsored_by ? "Sponsored by {$this->sponsored_by}" : 'Unknown Sponsor';
        }
        
        if ($this->authored_by) {
            return $this->authored_by;
        }
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function committee()
    {
        return $this->belongsTo(\App\Models\Committee::class);
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
