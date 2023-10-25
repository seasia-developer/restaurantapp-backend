<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Controllers\Api\Listing\ListingBatController as ListingBatController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BbsListingReportDownloadExport;
use App\Models\Agents;
class BbsListingReportDownloadController extends Controller
{
    public function index(Request $request){
        try { 
            $grossSales = 0;
			$totalCOGS = 0;
			$grossMargin = 0;
			$totalExpenses = 0;
			$netIncome = 0;
			$totalAddBacks = 0;
			$ownerBenefit = 0;	
            $batObj = new ListingBatController();
            $query = Listing::with(['listing_bat' => function($listing_bat){
                $listing_bat->select('listing_id','reasonForSelling','batFranchise','grossSales','sellerFinancing','foodCosts','alcohalCosts','otherCogs','advertising','auto','bankCharges','creditCardFees','depreciation','duesSubscriptions','insurance','interestExpense','legal','licensesFees','miscellaneous','payrollTaxes','postageDelivery','ownerPersonalExpenses','rent','repairsMaintenance','restaurantSupplies','royalties','salariesWages','telephone','utilities','uniforms','otherUncategorized','officeSupplies','janitorial','equipmentlease','donations','filledfieldvalue', 'ownerSalary', 'benefits', 'interestExpense_2', 'depreciation_2', 'ownerPersonalExpenses_2', 'other');
            }])
            ->with(['listing_occupancy_lease' => function($listing_occupancy_lease){
                $listing_occupancy_lease->select('listing_id','ltotalmonthrent','linsidesqt','leaseExpire','lterm');
            }])
            ->with(['listing_ops' => function($listing_ops){
                $listing_ops->select('listing_id','opTraining','compMarProCon','growthExpProCon','yearestablish','totalemp');
            }])
            ->with(['listing_occupancy_real_estates' => function($listing_occupancy_real_estates){
                $listing_occupancy_real_estates->select('listing_id','rpricesqt');
            }])
            ->with(['listing_equipment' => function($listing_equipment){
                $listing_equipment->select('listing_id','equiptext');
            }]) 
            ->with(['office' => function($office){
                $office->select('listing_id','franchiseofficeid');
            }]) 
            ->select('id','bheadlinead','bstate','bcounty','bcity','bzip','showcity','isBat','bsaleprice','bdetailedad','bstatuslist','olagent');

            if(isset($request->agent_id)){
                $query = $query->where('isBat','!=','Lease')
                    ->where('activate','=','1')
                    ->where('olagent',$request->agent_id)
                    ->whereIn('bstatuslist', ['Available', 'LOI', 'In Contract'])
                    ->get();
            } else {
                $query = $query->where('isBat','!=','Lease')
                    ->where('activate','=','1')
                    ->whereIn('bstatuslist', ['Available', 'LOI', 'In Contract'])
                    ->get();
            }
            
            $created_date = Carbon::now();
            $now = date('M-d-Y');
            $column_array = array();
            $get_office_name = '';
            $count = count($query) ;
            if($count > 0){
                foreach($query as $val){
                    if(isset($val->office['franchiseofficeid'])){
                        $get_office_details = Agents::select('title')->where('id',$val->office['franchiseofficeid'])->first();
                    }
                    
                    if(isset($val->listing_bat['grossSales'])){
                        if( ( (int) $val->listing_bat['grossSales'] ) > 0 ){
                            $val->listing_bat['grossSales'] = $grossSales;

                            if(isset($val->listing_bat['foodCosts'])){
                                $foodCosts = $val->listing_bat['foodCosts'];
                            } else {
                                $foodCosts = 0;
                            }

                            if(isset($val->listing_bat['alcohalCosts'])){
                                $alcohalCosts = $val->listing_bat['alcohalCosts'];
                            } else {
                                $alcohalCosts = 0;
                            }

                            if(isset($val->listing_bat['otherCogs'])){
                                $otherCogs = $val->listing_bat['otherCogs'];
                            } else {
                                $otherCogs = 0;
                            }
                            $totalCOGS = $batObj->getTotalCOGS($foodCosts, $alcohalCosts, $otherCogs);

                            $grossMargin = $batObj->getGrossMargin($grossSales, $totalCOGS);

                            if(isset($val->listing_bat['advertising'])){
                                $advertising = $val->listing_bat['advertising'];
                            } else {
                                $advertising = 0;
                            }

                            if(isset($val->listing_bat['auto'])){
                                $auto = $val->listing_bat['auto'];
                            } else {
                                $auto = 0;
                            }

                            if(isset($val->listing_bat['bankCharges'])){
                                $bankCharges = $val->listing_bat['bankCharges'];
                            } else {
                                $bankCharges = 0;
                            }

                            if(isset($val->listing_bat['creditCardFees'])){
                                $creditCardFees = $val->listing_bat['creditCardFees'];
                            } else {
                                $creditCardFees = 0;
                            }

                            if(isset($val->listing_bat['depreciation'])){
                                $depreciation = $val->listing_bat['depreciation'];
                            } else {
                                $depreciation = 0;
                            }

                            if(isset($val->listing_bat['duesSubscriptions'])){
                                $duesSubscriptions = $val->listing_bat['duesSubscriptions'];
                            } else {
                                $duesSubscriptions = 0;
                            }

                            if(isset($val->listing_bat['insurance'])){
                                $insurance = $val->listing_bat['insurance'];
                            } else {
                                $insurance = 0;
                            }

                            if(isset($val->listing_bat['interestExpense'])){
                                $interestExpense = $val->listing_bat['interestExpense'];
                            } else {
                                $interestExpense = 0;
                            }

                            if(isset($val->listing_bat['legal'])){
                                $legal =$val->listing_bat['legal'];
                            } else {
                                $legal = 0;
                            }

                            if(isset($val->listing_bat['licensesFees'])){
                                $licensesFees = $val->listing_bat['licensesFees'];
                            } else {
                                $licensesFees = 0;
                            }

                            if(isset($val->listing_bat['miscellaneous'])){
                                $miscellaneous = $val->listing_bat['miscellaneous'];
                            } else {
                                $miscellaneous = 0;
                            }

                            if(isset($val->listing_bat['payrollTaxes'])){
                                $payrollTaxes = $val->listing_bat['payrollTaxes'];
                            } else {
                                $payrollTaxes = 0;
                            }

                            if(isset($val->listing_bat['postageDelivery'])){
                                $postageDelivery = $val->listing_bat['postageDelivery'];
                            } else {
                                $postageDelivery = 0;
                            }

                            if(isset($val->listing_bat['ownerPersonalExpenses'])){
                                $ownerPersonalExpenses = $val->listing_bat['ownerPersonalExpenses'];
                            } else {
                                $ownerPersonalExpenses = 0;
                            }

                            if(isset($val->listing_bat['rent'])){
                                $rent = $val->listing_bat['rent'];
                            } else {
                                $rent = 0;
                            }

                            if(isset($val->listing_bat['repairsMaintenance'])){
                                $repairsMaintenance = $val->listing_bat['repairsMaintenance'];
                            } else {
                                $repairsMaintenance = 0;
                            }

                            if(isset($val->listing_bat['restaurantSupplies'])){
                                $restaurantSupplies = $val->listing_bat['restaurantSupplies'];
                            } else {
                                $restaurantSupplies = 0;
                            }

                            if(isset($val->listing_bat['royalties'])){
                                $royalties = $val->listing_bat['royalties'];
                            } else {
                                $royalties = 0;
                            }

                            if(isset($val->listing_bat['salariesWages'])){
                                $salariesWages = $val->listing_bat['salariesWages'];
                            } else {
                                $salariesWages = 0;
                            }

                            if(isset($val->listing_bat['telephone'])){
                                $telephone = $val->listing_bat['telephone'];
                            } else {
                                $telephone = 0;
                            }

                            if(isset($val->listing_bat['utilities'])){
                                $utilities = $val->listing_bat['utilities'];
                            } else {
                                $utilities = 0;
                            }

                            if(isset($val->listing_bat['uniforms'])){
                                $uniforms = $val->listing_bat['uniforms'];
                            } else {
                                $uniforms = 0;
                            }

                            if(isset($val->listing_bat['otherUncategorized'])){
                                $otherUncategorized = $val->listing_bat['otherUncategorized'];
                            } else {
                                $otherUncategorized = 0;
                            }

                            if(isset($val->listing_bat['officeSupplies'])){
                                $officeSupplies = $val->listing_bat['officeSupplies'];
                            } else {
                                $officeSupplies = 0;
                            }

                            if(isset($val->listing_bat['janitorial'])){
                                $janitorial = $val->listing_bat['janitorial'];
                            } else {
                                $janitorial = 0;
                            }

                            if(isset($val->listing_bat['equipmentlease'])){
                                $equipmentlease = $val->listing_bat['equipmentlease'];
                            } else {
                                $equipmentlease = 0;
                            }

                            if(isset($val->listing_bat['donations'])){
                                $donations = $val->listing_bat['donations'];
                            } else {
                                $donations = 0;
                            }

                            if(isset($val->listing_bat['filledfieldvalue'])){
                                $filledfieldvalue = $val->listing_bat['filledfieldvalue'];
                            } else {
                                $filledfieldvalue = 0;
                            }

                            $totalExpenses = $batObj->getTotalExpenses( $advertising, $auto, $bankCharges, $creditCardFees, $depreciation, $duesSubscriptions, $insurance, $interestExpense, $legal, $licensesFees, $miscellaneous, $payrollTaxes, $postageDelivery, $ownerPersonalExpenses, $rent, $repairsMaintenance, $restaurantSupplies, $royalties, $salariesWages, $telephone, $utilities, $uniforms, $otherUncategorized, $officeSupplies, $janitorial, $equipmentlease, $donations, $filledfieldvalue );

                            $netIncome = $batObj->getNetIncome($grossMargin, $totalExpenses);

                            if(isset($val->listing_bat['ownerSalary'])){
                                $ownerSalary = $val->listing_bat['ownerSalary'];
                            } else {
                                $ownerSalary = 0;
                            }

                            if(isset($val->listing_bat['benefits'])){
                                $benefits = $val->listing_bat['benefits'];
                            } else {
                                $benefits = 0;
                            }

                            if(isset($val->listing_bat['interestExpense_2'])){
                                $interestExpense_2 = $val->listing_bat['interestExpense_2'];
                            } else {
                                $interestExpense_2 = 0;
                            }

                            if(isset($val->listing_bat['depreciation_2'])){
                                $depreciation_2 = $val->listing_bat['depreciation_2'];
                            } else {
                                $depreciation_2 = 0;
                            }

                            if(isset($val->listing_bat['ownerPersonalExpenses_2'])){
                                $ownerPersonalExpenses_2 = $val->listing_bat['ownerPersonalExpenses_2'];
                            } else {
                                $ownerPersonalExpenses_2 = 0;
                            }

                            if(isset($val->listing_bat['other'])){
                                $other = $val->listing_bat['other'];
                            } else {
                                $other = 0;
                            }
    
                            $totalAddBacks = $batObj->getTotalAddBacks($ownerSalary, $benefits, $interestExpense_2, $depreciation_2, $ownerPersonalExpenses_2, $other );

                            $ownerBenefit = $batObj->getOwnerBenefit($netIncome, $totalAddBacks);	 
                        }
                    }
                    if(isset($val->listing_occupancy_lease['ltotalmonthrent'])){
                        $dataArr = $val->listing_occupancy_lease['ltotalmonthrent'];
                        if($dataArr != ''){
                            $dataArr = json_decode($dataArr, true);
                            $dataArr = is_array($dataArr) ? $dataArr : array($dataArr);
                            $totalmonthlyrent =  array_sum($dataArr);
                        }
                    } else {
                        $totalmonthlyrent = 0;
                    }
                    if(isset($val->listing_occupancy_lease['linsidesqt'])){
                        $dataArr = $val->listing_occupancy_lease['linsidesqt'];
                        if($dataArr != ''){
                            $dataArr = json_decode($dataArr, true);
                            $dataArr = is_array($dataArr) ? $dataArr : array($dataArr);
                            $totallinsidesqt =  array_sum($dataArr);
                        }
                    } else {
                        $totallinsidesqt = 0;
                    }
                    if($totalmonthlyrent > 0 || $totalmonthlyrent !=''){
                        $totalmonthrent = 'Leased';
                    }
                    else{
                        $totalmonthrent ='Owned';
                    }
                    $isbat='';
                    $Lease='';
                    if($val['isBat'] === "Yes"){
                        $isbat = 'No';
                    }
                    if($val['isBat'] === "No"){
                        $isbat = 'Yes';
                    }
                    if($val['isBat'] === "Lease"){
                        $Lease = 'No';
                    }
                    if($val['showcity'] == 1){
                        $showcity = 'Yes';
                    }
                    if($val['showcity'] == 0){
                        $showcity = 'No';
                    }
                    if($totalmonthlyrent == 'Owned'){
                        $Lease ='Yes';
                    }
                    $column_values = array(
                        'office'=>isset($get_office_details->title) ? $get_office_details->title:'',
                        'reference_id' => $val['id'],
                        'heading' => isset($val['bheadlinead']) ? $val['bheadlinead']:'',
                        'Country' => isset($val['bcountry']) ? $val['bcountry']:'',
                        "street_address" => '',
                        'state' => isset($val['bstate']) ? $val['bstate']:'',
                        'county' => isset($val['bcounty']) ? $val['bcounty']:'',
                        'city' => isset($val['bcity']) ? $val['bcity']:'',
                        'zip' => isset($val['bzip']) ? $val['bzip']:'',
                        'is_city_confidential' => isset($showcity) ? $showcity:'',
                        "is_county_confidential_y/n" =>'',
                        "is_address_confidential_y/n" =>'Yes',
                        "is_home_based_y/n" =>'',
                        "Is Relocatable (Y/N)" =>'',
                        'is_franchise' => isset($val->listing_bat['batFranchise']) ? $val->listing_bat['batFranchise']:'',
                        'is_asset_sale' => isset($val['isBat']) ? $val['isBat']:'',
                        'is_miscellaneous_listing' => '',
                        'asking_price' => isset($val['bsaleprice']) ? $val['bsaleprice']:'',
                        'gross_revenue' => isset($val['grossSales']) ? $val['grossSales']:'',
                        'cash_flow' => $ownerBenefit,
                        "ebitda" => '',
                        "inventory" =>'',
                        "is_inventory_included_in_asking_price_y/n" => 'N',
                        "ffe" => '',
                        'real_estate_type_owned_or_lease' => $totalmonthrent,
                        "building_square_feet" =>$totallinsidesqt,
                        "real_estate_value" => '',
                        "is_real_estate_included_in_asking_price_y/n" => $Lease,
                        "seller_financing_notes" => '',
                        'is_seller_financing_available' => isset($val->listing_bat['sellerFinancing']) ? $val->listing_bat['sellerFinancing']:'',
                        'facilities' => isset($val->listing_equipment['equiptext']) ? $val->listing_equipment['equiptext']:'',
                        'support' => isset($val->listing_ops['opTraining']) ? $val->listing_ops['opTraining']:'',
                        'reasons_for_selling' => isset($val->listing_bat['reasonForSelling']) ? $val->listing_bat['reasonForSelling']:'',
                        'competition' => isset($val->listing_bat['compMarProCon']) ? $val->listing_bat['compMarProCon']:'',
                        'growth' => isset($val->listing_bat['growthExpProCon']) ? $val->listing_bat['growthExpProCon']:'',
                        'year_established' => isset($val->listing_ops['yearestablish']) ? $val->listing_ops['yearestablish']:'',
                        'number_of_employees' => isset($val->listing_ops['totalemp']) ? $val->listing_ops['totalemp']: '',
                        "web_address" => "https://www.wesellrestaurants.com",
                        'summary' => isset($val->bdetailedad) ? $val->bdetailedad:'',
                        "listing_tag_line" => '',
                        "real_estate_asking_price_per_square_foot" =>  isset($val->listing_occupancy_real_estates['rpricesqt']) ? $val->listing_occupancy_real_estates['rpricesqt']:'',
                        "net_operating_income" =>'',
                        "current_property_expenses" =>'',
                        "location_description" =>'',
                        "current_and_prior_use" =>'',
                        "year_of_construction" =>'',
                        "lease_rate_per_square_foot" =>$totalmonthlyrent,
                        "lease_is_per_yr_or_mo" =>"mo",
                        "lease_expiration_date" => isset($val->listing_occupancy_lease['leaseExpire']) ? $val->listing_occupancy_lease['leaseExpire']:'',
                        "expenses_per_square_foot" => '',
                        "lease_terms_available" => isset($val->listing_occupancy_lease['lterm']) ? $val->listing_occupancy_lease['lterm']:'',
                        "lease_is_nnn" => '',
                        "minimum_available_space" => '',
                        "maximum_available_space" => '',
                        "number_of_establishments" => '',
                    );
                    array_push($column_array, $column_values);	
                } 
                
            }
            $name = 'BBS download Report.xls';
            Excel::store( new BbsListingReportDownloadExport($column_array), $name, 'export_path' );
            $folder = "public/storage/bbs/export_files/";
            $path = url($folder.$name);
            return response()->json([ 'message'=>'success', 'code'=>'200', 'data'=>$path]);
        } catch(\Exception $e){
            return response()->json([ 'message'=>'error','code'=>'302','data'=>$e->getMessage() ]);
        }
    }
}
