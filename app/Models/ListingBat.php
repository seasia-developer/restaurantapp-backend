<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingBat extends Model
{
    use HasFactory, SoftDeletes;

    // Table Name
    protected $table = 'listing_bat';
    // Primary Key
    public $primaryKey = 'id';
    
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
    
    public function listing_media()
    {
        return $this->belongsTo(ListingMedia::class, 'id', 'listing_id');
    }
    public function getDuplicateData()
    {
        return $this->belongsTo(static::class, 'duplicate_id', 'id')->select(['id','sourceOfData','sourcedataDoc','sourceOfDataYear','grossSales as Net_sales','foodCosts','alcohalCosts','otherCogs','advertising','auto','bankCharges','creditCardFees','depreciation','donations','duesSubscriptions','equipmentlease', 'insurance',  'interestExpense','janitorial','legal','licensesFees','miscellaneous','postageDelivery','officeSupplies','ownerPersonalExpenses','rent', 'repairsMaintenance','payrollTaxes', 'restaurantSupplies','royalties','salariesWages','telephone','utilities','uniforms','otherUncategorized','prefilledfield as agent_entry','filledfieldvalue as amount','ownerSalary','benefits','interestExpense_2','depreciation_2','ownerPersonalExpenses_2','other','batNotes as misc_notes','batFranchise','franchisename','franchiseTransferFee','feeonclosing','royaltyFees','marketingFees','franchiserenewal as years_remaining_on_franchise_agreement','nonCompeteAgreementYears','nonCompeteAgreementMiles','sellerFinancing','bankFinancing','sellerFinancingPercentage','bankFinancingPercentage','hoursWorkedByOwner','reasonForSelling','includetobat as Include_on_PDF','sourceOfData_2','sourceOfDataYear_2','grossSales_2 as Net_Sales_2:','foodCosts_2','alcohalCosts_2','otherCogs_2','advertising_2','auto_2','bankCharges_2','creditCardFees_2','depreciation_3','donations_2','duesSubscriptions_2','equipmentlease_2','insurance_2','interestExpense_3','janitorial_2','legal_2','licensesFees_2','miscellaneous_2','payrollTaxes_2','postageDelivery_2','officeSupplies_2','ownerPersonalExpenses_3','rent_2',  'repairsMaintenance_2','restaurantSupplies_2','royalties_2','salariesWages_2','telephone_2','utilities_2','uniforms_2','otherUncategorized_2','prefilledfield_2 as agent_entry_2', 'filledfieldvalue_2 as amount_2','ownerSalary_2','benefits_2','interestExpense_4','depreciation_4','ownerPersonalExpenses_4','other_2','batNotes_2 as misc_notes_2','batFranchise_2','franchisename_2','franchiseTransferFee_2','feeonclosing_2','royaltyFees_2','marketingFees_2', 'franchiserenewal_2 as years_remaining_on_franchise_agreement_2','nonCompeteAgreementYears_2','nonCompeteAgreementMiles_2','sellerFinancing_2','bankFinancing_2','sellerFinancingPercentage_2','bankFinancingPercentage_2','hoursWorkedByOwner_2','reasonForSelling_2']);
    }

    public static function getTotalUpdate($data, $totalChange)
    {
        $originalData = array_values($data['bat']);
        $originalKey=array_keys($data['bat']);
        $duplicateData = array_values($data['bat']['get_duplicate_data']);
        $duplicateKey = array_keys($data['bat']['get_duplicate_data']);
        for ($x = 0; $x < count($duplicateData); $x++) {
            if($originalData[$x] != $duplicateData[$x]){
                $totalChange['originalData'][$originalKey[$x]] = $originalData[$x];
                $totalChange['duplicateData'][$duplicateKey[$x]] = $duplicateData[$x];
            }
        }
        return $totalChange;
    }
}
