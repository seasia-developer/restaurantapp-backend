<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerUserDocument extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'buyer_user_document';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];


    public function agent()
    {
        return $this->belongsTo(User::class, 'doc_agent', 'id');
    }

    public function apa()
    {
        return $this->belongsTo(ApaBuyersDoc::class, 'apa_document_id', 'id');
    }

    public function amendment()
    {
        return $this->belongsTo(AmendmentBuyersDoc::class, 'amendment_id', 'id');
    }

    public function terminate()
    {
        return $this->belongsTo(TerminateBuyersDoc::class, 'terminate_id', 'id');
    }

    public function confidentiality()
    {
        return $this->belongsTo(ConfidentialityBuyersDoc::class, 'universal_id', 'id');
    }
    
}
