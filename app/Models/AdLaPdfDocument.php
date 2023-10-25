<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdLaPdfDocument extends Model
{
    use HasFactory;

    protected $table = 'ad_la_pdf_document';


    protected $fillable = [
        'lead_id',
        'dated'
    ];
}
