<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatTabHistory extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'bat_tab_history';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];
}
