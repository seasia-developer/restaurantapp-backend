<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Models\ListingOffice;
use App\Models\ListingSeller;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\User;


class ListingExport implements FromCollection, WithHeadings, WithEvents
{

    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array{
        return[
            'Listing#','Business Name','Business Address','Owner Legal Name','City','State','Zip','County','Listing Agent','Market','Office','Business Type','URL Description','Meta Description','Headline Ad','Sale Price','Days On Market','Private Listing','How Acquired Listing','Listing Grade','Number of CAs signed','Is BAT','Listing Status','Buyer Prequalification Yes/No','Amount','City Confidential Yes/No',"Buyer's Agent",'Filters','Net Income','Net Sales','Owner Benefit','Expiration Date','Source of Data Year','Seller Business number','Seller Cell number','Email Address'
        ];
    }
    public function collection()
    {
        if(isset($this->status)) {
            $status = [$this->status];
            $status = join(", ", $status);
        }
        
        if(isset($status)) {
            $results = DB::select( DB::raw("select `listing`.`id`, `listing`.`bname`, `listing`.`baddress`, `listing_seller`.`olegalname1`, `listing`.`bcity`, `listing`.`bstate`, `listing`.`bzip`, `listing`.`bcounty`,`listing_office`.`olagent`, `listing`.`bregion`, `listing_office`.`franchiseofficeid`, `listing`.`btype`, `listing`.`burldes`, `listing`.`bmetadescription`, `listing`.`bheadlinead`, `listing`.`bsaleprice`, `listing`.`daysonmarket`, `listing`.`bprivatelist`, `listing`.`bacquiredlist`, `listing`.`bgradelist`, count(ca_buyers.listing_id) as count_ca_buyers, `listing`.`isBat`, `listing`.`bstatuslist`, `listing`.`bprequalification`, `listing`.`bamount`, `listing`.`bcity`,  if(listing.showcity=1,'Yes','No') as showcityC, `listing`.`filtertype`, `listing`.`is_duplicate`, `listing_bat`.`grossSales`,`listing_bat`.`foodCosts`,`listing_bat`.`alcohalCosts`,`listing_bat`.`otherCogs`,`listing_bat`.`advertising`,`listing_bat`.`auto`,`listing_bat`.`bankCharges`,`listing_bat`.`creditCardFees`,`listing_bat`.`depreciation`,`listing_bat`.`duesSubscriptions`,`listing_bat`.`insurance`,`listing_bat`.`interestExpense`,`listing_bat`.`legal`,`listing_bat`.`licensesFees`,`listing_bat`.`miscellaneous`,`listing_bat`.`payrollTaxes`,`listing_bat`.`postageDelivery`,`listing_bat`.`ownerPersonalExpenses`,`listing_bat`.`rent`,`listing_bat`.`repairsMaintenance`,`listing_bat`.`restaurantSupplies`,`listing_bat`.`royalties`,`listing_bat`.`salariesWages`,`listing_bat`.`telephone`,`listing_bat`.`utilities`,`listing_bat`.`uniforms`,`listing_bat`.`otherUncategorized`,`listing_bat`.`officeSupplies`,`listing_bat`.`janitorial`,`listing_bat`.`equipmentlease`,`listing_bat`.`donations`,`listing_bat`.`filledfieldvalue`,`listing_bat`.`ownerSalary`,`listing_bat`.`benefits`,`listing_bat`.`interestExpense_2`,`listing_bat`.`depreciation_2`,`listing_bat`.`ownerPersonalExpenses_2`,`listing_bat`.`other`,`listing`.`bexpiredate`,`listing_bat`.`sourceOfDataYear`,`listing_seller`.`obusinessphone`,`listing_seller`.`ocell`,`listing_seller`.`oemailaddress` from `listing` left join `listing_seller` on `listing_seller`.`listing_id` = `listing`.`id` left join `listing_office`   on `listing_office`.`listing_id` = `listing`.`id` left join `ca_buyers` on `ca_buyers`.`listing_id` = `listing`.`id` left join `listing_bat` on `listing_bat`.`listing_id` = `listing`.`id`  where `listing`.`bstatuslist` IN ($status)  AND `listing`.`is_duplicate` = '0' AND `listing`.`deleted_at` IS NULL group by `listing`.`id`"));
        } else {
            $results = DB::select( DB::raw("select `listing`.`id`, `listing`.`bname`, `listing`.`baddress`, `listing_seller`.`olegalname1`, `listing`.`bcity`, `listing`.`bstate`, `listing`.`bzip`, `listing`.`bcounty`,`listing_office`.`olagent`, `listing`.`bregion`, `listing_office`.`franchiseofficeid`, `listing`.`btype`, `listing`.`burldes`, `listing`.`bmetadescription`, `listing`.`bheadlinead`, `listing`.`bsaleprice`, `listing`.`daysonmarket`, `listing`.`bprivatelist`, `listing`.`bacquiredlist`, `listing`.`bgradelist`, count(ca_buyers.listing_id) as count_ca_buyers, `listing`.`isBat`, `listing`.`bstatuslist`, `listing`.`bprequalification`, `listing`.`bamount`, `listing`.`bcity`,  if(listing.showcity=1,'Yes','No') as showcityC, `listing`.`filtertype`, `listing_bat`.`grossSales`,`listing_bat`.`foodCosts`,`listing_bat`.`alcohalCosts`,`listing_bat`.`otherCogs`,`listing_bat`.`advertising`,`listing_bat`.`auto`,`listing_bat`.`bankCharges`,`listing_bat`.`creditCardFees`,`listing_bat`.`depreciation`,`listing_bat`.`duesSubscriptions`,`listing_bat`.`insurance`,`listing_bat`.`interestExpense`,`listing_bat`.`legal`,`listing_bat`.`licensesFees`,`listing_bat`.`miscellaneous`,`listing_bat`.`payrollTaxes`,`listing_bat`.`postageDelivery`,`listing_bat`.`ownerPersonalExpenses`,`listing_bat`.`rent`,`listing_bat`.`repairsMaintenance`,`listing_bat`.`restaurantSupplies`,`listing_bat`.`royalties`,`listing_bat`.`salariesWages`,`listing_bat`.`telephone`,`listing_bat`.`utilities`,`listing_bat`.`uniforms`,`listing_bat`.`otherUncategorized`,`listing_bat`.`officeSupplies`,`listing_bat`.`janitorial`,`listing_bat`.`equipmentlease`,`listing_bat`.`donations`,`listing_bat`.`filledfieldvalue`,`listing_bat`.`ownerSalary`,`listing_bat`.`benefits`,`listing_bat`.`interestExpense_2`,`listing_bat`.`depreciation_2`,`listing_bat`.`ownerPersonalExpenses_2`,`listing_bat`.`other`,`listing`.`bexpiredate`,`listing_bat`.`sourceOfDataYear`,`listing_seller`.`obusinessphone`,`listing_seller`.`ocell`,`listing_seller`.`oemailaddress` from `listing` left join `listing_seller` on `listing_seller`.`listing_id` = `listing`.`id` left join `listing_office`   on `listing_office`.`listing_id` = `listing`.`id` left join `ca_buyers` on `ca_buyers`.`listing_id` = `listing`.`id` left join `listing_bat` on `listing_bat`.`listing_id` = `listing`.`id` group by `listing`.`id`"));
        }

        
        foreach($results as $key=>$val){
           
            $getTotalCOGS = $val->foodCosts + $val->alcohalCosts + $val->otherCogs;

            $grossSales = $val->grossSales;

            $grossMargin = $grossSales - $getTotalCOGS;

            $totalExpenses = $val->advertising + $val->auto + $val->bankCharges + $val->creditCardFees + $val->depreciation + $val->duesSubscriptions + $val->insurance + $val->interestExpense + $val->legal + $val->licensesFees + $val->miscellaneous + $val->payrollTaxes + $val->postageDelivery + $val->ownerPersonalExpenses + $val->rent + $val->repairsMaintenance + $val->restaurantSupplies + $val->royalties + $val->salariesWages + $val->telephone + $val->utilities + $val->uniforms + $val->otherUncategorized + $val->officeSupplies + $val->janitorial + $val->equipmentlease + $val->donations + $val->filledfieldvalue;	

            $netIncome = $grossMargin - $totalExpenses;	

            $totalAddBacks = $val->ownerSalary + $val->benefits + $val->interestExpense_2 + $val->depreciation_2 + $val->ownerPersonalExpenses_2 + $val->other;

            $ownerBenefit = $netIncome + $totalAddBacks;

            $user = User::where('id','=',$val->olagent)->get();
            if(count($user) > 0){
                foreach($user as $u_key=>$u_val){
                    $u_name = $u_val->username;
                }
            }
            else {
                $u_name = '';
            }

            $dataArr = array($val->id, $val->bname, $val->baddress, $val->olegalname1, $val->bcity,$val->bstate, $val->bzip, $val->bcounty, $u_name, $val->bregion, $val->franchiseofficeid, $val->btype, $val->burldes, $val->bmetadescription, $val->bheadlinead, $val->bsaleprice, $val->daysonmarket, $val->bprivatelist, $val->bacquiredlist, $val->bgradelist,$val->count_ca_buyers, $val->isBat, $val->bstatuslist, $val->bprequalification, $val->bamount, $val->showcityC, '', $val->filtertype, $netIncome, $grossSales, $ownerBenefit, $val->bexpiredate, $val->sourceOfDataYear, $val->obusinessphone, $val->ocell, $val->oemailaddress);

            $object =  (object) $dataArr;

            $dataExcel[$key] = $object;
        }
        return collect($dataExcel);  
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:AJ1')->getFont()->setBold(true);
            },
        ];
    }
}
    
    

