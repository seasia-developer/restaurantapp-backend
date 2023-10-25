<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdManagerValuation extends Model
{
    use HasFactory;

    protected $table = 'ad_manager_valuations';


    protected $fillable = [
        'ad_manager_id', 'grossSales', 'foodCosts', 'alcohalCosts', 'otherCogs', 'advertising', 'auto', 'bankCharges', 'creditCardFees', 'depreciation', 'duesSubscriptions', 'insurance', 'interestExpense', 'legal', 'licensesFees', 'miscellaneous', 'payrollTaxes', 'postageDelivery', 'ownerPersonalExpenses', 'rent', 'repairsMaintenance', 'restaurantSupplies', 'royalties', 'salariesWages', 'telephone', 'utilities', 'uniforms', 'otherUncategorized', 'officeSupplies', 'ownerSalary', 'benefits', 'interestExpense1', 'depreciation1', 'ownerPersonalExpenses1', 'other', 'batNotes', 'batFranchise', 'franchiseTransferFee', 'royaltyFees', 'marketingFees', 'sourceOfData', 'sourceOfDataYear', 'nonCompeteAgreementYears', 'nonCompeteAgreementMiles', 'sellerFinancing', 'bankFinancing', 'sellerFinancingPercentage', 'bankFinancingPercentage', 'hoursWorkedByOwner', 'reasonForSelling', 'equipmentlease', 'janitorial', 'franchiserenewal', 'accounting', 'prefilledfield', 'filledfieldvalue', 'donations', 'franchisename', 'ownerSalarynote', 'benefitsnote', 'interestExpense1note', 'depreciation1note', 'ownerPersonalExpenses1note', 'othernote', 'listingpricehigh', 'listingpricelow', 'grossSales1', 'foodCosts1', 'alcohalCosts1', 'otherCogs1', 'advertising1', 'auto1', 'bankCharges1', 'creditCardFees1', 'duesSubscriptions1', 'insurance1', 'legal1', 'licensesFees1', 'miscellaneous1', 'payrollTaxes1', 'postageDelivery1', 'rent1', 'repairsMaintenance1', 'restaurantSupplies1', 'royalties1', 'salariesWages1', 'telephone1', 'utilities1', 'uniforms1', 'otherUncategorized1', 'officeSupplies1', 'ownerSalary1', 'benefits1', 'interestExpense11', 'depreciation11', 'ownerPersonalExpenses11', 'other1', 'batNotes1', 'batFranchise1', 'franchiseTransferFee1', 'royaltyFees1', 'marketingFees1', 'sourceOfData1', 'sourceOfDataYear1', 'nonCompeteAgreementYears1', 'nonCompeteAgreementMiles1', 'sellerFinancing1', 'bankFinancing1', 'sellerFinancingPercentage1', 'bankFinancingPercentage1', 'hoursWorkedByOwner1', 'reasonForSelling1', 'equipmentlease1', 'janitorial1', 'franchiserenewal1', 'accounting1', 'prefilledfield1', 'filledfieldvalue1', 'donations1', 'franchisename1', 'ownerSalarynote1', 'benefitsnote1', 'depreciation1note1', 'ownerPersonalExpenses1note1', 'othernote1', 'listingpricehigh1', 'listingpricelow1', 'depreciation111', 'ownerPersonalExpenses111', 'interestExpense111', 'interestExpense1note1', 'includetobat',
    ];
}
