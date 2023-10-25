<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerUserHot extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'buyer_user_hot';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];
}
