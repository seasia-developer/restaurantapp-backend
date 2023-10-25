<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BbsListingReportdwnld;
use App\Models\Listing;
use App\Models\ListingBat;
use App\Models\ListingOccupancyLease;
use App\Models\ListingEquipment;
use Illuminate\Support\Carbon;
use App\Models\BbsReportDownload;
use App\Exports\ExportBbsListingReportdwnld;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Listing\ListingBatController as ListingBatController;

class BbsListingReportdwnldController extends Controller
{
    public function create(Request $request, $status){
        try{
            $grossSales = 0;
			$totalCOGS = 0;
			$grossMargin = 0;
			$totalExpenses = 0;
			$netIncome = 0;
			$totalAddBacks = 0;
			$ownerBenefit = 0;
            $totalmonthrent = 0;
            $linsidesqt = 0;
            $insidesqt = 0;
            $foodCosts = 0;
            $alcohalCosts = 0;
            $otherCogs = 0;
            $totalCOGS = 0;
            $grossMargin = 0;
            $advertising = 0;
            $auto = 0;
            $bankCharges = 0;
            $creditCardFees = 0;
            $depreciation = 0;
            $duesSubscriptions = 0;
            $insurance = 0;
            $interestExpense = 0;
            $legal = 0;
            $licensesFees = 0;
            $miscellaneous = 0;
            $payrollTaxes = 0;
            $postageDelivery = 0;
            $ownerPersonalExpenses = 0;
            $rent = 0;
            $repairsMaintenance = 0;
            $restaurantSupplies = 0;
            $royalties = 0;
            $salariesWages = 0;
            $telephone = 0;
            $utilities = 0;
            $uniforms = 0;
            $otherUncategorized = 0;
            $officeSupplies = 0;
            $janitorial = 0;
            $equipmentlease = 0;
            $donations = 0;
            $filledfieldvalue = 0;
            $totalExpenses = 0;
            $netIncome = 0;
            $ownerSalary = 0;
            $benefits = 0;
            $interestExpense_2 = 0;
            $depreciation_2 = 0;
            $ownerPersonalExpenses_2 = 0;
            $other = 0;
            $totalAddBacks = 0;
            $ownerBenefit = 0;

            $created_date = Carbon::now();
            $now = date('M-d-Y');
            // $filename = $status.'_BBS_Report('.$now.').xls';
            $filename = '';
            $column_array = array();
            $content_array = array();

            $batObj = new ListingBatController();

            $col_title = 
				'<Row><Cell ss:StyleID="2">
				   <Data ss:Type="String">Reference ID</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Heading</Data>
				</Cell>
				
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">State</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">County</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">City</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Zip</Data>
				</Cell>
			
				
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Is City Confidential (Y/N)</Data>
				</Cell>
			
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Is Franchise (Y/N)</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Is Asset Sale (Y/N)</Data>
				</Cell>
			
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Asking Price</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Gross Revenue</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Cash Flow</Data>
				</Cell>
				
		
				
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Real Estate Type (Owned/Leased)</Data>
				</Cell>
		
				
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Is Seller Financing Available (Y/N)</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Facilities</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Support</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Reasons for Selling</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Competition</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Growth</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Year Established</Data>
				</Cell>
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Number of Employees</Data>
				</Cell>
			
				<Cell ss:StyleID="2">
				   <Data ss:Type="String">Summary</Data>
				</Cell>
			
		
		
			</Row>';

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
            ->select('id','bheadlinead','bstate','bcounty','bcity','bzip','showcity','isBat','bsaleprice','bdetailedad')
            ->where('isBat','!=','Lease')
            ->where('activate','=','1')
            ->where('bstatuslist','=',$status)
            ->get();
            
            if(count($query) > 0){
                foreach($query as $key=>$rws){
                    $listingid = $rws['listing_id'];
                    $equiptext = $rws['equiptext'];
                    $equip = preg_replace('/[^A-Za-z0-9\-]/', ' ', $equiptext);
					$bdetailad = preg_replace('/[^A-Za-z0-9 !@#$%^&,;_*().]/u',' ', strip_tags($rws['bdetailedad']));
					$bdetailads = htmlspecialchars_decode($bdetailad);
					$bdetailed = preg_replace('/&nbsp;/', ' ', $bdetailads);
					$bdetailedad = preg_replace('/&ndash;/', "-", $bdetailed);
					$bdetailad = strip_tags($rws['bdetailedad']);
					$bdetailed = preg_replace('/&nbsp;/', ' ', $bdetailad);
					$bdetailedad1 = preg_replace('/&#39;/', "'", $bdetailed);
					$bdetailedad2 = preg_replace('/&amp;/', "&", $bdetailedad1);
					$bdetailedad3 = preg_replace('/&ndash;/', "-", $bdetailedad2);
					$bdetailedad = preg_replace('/&rsquo;/', "'", $bdetailedad3);
                    if(isset($rws->listing_occupancy_lease) && !empty($rws->listing_occupancy_lease) ){
                        $ltotalmnthrent = explode(',',$rws->listing_occupancy_lease['ltotalmonthrent']);
                        $linsidesqt = explode(',',$rws->listing_occupancy_lease['linsidesqt']);
                    }
                    if(isset($rws->listing_occupancy_lease['ltotalmonthrent'])){
                        if( $rws->listing_occupancy_lease['ltotalmonthrent'] != ''){
                            $dataArr = $rws->listing_occupancy_lease['ltotalmonthrent'];
                            if($dataArr != ''){
                                $dataArr = json_decode($dataArr, true);
                                $dataArr = is_array($dataArr) ? $dataArr : array($dataArr);
                                $totalmonthrent =  array_sum($dataArr);
                            }
                        }
                    }
                    
                    if(isset($rws->listing_occupancy_lease['linsidesqt'])){
                        if( $rws->listing_occupancy_lease['linsidesqt'] != ''){
                            $linsidesqtArr = $rws->listing_occupancy_lease['linsidesqt'];
                            if($linsidesqtArr != ''){
                                $linsidesqtArr = json_decode($linsidesqtArr, true);
                                $linsidesqtArr = is_array($linsidesqtArr) ? $linsidesqtArr : array($linsidesqtArr);
                                $insidesqt =  array_sum($linsidesqtArr);
                            }
                        }
                    }

                    if(is_numeric($totalmonthrent) && is_numeric($insidesqt)){
                        if($insidesqt != 0){
						    $totalRentSQ = $totalmonthrent/$insidesqt;
                        } else{
                            $totalRentSQ = 0;
                        }
						$totalRentSQ1 = round($totalRentSQ,2);
					}

                    if($totalmonthrent >0 || $totalmonthrent !=''){
                        $ltotalmonthrent = 'Leased';
                    }else{
                        $ltotalmonthrent ='Owned';
                    }
                    $isbat='';
                    $Lease='';
                    if($rws['isBat'] === "Yes"){
                        $isbat = 'No';
                    }
                    if($rws['isBat'] === "No"){
                        $isbat = 'Yes';
                    }
                    if($rws['isBat'] === "Lease"){
                        $Lease = 'No';
                    }
                    if($rws['showcity'] == 1){
                        $showcity = 'Yes';
                    }
                    if($rws['showcity'] == 0){
                        $showcity = 'No';
                    }
                    if($ltotalmonthrent == 'Owned'){
                        $Lease ='Yes';
                    }
                    if(isset($rws->listing_bat)){
                        if( ( (int) $rws->listing_bat['grossSales'] ) > 0 ){
                            $rws->listing_bat['grossSales'] = $grossSales;
                    
                            if(isset($rws->listing_bat['foodCosts'])){
                                $foodCosts = $rws->listing_bat['foodCosts'];
                            } 
                    
                            if(isset($rws->listing_bat['alcohalCosts'])){
                                $alcohalCosts = $rws->listing_bat['alcohalCosts'];
                            } 
                    
                            if(isset($rws->listing_bat['otherCogs'])){
                                $otherCogs = $rws->listing_bat['otherCogs'];
                            } 
                            $totalCOGS = $batObj->getTotalCOGS($foodCosts, $alcohalCosts, $otherCogs);
                    
                            $grossMargin = $batObj->getGrossMargin($grossSales, $totalCOGS);
                    
                            if(isset($rws->listing_bat['advertising'])){
                                $advertising = $rws->listing_bat['advertising'];
                            } 
                    
                            if(isset($rws->listing_bat['auto'])){
                                $auto = $rws->listing_bat['auto'];
                            } 
                    
                            if(isset($rws->listing_bat['bankCharges'])){
                                $bankCharges = $rws->listing_bat['bankCharges'];
                            } 
                    
                            if(isset($rws->listing_bat['creditCardFees'])){
                                $creditCardFees = $rws->listing_bat['creditCardFees'];
                            } 
                    
                            if(isset($rws->listing_bat['depreciation'])){
                                $depreciation = $rws->listing_bat['depreciation'];
                            } 
                    
                            if(isset($rws->listing_bat['duesSubscriptions'])){
                                $duesSubscriptions = $rws->listing_bat['duesSubscriptions'];
                            } 
                    
                            if(isset($rws->listing_bat['insurance'])){
                                $insurance = $rws->listing_bat['insurance'];
                            } 
                    
                            if(isset($rws->listing_bat['interestExpense'])){
                                $interestExpense = $rws->listing_bat['interestExpense'];
                            } 
                    
                            if(isset($rws->listing_bat['legal'])){
                                $legal =$rws->listing_bat['legal'];
                            } 
                    
                            if(isset($rws->listing_bat['licensesFees'])){
                                $licensesFees = $rws->listing_bat['licensesFees'];
                            } 
                    
                            if(isset($rws->listing_bat['miscellaneous'])){
                                $miscellaneous = $rws->listing_bat['miscellaneous'];
                            } 
                    
                            if(isset($rws->listing_bat['payrollTaxes'])){
                                $payrollTaxes = $rws->listing_bat['payrollTaxes'];
                            } 
                    
                            if(isset($rws->listing_bat['postageDelivery'])){
                                $postageDelivery = $rws->listing_bat['postageDelivery'];
                            } 
                    
                            if(isset($rws->listing_bat['ownerPersonalExpenses'])){
                                $ownerPersonalExpenses = $rws->listing_bat['ownerPersonalExpenses'];
                            }
                    
                            if(isset($rws->listing_bat['rent'])){
                                $rent = $rws->listing_bat['rent'];
                            } 
                    
                            if(isset($rws->listing_bat['repairsMaintenance'])){
                                $repairsMaintenance = $rws->listing_bat['repairsMaintenance'];
                            } 
                    
                            if(isset($rws->listing_bat['restaurantSupplies'])){
                                $restaurantSupplies = $rws->listing_bat['restaurantSupplies'];
                            } 
                    
                            if(isset($rws->listing_bat['royalties'])){
                                $royalties = $rws->listing_bat['royalties'];
                            } 
                    
                            if(isset($rws->listing_bat['salariesWages'])){
                                $salariesWages = $rws->listing_bat['salariesWages'];
                            } 
                    
                            if(isset($rws->listing_bat['telephone'])){
                                $telephone = $rws->listing_bat['telephone'];
                            } 
                    
                            if(isset($rws->listing_bat['utilities'])){
                                $utilities = $rws->listing_bat['utilities'];
                            } 
                    
                            if(isset($rws->listing_bat['uniforms'])){
                                $uniforms = $rws->listing_bat['uniforms'];
                            } 
                    
                            if(isset($rws->listing_bat['otherUncategorized'])){
                                $otherUncategorized = $rws->listing_bat['otherUncategorized'];
                            } 
                    
                            if(isset($rws->listing_bat['officeSupplies'])){
                                $officeSupplies = $rws->listing_bat['officeSupplies'];
                            } 
                    
                            if(isset($rws->listing_bat['janitorial'])){
                                $janitorial = $rws->listing_bat['janitorial'];
                            } 
                    
                            if(isset($rws->listing_bat['equipmentlease'])){
                                $equipmentlease = $rws->listing_bat['equipmentlease'];
                            } 
                    
                            if(isset($rws->listing_bat['donations'])){
                                $donations = $rws->listing_bat['donations'];
                            } 
                            if(isset($rws->listing_bat['filledfieldvalue'])){
                                $filledfieldvalue = $rws->listing_bat['filledfieldvalue'];
                            } 
                    
                            $totalExpenses = $batObj->getTotalExpenses( $advertising, $auto, $bankCharges, $creditCardFees, $depreciation, $duesSubscriptions, $insurance, $interestExpense, $legal, $licensesFees, $miscellaneous, $payrollTaxes, $postageDelivery, $ownerPersonalExpenses, $rent, $repairsMaintenance, $restaurantSupplies, $royalties, $salariesWages, $telephone, $utilities, $uniforms, $otherUncategorized, $officeSupplies, $janitorial, $equipmentlease, $donations, $filledfieldvalue );
                    
                            $netIncome = $batObj->getNetIncome($grossMargin, $totalExpenses);
                    
                            if(isset($rws->listing_bat['ownerSalary'])){
                                $ownerSalary = $rws->listing_bat['ownerSalary'];
                            } 
                    
                            if(isset($rws->listing_bat['benefits'])){
                                $benefits = $rws->listing_bat['benefits'];
                            } 
                    
                            if(isset($rws->listing_bat['interestExpense_2'])){
                                $interestExpense_2 = $rws->listing_bat['interestExpense_2'];
                            } 
                    
                            if(isset($rws->listing_bat['depreciation_2'])){
                                $depreciation_2 = $rws->listing_bat['depreciation_2'];
                            } 
                    
                            if(isset($rws->listing_bat['ownerPersonalExpenses_2'])){
                                $ownerPersonalExpenses_2 = $rws->listing_bat['ownerPersonalExpenses_2'];
                            } 
                    
                            if(isset($rws->listing_bat['other'])){
                                $other = $rws->listing_bat['other'];
                            } 
                    
                            $totalAddBacks = $batObj->getTotalAddBacks($ownerSalary, $benefits, $interestExpense_2, $depreciation_2, $ownerPersonalExpenses_2, $other );
                    
                            $ownerBenefit = $batObj->getOwnerBenefit($netIncome, $totalAddBacks);	 
                        }
                    }
                   
                    if(isset($rws->listing_ops)){
                        $compMarProCon = preg_replace('/[^A-Za-z0-9\-]/', ' ', $rws->listing_ops['compMarProCon']);
                        $growthExpProCon = preg_replace('/[^A-Za-z0-9\-]/', ' ', $rws->listing_ops['growthExpProCon']);
                    } else {
                        $compMarProCon = '';
                        $growthExpProCon = '';
                    }

                    $column_values = array(
                        "reference_id" => $rws['id'],
                        "heading" => $rws['bheadlinead'],
                        "state" =>$rws['bstate'],
                        "county" =>$rws['bcounty'],
                        "city" => $rws['bcity'],
                        "zip" => $rws['bzip'],
                        "is_city_confidential" => $showcity,
                        "is_franchise" =>$rws['batFranchise'],
                        "is_asset_sale" => $isbat,
                        "asking_price" => $rws['bsaleprice'],
                        "gross_revenue" => $rws['grossSales'],
                        "cash_flow" => $ownerBenefit,
                        "real_estate_type_owned_or_lease" => $ltotalmonthrent,
                        "is_seller_financing_available" => isset($rws['sellerFinancing'])?$rws['sellerFinancing']:'',
                        "facilities" => strip_tags($equip),
                        "support" => isset($rws['opTraining']) ? $rws['opTraining']:'',
                        "reasons_for_selling" => isset($rws['reasonForSelling']) ? $rws['reasonForSelling']:'',
                        "competition" => $compMarProCon,
                        "growth" => $growthExpProCon,
                        "year_established" => isset($rws['yearestablish'])?$rws['yearestablish']:'',
                        "number_of_employees" => isset($rws['totalemp'])?$rws['totalemp']:'',
                        "summary" => $bdetailedad,
                    );
                    
                    
                    $this->save_listing_bbs_report_data($column_values,$rws['id']);
                    $data[] = $column_values;
                }
                $contents = $this->getExcelData($data);	
                if($filename ==''){
                    $filename = $status.'_BBS_Report('.$now.').xls';
                }
                
                header("Content-Type: application/vnd.ms-excel;");
                header("Content-Disposition: attachment; filename=$filename");
                header("Pragma: no-cache");
                header("Expires: 0");
					
			    $xls_header = '<?xml version="1.0" encoding="utf-8"?>
                <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">
                <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
                <Author></Author>
                <LastAuthor></LastAuthor>
                <Company></Company>
                </DocumentProperties>
                <Styles>
                    <Style ss:ID="1">
                    <Alignment ss:Horizontal="Left"/>
                    </Style>
                    <Style ss:ID="2">
                    <Alignment ss:Horizontal="Left"/>
                    <Font ss:Bold="1"/>
                    </Style>
                    <Style ss:ID="s23">
                    <Font ss:Bold="1" ss:Color="RED"/>
                    </Style>
                    <Style ss:ID="s24">
                    <Interior ss:Color="#0000FF" ss:Pattern="Solid"/>
                    </Style>
                </Styles>
                <Worksheet ss:Name="Export">
			    <Table>';

                $xls_footer = '</Table>
                <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
                <Selected/>
                <FreezePanes/>
                <FrozenNoSplit/>
                <SplitHorizontal>1</SplitHorizontal>
                <TopRowBottomPane>1</TopRowBottomPane>
                </WorksheetOptions>
                </Worksheet>
                </Workbook>';			

                $this->save_bbs_report_data($filename, Carbon::now() );
                $content_array[] = $contents;
            }
            $result =  $xls_header.$col_title.$contents.$xls_footer;
			
			file_put_contents(storage_path('app/public/bbs/export_files/'.$filename),$result);
			chmod(storage_path('app/public/bbs/export_files/'.$filename), 0777);

            $folder = ('storage/bbs/export_files/');
            $path = url($folder.$filename);
            
            return response()->json([ 'message'=>'success','code'=>'200','data'=>$path ]);
        }catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        } 
    }

    public function save_listing_bbs_report_data($data, $listing_id){
        try{
            $query = BbsListingReportdwnld::select('reference_id')->where('reference_id',$listing_id)->get();
            if(count($query) > 0){

            } else {
                $result = BbsListingReportdwnld::insert($data);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function getExcelData($dataArr){
        try{
            $retData = '';
            if(is_array($dataArr)  && !empty($dataArr)){
                foreach($dataArr as $row){
                    $line = '';
                    $cellValue ='';
                    $flag = 0;
                    $cellArr = array();
                    foreach($row as $key=>$val){
                        if($key =='reference_id'){
                            $listing = $val;
                        }
                        $bbsfield = $this->getBBSreportdata($key,$listing,$val);
                        $id ='';
                        if($bbsfield != 0){
                            $id = 'ss:StyleID="s23"';
                            $flag = 1;
                        }else{
                            $id ='ss:StyleID="1"';
                        }
                        $cellValue .= '<Cell  '.$id.'><Data ss:Type="String" > ' .$val . '</Data></Cell>\t';	
                    }
                    if($flag == 1){
                        $retData .= trim("<Row>".$cellValue."</Row>")."\n";
                    }	
                }
                $retData = str_replace("\r","",$retData);
            }
            return $retData;
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function getBBSreportdata($field,$listingid,$val){
        try{
            $rsVar = DB::select(("SELECT `$field` from bbs_listing_reportdwnlds where `reference_id` =".$listingid)); 
            if(count($rsVar) > 0){
                foreach($rsVar as $key=>$row){
                    $data[$field] = $val;
                    $getres = strcmp($val,$row->$field);
                    BbsListingReportdwnld::where('reference_id',$listingid)->update($data);
                    return $getres;
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
	}

    public function export_listing_bbs_report_data($data,$get_status){
        try{ 
            $arr[] = $data;
            $now = date('M-d-Y');
            $name = $get_status.'_BBS_Report('.$now.').xls';
            $folder = 'bbs';
            // https://stackoverflow.com/questions/61980307/export-csv-with-laravel-excel-in-specific-folder
            Excel::store( new ExportBbsListingReportdwnld($arr), $name, 'export_path' );
            
            return Excel::download(new ExportBbsListingReportdwnld($arr), $name);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
    // change agent_id -- createdby
    public function save_bbs_report_data($name,$created_date){
        try{
            $user = Auth::user();
            $agentid = Auth::user()->id;
            $data = array(
                'filename' => $name,
                'createddate' => $created_date,
                'createdby' => $agentid,
                'status' => 0,
            );
            $result = BbsReportDownload::insert($data);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
    
    public function index(Request $request){
        try{
            if(isset($request->per_page) && $request->per_page <= 51) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            }
            if(isset($request->agent)){
                // $data = BbsReportDownload::select()
                $data = BbsReportDownload::select('bbs_report_download.*','agents.id as agent','agents.firstname','agents.lastname','users.username')
                ->leftJoin('agents','agents.id','=','bbs_report_download.createdby')
                ->leftJoin('users','users.id','=','bbs_report_download.createdby')
                ->where('createdby',$request->agent)
                ->paginate($per_page);
            } else {
                // $data = BbsReportDownload::paginate($per_page);
                $data = BbsReportDownload::select('bbs_report_download.*','agents.id as agent','agents.firstname','agents.lastname','users.username')
                ->leftJoin('agents','agents.id','=','bbs_report_download.createdby')
                ->leftJoin('users','users.id','=','bbs_report_download.createdby')
                ->paginate($per_page);
                
            }
            return response()->json(['message'=>'success', 'code'=>'200', 'data'=>$data ]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function report_download($id){
        try{
            $result = BbsReportDownload::where('id',$id)->first();
            $filename = $result->filename;
            $folder = "public/storage/bbs/export_files/";
            if(isset($filename)){
                $path = url($folder.$filename);
            } else {
                $path = '';
            }
            return response()->json(['message'=>'success','code'=>'200','data'=>$path]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
    
    public function delete_report($id){
        try{
            $result = BbsReportDownload::where('id',$id)->first();
            $filename = $result->filename;
            $folder = "storage/bbs/export_files/";
            $filePath = $folder . $filename;
            if(File::exists(storage_path($filePath))){
                File::delete(storage_path($filePath));
            }
            $result->delete();
            return response()->json(['message'=>'success','code'=>'200','data'=>'Record deleted successfully.']);
        } catch(\Exception $e){
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage() ]);
        }
    }
    
    public function multiDownload(Request $request){
        try{
            $input = $request->all();
            $ref_id = $input['id'];
            $folder = "public/storage/bbs/export_files/";
            $path_arr = array();
            foreach($ref_id as $key=>$val){
                $result = BbsReportDownload::where('id',$val)->first();
                if(isset($result)){
                    $filename = $result->filename;
                    if(isset($filename)){
                        $path = url($folder.$filename);
                    } else {
                        $path = '';
                    }
                    array_push($path_arr,$path);
                }
            }   
            return response()->json(['message'=>'success','code'=>'200','data'=>$path_arr]);
        } catch(\Exception $e){
            return response()->json([ 'message'=>'error','code'=>'302','data'=>$e->getMessage() ]);
        }
    }
}