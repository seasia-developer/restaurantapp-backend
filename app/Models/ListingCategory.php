<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingCategory extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'listing_categories';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];
}
