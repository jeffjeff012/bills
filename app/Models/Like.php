<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Like extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['bill_id', 'user_id', 'like'];

     protected static $logAttributes = [
        'like'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logOnly([
                    'like'
            ]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function bill() 
    {
        return $this->belongsTo(Bill::class);
    }
}