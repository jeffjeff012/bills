<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name'
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
