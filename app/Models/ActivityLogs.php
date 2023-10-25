<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'activity_logs';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault('');
    }
}
