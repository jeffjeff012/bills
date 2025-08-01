<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['note_id', 'user_id', 'like'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function note() 
    {
        return $this->belongsTo(Note::class);
    }
}