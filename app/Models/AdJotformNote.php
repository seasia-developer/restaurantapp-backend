<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdManager;

class AdJotformNote extends Model
{
    use HasFactory;

    protected $table = 'ad_Jotform_note';

        
    protected $fillable = [
        'agent_id',
        'lead_id',
        'jotform_id',
        'text',
        'date_time',
        'email'
    ];

    public function getAdManager()
    {
        return $this->belongsTo(AdManager::class, 'lead_id', 'id');
    }
}
