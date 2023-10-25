<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdLeadDocument extends Model
{
    use HasFactory;

    protected $table = 'ad_lead_document';


    protected $fillable = [
        'lead_id',
        'doc_title',
        'doc_file',
        'doc_agent',
        'agent_type', 
        'lapdf_document_id'
    ];

    public function getLaPdfDocument()
    {
        return $this->belongsTo(AdLaPdfDocument::class, 'lapdf_document_id', 'id');
    }

    public function creatorByAdmin()
    {
        return $this->belongsTo(User::class, 'doc_agent', 'id');
    }

    public function creatorByAgent()
    {
        return $this->belongsTo(Agents::class, 'doc_agent', 'id');
    }
}
