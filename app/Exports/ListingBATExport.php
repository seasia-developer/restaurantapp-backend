<?php

namespace App\Exports;

use App\Models\ListingBat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Illuminate\Support\Arr;
use App\Http\Controllers\Api\Listing\ListingBatController as listingBatController;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class ListingBATExport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($id)
    {
        $this->id = $id;       
    }
    public function headings(): array{
        return[
            'BAT','Data Year', '% Of Sales', 'Data Previous Year', '% of Sales(Previous Year)'
        ];
    } 
    public function collection()
    {
        $listing_bat = ListingBat::where('listing_id','=',$this->id)->first();
        $list_bat = new ListingBatController();
        $list_bat_cont = new listingBatController();
        $totalCOGS = 0;
        $totalCOGS1 = 0;
        $grossMargin = 0;
        $grossMargin1 = 0;
        $totalExpenses = 0;
        $totalExpenses1 = 0;
        $netIncome = 0;
        $netIncome1 = 0;
        $totalAddBacks = 0;
        $totalAddBacks1 = 0;
        $ownerBenefit = 0;
        $ownerBenefit1 = 0;

        $totalCOGS = $list_bat->getTotalCOGS($listing_bat->foodCosts, $listing_bat->alcohalCosts, $listing_bat->otherCogs);

        $grossMargin = $list_bat->getGrossMargin($listing_bat->grossSales, $totalCOGS);

        $totalExpenses = $list_bat->getTotalExpenses($listing_bat->advertising, $listing_bat->auto,$listing_bat->bankCharges,$listing_bat->creditCardFees, $listing_bat->depreciation,$listing_bat->duesSubscriptions,$listing_bat->insurance,$listing_bat->interestExpense,$listing_bat->legal, $listing_bat->licensesFees,$listing_bat->miscellaneous,$listing_bat->payrollTaxes,$listing_bat->postageDelivery,$listing_bat->ownerPersonalExpenses,$listing_bat->rent, $listing_bat->repairsMaintenance,$listing_bat->restaurantSupplies, $listing_bat->royalties,$listing_bat->salariesWages, $listing_bat->telephone, $listing_bat->utilities, $listing_bat->uniforms, $listing_bat->otherUncategorized,$listing_bat->officeSupplies,$listing_bat->janitorial,$listing_bat->equipmentlease,$listing_bat->donations,$listing_bat->filledfieldvalue);

        $netIncome = $list_bat->getNetIncome($grossMargin, $totalExpenses);

        $totalAddBacks = $list_bat->getTotalAddBacks($listing_bat->ownerSalary,$listing_bat->benefits, $listing_bat->interestExpense1, $listing_bat->depreciation1, $listing_bat->ownerPersonalExpenses1, $listing_bat->other);

        $ownerBenefit = $list_bat->getOwnerBenefit($netIncome, $totalAddBacks);

    
        if( (int)$listing_bat->grossSales_2 > 0 ){

            $totalCOGS1 = $list_bat->getTotalCOGS($listing_bat->foodCosts_2, $listing_bat->alcohalCosts_2, $listing_bat->otherCogs_2);

            $grossMargin1 = $list_bat->getGrossMargin($listing_bat->grossSales_2, $totalCOGS1);

            $totalExpenses1 = $list_bat->getTotalExpenses($listing_bat->advertising_2, $listing_bat->auto_2,$listing_bat->bankCharges_2,$listing_bat->creditCardFees_2, $listing_bat->depreciation_3,$listing_bat->duesSubscriptions_2,$listing_bat->insurance_2,$listing_bat->interestExpense_3,$listing_bat->legal_2, $listing_bat->licensesFees_2,$listing_bat->miscellaneous_2,$listing_bat->payrollTaxes_2,$listing_bat->postageDelivery_2,$listing_bat->ownerPersonalExpenses,$listing_bat->rent_2, $listing_bat->repairsMaintenance_2,$listing_bat->restaurantSupplies_2, $listing_bat->royalties_2,$listing_bat->salariesWages_2, $listing_bat->telephone_2, $listing_bat->utilities_2, $listing_bat->uniforms_2, $listing_bat->otherUncategorized_2,$listing_bat->officeSupplies_2,$listing_bat->janitorial_2,$listing_bat->equipmentlease_2,$listing_bat->donations_2,$listing_bat->filledfieldvalue_2);

            $netIncome1 = $list_bat->getNetIncome($grossMargin1, $totalExpenses1);

            $totalAddBacks1 = $list_bat->getTotalAddBacks($listing_bat->ownerSalary_2,$listing_bat->benefits_2, $listing_bat->interestExpense_4, $listing_bat->depreciation_4, $listing_bat->ownerPersonalExpenses_4, $listing_bat->other_2);

            $ownerBenefit1 = $list_bat->getOwnerBenefit($netIncome1, $totalAddBacks1);
        }
        // /////////////
        
        // /////////////
        if($listing_bat->includetobat == "No" || $listing_bat->includetobat == "no" || $listing_bat->includetobat == "NO"){
            $arr = array(
                array('Source of Data', $listing_bat->sourceOfData),

                array('Source of Data Year', $listing_bat->sourceOfDataYear),

                array('Net Sales', '$'.$listing_bat->grossSales, $listing_bat->grossSales_2),

                array('Food Costs', '$'.$listing_bat->foodCosts, $list_bat_cont->calculatePercentage($listing_bat->foodCosts,$listing_bat->grossSales)),

                array('Alcohol Costs', '$'.$listing_bat->alcohalCosts, $list_bat_cont->calculatePercentage($listing_bat->alcohalCosts,$listing_bat->grossSales)),

                array('Other Cogs', '$'.$listing_bat->otherCogs, $list_bat_cont->calculatePercentage($listing_bat->otherCogs,$listing_bat->grossSales)),

                array('Total COGS($)', '$'.$totalCOGS, $list_bat_cont->calculatePercentage($totalCOGS,$listing_bat->grossSales)),

                array('Gross Margin($)', '$'.$grossMargin, $list_bat_cont->calculatePercentage($grossMargin,$listing_bat->grossSales)),

                array('Advertising', '$'.$listing_bat->advertising, $list_bat_cont->calculatePercentage($listing_bat->advertising,$listing_bat->grossSales)),

                array('Auto', '$'.$listing_bat->auto, $list_bat_cont->calculatePercentage($listing_bat->auto,$listing_bat->grossSales)),

                array('Bank Charges', '$'.$listing_bat->bankCharges, $list_bat_cont->calculatePercentage($listing_bat->bankCharges,$listing_bat->grossSales)),

                array('Credit Card Fees', '$'.$listing_bat->creditCardFees, $list_bat_cont->calculatePercentage($listing_bat->creditCardsFees,$listing_bat->grossSales)),

                array('Depreciation/Amortization', '$'.$listing_bat->depreciation, $list_bat_cont->calculatePercentage($listing_bat->depreciation,$listing_bat->grossSales)),

                array('Donations/Sponsorships', '$'.$listing_bat->donations, $list_bat_cont->calculatePercentage($listing_bat->donations,$listing_bat->grossSales)),

                array('Dues Subscriptions', '$'.$listing_bat->duesSubscriptions, $list_bat_cont->calculatePercentage($listing_bat->duesSubscriptions,$listing_bat->grossSales)),

                array('Equipment lease', $listing_bat->equipmentlease.'$', $list_bat_cont->calculatePercentage($listing_bat->equipmentlease,$listing_bat->grossSales)),

                array('Insurance', '$'.$listing_bat->insurance, $list_bat_cont->calculatePercentage($listing_bat->insurance,$listing_bat->grossSales)),

                array('Interest Expense', '$'.$listing_bat->interestExpense, $list_bat_cont->calculatePercentage($listing_bat->interestExpense,$listing_bat->grossSales)),

                array('Janitorial/Cleaning/Laundry', '$'.$listing_bat->janitorial, $list_bat_cont->calculatePercentage($listing_bat->janitorial,$listing_bat->grossSales)),

                array('Legal and Accounting', '$'.$listing_bat->legal, $list_bat_cont->calculatePercentage($listing_bat->legal,$listing_bat->grossSales)),

                array('Licenses Fees', '$'.$listing_bat->licensesFees, $list_bat_cont->calculatePercentage($listing_bat->licensesFees,$listing_bat->grossSales)),

                array('Miscellaneous', '$'.$listing_bat->miscellaneous, $list_bat_cont->calculatePercentage($listing_bat->miscellaneous,$listing_bat->grossSales)),

                array('Payroll Taxes', '$'.$listing_bat->payrollTaxes, $list_bat_cont->calculatePercentage($listing_bat->payrollTaxes,$listing_bat->grossSales)),

                array('Postage/3rd Party Delivery', '$'.$listing_bat->postageDelivery, $list_bat_cont->calculatePercentage($listing_bat->payrollTaxes,$listing_bat->grossSales)),

                array('Office Supplies', '$'.$listing_bat->officeSupplies, $list_bat_cont->calculatePercentage($listing_bat->officeSupplies,$listing_bat->grossSales)),

                array('Owner Personal/Travel/Meals', '$'.$listing_bat->ownerPersonalExpenses, $list_bat_cont->calculatePercentage($listing_bat->ownerPersonalExpenses,$listing_bat->grossSales)),

                array('Rent', $listing_bat->rent.'$', $list_bat_cont->calculatePercentage($listing_bat->rent,$listing_bat->grossSales)),

                array('Repairs Maintenance', '$'.$listing_bat->repairsMaintenance, $list_bat_cont->calculatePercentage($listing_bat->rent,$listing_bat->grossSales)),

                array('Restaurant Supplies', '$'.$listing_bat->restaurantSupplies, $list_bat_cont->calculatePercentage($listing_bat->restaurantSupplies,$listing_bat->grossSales)),

                array('Royalties', '$'.$listing_bat->royalties, $list_bat_cont->calculatePercentage($listing_bat->royalties,$listing_bat->grossSales)),

                array('Salaries Wages', '$'.$listing_bat->salariesWages, $list_bat_cont->calculatePercentage($listing_bat->salariesWages,$listing_bat->grossSales)),

                array('Telephone/Internet/Cable', '$'.$listing_bat->telephone, $list_bat_cont->calculatePercentage($listing_bat->telephone,$listing_bat->grossSales)),

                array('Utilities', '$'.$listing_bat->utilities, $list_bat_cont->calculatePercentage($listing_bat->utilities,$listing_bat->grossSales)),

                array('Uniforms', '$'.$listing_bat->uniforms, $list_bat_cont->calculatePercentage($listing_bat->uniforms,$listing_bat->grossSales)),

                array('Other Uncategorized', '$'.$listing_bat->otherUncategorized, $list_bat_cont->calculatePercentage($listing_bat->otherUncategorized,$listing_bat->grossSales)),
            
                array('Total Expenses', '$'.$totalExpenses, $list_bat_cont->calculatePercentage($totalExpenses,$listing_bat->grossSales)),

                array('Net Income', '$'.$netIncome, $list_bat_cont->calculatePercentage($netIncome,$listing_bat->grossSales)),

                array('Owner Salary', '$'.$listing_bat->ownerSalary, $list_bat_cont->calculatePercentage($listing_bat->ownerSalary,$listing_bat->grossSales)),

                array('Benefits', '$'.$listing_bat->benefits, $list_bat_cont->calculatePercentage($listing_bat->ownerSalary,$listing_bat->grossSales)),

                array('Interest Expenses', '$'.$listing_bat->interestExpense_2, $list_bat_cont->calculatePercentage($listing_bat->interestExpense_2,$listing_bat->grossSales)),

                array('Depreciation/Amortization1', '$'.$listing_bat->depreciation_2, $list_bat_cont->calculatePercentage($listing_bat->depreciation_2,$listing_bat->grossSales)),

                array('Owner Personal/Travel/Meals1', '$'.$listing_bat->ownerPersonalExpenses_2, $list_bat_cont->calculatePercentage($listing_bat->depreciation_2,$listing_bat->grossSales)),

                array('Other', '$'.$listing_bat->other, $list_bat_cont->calculatePercentage($listing_bat->other,$listing_bat->grossSales)),

                array('Total Add Backs', '$'.$totalAddBacks, $list_bat_cont->calculatePercentage($totalAddBacks,$listing_bat->grossSales)),

                array('Owner Benefit', '$'.$ownerBenefit, $list_bat_cont->calculatePercentage($ownerBenefit,$listing_bat->grossSales)),

                array('Notes', $listing_bat->batNotes, ''),

                array('Franchise', $listing_bat->batFranchise, ''),

                array('Franchise Transfer Fee', '$'.$listing_bat->franchiseTransferFee, $list_bat_cont->calculatePercentage($listing_bat->franchiseTransferFee,$listing_bat->grossSales)),

                array('Royalty Fees', '$'.$listing_bat->royaltyFees, $list_bat_cont->calculatePercentage($listing_bat->royaltyFees,$listing_bat->grossSales)),

                array('Marketing Fees', '$'.$listing_bat->marketingFees, $list_bat_cont->calculatePercentage($listing_bat->marketingFees,$listing_bat->grossSales)),

                array('Franchise Renewal Date', $listing_bat->franchiserenewal, ''),

                array('Non Compete Agreement Years', '$'.$listing_bat->nonCompeteAgreementYears, $list_bat_cont->calculatePercentage($listing_bat->nonCompeteAgreementYears,$listing_bat->grossSales)),

                array('Non Compete Agreement Miles', '$'.$listing_bat->nonCompeteAgreementMiles, $list_bat_cont->calculatePercentage($listing_bat->nonCompeteAgreementMiles,$listing_bat->grossSales)),

                array('Seller Financing', $listing_bat->sellerFinancing, ''),

                array('Bank Financing', $listing_bat->bankFinancing, ''),

                array('Seller Financing Percentage', '$'.$listing_bat->sellerFinancingPercentage,  $list_bat_cont->calculatePercentage($listing_bat->sellerFinancingPercentage,$listing_bat->grossSales)),

                array('Bank Financing Percentage', '$'.$listing_bat->bankFinancingPercentage,  
                $list_bat_cont->calculatePercentage($listing_bat->bankFinancingPercentage,$listing_bat->grossSales)),

                array('Hours Worked By Owner', '$'.$listing_bat->hoursWorkedByOwner, ''),

                array('Reason For Selling', $listing_bat->reasonForSelling, '')
            );
        }  else {
            $arr = array(
                array('Source of Data', $listing_bat->sourceOfData, ' ', $listing_bat->sourceOfData_2, ' '),

                array('Source of Data Year', $listing_bat->sourceOfDataYear, ' ', $listing_bat->sourceOfDataYear_2, ' '),

                array('Net Sales', '$'.$listing_bat->grossSales, ' ' , $listing_bat->grossSales_2, ' '),

                array('Food Costs', '$'.$listing_bat->foodCosts, $list_bat_cont->calculatePercentage($listing_bat->foodCosts,$listing_bat->grossSales), '$'.$listing_bat->foodCosts_2, $list_bat_cont->calculatePercentage($listing_bat->foodCosts_2,$listing_bat->grossSales_2) ),

                array('Alcohol Costs', '$'.$listing_bat->alcohalCosts, $list_bat_cont->calculatePercentage($listing_bat->alcohalCosts,$listing_bat->grossSales), '$'.$listing_bat->alcohalCosts_2, $list_bat_cont->calculatePercentage($listing_bat->alcohalCosts_2,$listing_bat->grossSales_2)),

                array('Other Cogs', '$'.$listing_bat->otherCogs, $list_bat_cont->calculatePercentage($listing_bat->otherCogs,$listing_bat->grossSales), '$'.$listing_bat->otherCogs_2, $list_bat_cont->calculatePercentage($listing_bat->otherCogs1,$listing_bat->grossSales_2)),

                array('Total COGS($)', '$'.$totalCOGS, $list_bat_cont->calculatePercentage($totalCOGS,$listing_bat->grossSales), '$'.$totalCOGS1, $list_bat_cont->calculatePercentage($totalCOGS1,$listing_bat->grossSales_2)),

                array('Gross Margin($)', '$'.$grossMargin, $list_bat_cont->calculatePercentage($grossMargin,$listing_bat->grossSales), '$'.$grossMargin1, $list_bat_cont->calculatePercentage($grossMargin1,$listing_bat->grossSales_2)),

                array('Advertising', '$'.$listing_bat->advertising, $list_bat_cont->calculatePercentage($listing_bat->advertising,$listing_bat->grossSales), '$'.$listing_bat->advertising_2, $list_bat_cont->calculatePercentage($listing_bat->advertising_2,$listing_bat->grossSales_2)),

                array('Auto', '$'.$listing_bat->auto, $list_bat_cont->calculatePercentage($listing_bat->auto,$listing_bat->grossSales), '$'.$listing_bat->auto_2, $list_bat_cont->calculatePercentage($listing_bat->auto_2,$listing_bat->grossSales_2) ),

                array('Bank Charges', '$'.$listing_bat->bankCharges, $list_bat_cont->calculatePercentage($listing_bat->bankCharges,$listing_bat->grossSales), '$'.$listing_bat->bankCharges_2, $list_bat_cont->calculatePercentage($listing_bat->bankCharges_2,$listing_bat->grossSales_2)),

                array('Credit Card Fees', '$'.$listing_bat->creditCardFees, $list_bat_cont->calculatePercentage($listing_bat->creditCardsFees,$listing_bat->grossSales), '$'.$listing_bat->creditCardFees_2, $list_bat_cont->calculatePercentage($listing_bat->creditCardFees_2,$listing_bat->grossSales_2)),

                array('Depreciation/Amortization', '$'.$listing_bat->depreciation, $list_bat_cont->calculatePercentage($listing_bat->depreciation,$listing_bat->grossSales), '$'.$listing_bat->depreciation_2, $list_bat_cont->calculatePercentage($listing_bat->depreciation_2,$listing_bat->grossSales_2) ),

                array('Donations/Sponsorships', '$'.$listing_bat->donations, $list_bat_cont->calculatePercentage($listing_bat->donations,$listing_bat->grossSales), '$'.$listing_bat->donations_2, $list_bat_cont->calculatePercentage($listing_bat->donations_2,$listing_bat->grossSales_2)),

                array('Dues Subscriptions', '$'.$listing_bat->duesSubscriptions, $list_bat_cont->calculatePercentage($listing_bat->duesSubscriptions,$listing_bat->grossSales), '$'.$listing_bat->duesSubscriptions_2, $list_bat_cont->calculatePercentage($listing_bat->duesSubscriptions_2,$listing_bat->grossSales_2) ),

                array('Equipment lease', '$'.$listing_bat->equipmentlease, $list_bat_cont->calculatePercentage($listing_bat->equipmentlease,$listing_bat->grossSales), '$'.$listing_bat->equipmentlease_2, $list_bat_cont->calculatePercentage($listing_bat->equipmentlease_2,$listing_bat->grossSales_2)),

                array('Insurance', '$'.$listing_bat->insurance, $list_bat_cont->calculatePercentage($listing_bat->insurance,$listing_bat->grossSales), '$'.$listing_bat->insurance_2, $list_bat_cont->calculatePercentage($listing_bat->insurance_2,$listing_bat->grossSales_2)),

                array('Interest Expense', '$'.$listing_bat->interestExpense, $list_bat_cont->calculatePercentage($listing_bat->interestExpense,$listing_bat->grossSales), '$'.$listing_bat->interestExpense_2, $list_bat_cont->calculatePercentage($listing_bat->interestExpense_2,$listing_bat->grossSales_2) ),

                array('Janitorial/Cleaning/Laundry', '$'.$listing_bat->janitorial, $list_bat_cont->calculatePercentage($listing_bat->janitorial,$listing_bat->grossSales), '$'.$listing_bat->janitorial_2, $list_bat_cont->calculatePercentage($listing_bat->janitorial_2,$listing_bat->grossSales_2) ),

                array('Legal and Accounting', '$'.$listing_bat->legal, $list_bat_cont->calculatePercentage($listing_bat->legal,$listing_bat->grossSales), '$'.$listing_bat->legal_2, $list_bat_cont->calculatePercentage($listing_bat->legal_2,$listing_bat->grossSales_2) ),

                array('Licenses Fees', '$'.$listing_bat->licensesFees, $list_bat_cont->calculatePercentage($listing_bat->licensesFees,$listing_bat->grossSales), '$'.$listing_bat->licensesFees_2, $list_bat_cont->calculatePercentage($listing_bat->licensesFees_2,$listing_bat->grossSales_2) ),

                array('Miscellaneous', '$'.$listing_bat->miscellaneous, $list_bat_cont->calculatePercentage($listing_bat->miscellaneous,$listing_bat->grossSales), '$'.$listing_bat->miscellaneous_2, $list_bat_cont->calculatePercentage($listing_bat->miscellaneous_2,$listing_bat->grossSales_2)),

                array('Payroll Taxes', '$'.$listing_bat->payrollTaxes, $list_bat_cont->calculatePercentage($listing_bat->payrollTaxes,$listing_bat->grossSales), '$'.$listing_bat->payrollTaxes_2, $list_bat_cont->calculatePercentage($listing_bat->payrollTaxes_2,$listing_bat->grossSales_2) ),

                array('Postage/3rd Party Delivery', '$'.$listing_bat->postageDelivery, $list_bat_cont->calculatePercentage($listing_bat->postageDelivery,$listing_bat->grossSales), '$'.$listing_bat->postageDelivery_2, $list_bat_cont->calculatePercentage($listing_bat->postageDelivery_2,$listing_bat->grossSales_2)),

                array('Office Supplies', '$'.$listing_bat->officeSupplies, $list_bat_cont->calculatePercentage($listing_bat->officeSupplies,$listing_bat->grossSales), '$'.$listing_bat->officeSupplies_2, $list_bat_cont->calculatePercentage($listing_bat->officeSupplies_2,$listing_bat->grossSales_2) ),

                array('Owner Personal/Travel/Meals', '$'.$listing_bat->ownerPersonalExpenses, $list_bat_cont->calculatePercentage($listing_bat->ownerPersonalExpenses,$listing_bat->grossSales), '$'.$listing_bat->ownerPersonalExpenses_2, $list_bat_cont->calculatePercentage($listing_bat->ownerPersonalExpenses_2,$listing_bat->grossSales_2) ),

                array('Rent', '$'.$listing_bat->rent, $list_bat_cont->calculatePercentage($listing_bat->rent,$listing_bat->grossSales), '$'.$listing_bat->rent_2, $list_bat_cont->calculatePercentage($listing_bat->rent_2,$listing_bat->grossSales_2)),

                array('Repairs Maintenance', '$'.$listing_bat->repairsMaintenance, $list_bat_cont->calculatePercentage($listing_bat->rent,$listing_bat->grossSales), '$'.$listing_bat->repairsMaintenance_2, $list_bat_cont->calculatePercentage($listing_bat->repairsMaintenance_2,$listing_bat->grossSales_2) ),

                array('Restaurant Supplies', '$'.$listing_bat->restaurantSupplies, $list_bat_cont->calculatePercentage($listing_bat->restaurantSupplies,$listing_bat->grossSales), '$'.$listing_bat->restaurantSupplies_2, $list_bat_cont->calculatePercentage($listing_bat->restaurantSupplies_2,$listing_bat->grossSales_2) ),

                array('Royalties', '$'.$listing_bat->royalties, $list_bat_cont->calculatePercentage($listing_bat->royalties,$listing_bat->grossSales), '$'.$listing_bat->royalties_2, $list_bat_cont->calculatePercentage($listing_bat->royalties_2,$listing_bat->grossSales_2)),

                array('Salaries Wages', '$'.$listing_bat->salariesWages, $list_bat_cont->calculatePercentage($listing_bat->salariesWages,$listing_bat->grossSales), '$'.$listing_bat->salariesWages_2, $list_bat_cont->calculatePercentage($listing_bat->salariesWages_2,$listing_bat->grossSales_2) ),

                array('Telephone/Internet/Cable', '$'.$listing_bat->telephone, $list_bat_cont->calculatePercentage($listing_bat->telephone,$listing_bat->grossSales), '$'.$listing_bat->telephone_2,  $list_bat_cont->calculatePercentage($listing_bat->telephone_2,$listing_bat->grossSales_2) ),

                array('Utilities', '$'.$listing_bat->utilities, $list_bat_cont->calculatePercentage($listing_bat->utilities,$listing_bat->grossSales), '$'.$listing_bat->utilities_2, $list_bat_cont->calculatePercentage($listing_bat->utilities_2,$listing_bat->grossSales_2) ),

                array('Uniforms', '$'.$listing_bat->uniforms, $list_bat_cont->calculatePercentage($listing_bat->uniforms,$listing_bat->grossSales), '$'.$listing_bat->uniforms_2, $list_bat_cont->calculatePercentage($listing_bat->uniforms_2,$listing_bat->grossSales_2) ),

                array('Other Uncategorized', '$'.$listing_bat->otherUncategorized, $list_bat_cont->calculatePercentage($listing_bat->otherUncategorized,$listing_bat->grossSales), '$'.$listing_bat->otherUncategorized_2, $list_bat_cont->calculatePercentage($listing_bat->otherUncategorized_2,$listing_bat->grossSales_2)),
            
                array('Total Expenses', '$'.$totalExpenses, $list_bat_cont->calculatePercentage($totalExpenses,$listing_bat->grossSales), '$'.$totalExpenses1, $list_bat_cont->calculatePercentage($totalExpenses1,$listing_bat->grossSales_2) ),

                array('Net Income', '$'.$netIncome, $list_bat_cont->calculatePercentage($netIncome,$listing_bat->grossSales), '$'.$netIncome1, $list_bat_cont->calculatePercentage($netIncome1,$listing_bat->grossSales_2)),

                array('Owner Salary', '$'.$listing_bat->ownerSalary, $list_bat_cont->calculatePercentage($listing_bat->ownerSalary,$listing_bat->grossSales), '$'.$listing_bat->ownerSalary_2, $list_bat_cont->calculatePercentage($listing_bat->ownerSalary_2,$listing_bat->grossSales_2) ),

                array('Benefits', '$'.$listing_bat->benefits, $list_bat_cont->calculatePercentage($listing_bat->ownerSalary,$listing_bat->grossSales), '$'.$listing_bat->benefits_2, $list_bat_cont->calculatePercentage($listing_bat->benefits_2,$listing_bat->grossSales_2) ),

                array('Interest Expenses', '$'.$listing_bat->interestExpense_2, $list_bat_cont->calculatePercentage($listing_bat->interestExpense_2,$listing_bat->grossSales), '$'.$listing_bat->interestExpense_4, $list_bat_cont->calculatePercentage($listing_bat->interestExpense_4,$listing_bat->grossSales_2) ),

                array('Depreciation/Amortization1', '$'.$listing_bat->depreciation_2, $list_bat_cont->calculatePercentage($listing_bat->depreciation_2,$listing_bat->grossSales), '$'.$listing_bat->depreciation_4, $list_bat_cont->calculatePercentage($listing_bat->depreciation_4,$listing_bat->grossSales_2) ),

                array('Owner Personal/Travel/Meals1', '$'.$listing_bat->ownerPersonalExpenses_2, $list_bat_cont->calculatePercentage($listing_bat->depreciation_2,$listing_bat->grossSales), '$'.$listing_bat->ownerPersonalExpenses_4,$list_bat_cont->calculatePercentage($listing_bat->ownerPersonalExpenses_4,$listing_bat->grossSales_2)),

                array('Other', '$'.$listing_bat->other, $list_bat_cont->calculatePercentage($listing_bat->other,$listing_bat->grossSales), '$'.$listing_bat->other_2, $list_bat_cont->calculatePercentage($listing_bat->other_2,$listing_bat->grossSales_2) ),

                array('Total Add Backs', '$'.$totalAddBacks, $list_bat_cont->calculatePercentage($totalAddBacks,$listing_bat->grossSales), '$'.$totalAddBacks1, $list_bat_cont->calculatePercentage($totalAddBacks1,$listing_bat->grossSales_2)),

                array('Owner Benefit', '$'.$ownerBenefit, $list_bat_cont->calculatePercentage($ownerBenefit,$listing_bat->grossSales), '$'.$ownerBenefit1, $list_bat_cont->calculatePercentage($ownerBenefit1,$listing_bat->grossSales_2)),

                array('Notes', $listing_bat->batNotes, ' ', ' ', ' ', ' '),

                array('Franchise', $listing_bat->batFranchise, ' ', ' ', ' ', ' '),
                
                array('Franchise Transfer Fee', '$'.$listing_bat->franchiseTransferFee, $list_bat_cont->calculatePercentage($listing_bat->franchiseTransferFee,$listing_bat->grossSales), '$'.$listing_bat->franchiseTransferFee_2, $list_bat_cont->calculatePercentage($listing_bat->franchiseTransferFee_2,$listing_bat->grossSales_2)),

                array('Royalty Fees', '$'.$listing_bat->royaltyFees, $list_bat_cont->calculatePercentage($listing_bat->royaltyFees,$listing_bat->grossSales), '$'.$listing_bat->royaltyFees_2, $list_bat_cont->calculatePercentage($listing_bat->royaltyFees_2,$listing_bat->grossSales_2)),

                array('Marketing Fees', '$'.$listing_bat->marketingFees, $list_bat_cont->calculatePercentage($listing_bat->marketingFees,$listing_bat->grossSales), '$'.$listing_bat->marketingFees_2, $list_bat_cont->calculatePercentage($listing_bat->marketingFees_2,$listing_bat->grossSales_2)),

                array('Franchise Renewal Date', $listing_bat->franchiserenewal ),

                array('Non Compete Agreement Years', '$'.$listing_bat->nonCompeteAgreementYears, $list_bat_cont->calculatePercentage($listing_bat->nonCompeteAgreementYears,$listing_bat->grossSales),'$'.$listing_bat->nonCompeteAgreementYears_2, $list_bat_cont->calculatePercentage($listing_bat->nonCompeteAgreementYears_2,$listing_bat->grossSales_2)),

                array('Non Compete Agreement Miles', '$'.$listing_bat->nonCompeteAgreementMiles, $list_bat_cont->calculatePercentage($listing_bat->nonCompeteAgreementMiles,$listing_bat->grossSales), '$'.$listing_bat->nonCompeteAgreementMiles_2, $list_bat_cont->calculatePercentage($listing_bat->nonCompeteAgreementMiles_2,$listing_bat->grossSales_2)),

                array('Seller Financing', $listing_bat->sellerFinancing, ''),

                array('Bank Financing', $listing_bat->bankFinancing, ''),

                array('Seller Financing Percentage', '$'.$listing_bat->sellerFinancingPercentage,  $list_bat_cont->calculatePercentage($listing_bat->sellerFinancingPercentage,$listing_bat->grossSales),'$'.$listing_bat->sellerFinancingPercentage_2,  $list_bat_cont->calculatePercentage($listing_bat->sellerFinancingPercentage_2,$listing_bat->grossSales_2)),

                array('Bank Financing Percentage', '$'.$listing_bat->bankFinancingPercentage,  
                $list_bat_cont->calculatePercentage($listing_bat->bankFinancingPercentage,$listing_bat->grossSales), '$'.$listing_bat->bankFinancingPercentage_2,  
                $list_bat_cont->calculatePercentage($listing_bat->bankFinancingPercentage_2,$listing_bat->grossSales)),

                array('Hours Worked By Owner', '$'.$listing_bat->hoursWorkedByOwner, ''),

                array('Reason For Selling', $listing_bat->reasonForSelling, '')
            );
        }
        return collect($arr); 
    }
   
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:E1')->getFont()->setBold(true);
            },
        ];
    }
}
   