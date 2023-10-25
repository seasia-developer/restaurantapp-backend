<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingChecklist extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'listing_checklist';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $hidden = ['updated_at'];

    public function getDuplicateData()
    {
        return $this->belongsTo(static::class, 'duplicate_id', 'id')->select(['id','bname','due_diligence_date','lending_approve_date','attorney','lending','franchise','e2_visa','which_wich','corporation_formed','uid','utype']);
    }

    public static function getTotalUpdate($data, $totalChange)
    {
        $originalData = array_values($data['checklist']);
        $originalKey=array_keys($data['checklist']);
        $duplicateData = array_values($data['checklist']['get_duplicate_data']);
        $duplicateKey = array_keys($data['checklist']['get_duplicate_data']);
        for ($x = 0; $x < count($duplicateData); $x++) {
            if($originalData[$x] != $duplicateData[$x]){
                $totalChange['originalData'][$originalKey[$x]] = $originalData[$x];
                $totalChange['duplicateData'][$duplicateKey[$x]] = $duplicateData[$x];
            }
        }
        return $totalChange;
    }
}
