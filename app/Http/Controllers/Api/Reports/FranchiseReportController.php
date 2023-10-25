<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FranchiseExport;

class FranchiseReportController extends Controller
{
    public function index(Request $request){
        try {
            $status = $request->status;
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
                $page = $request->page;
            } else {
                $per_page = 10;
                $page = 0;
            }
            if($status == ""){
                $status = "Available,Coming Soon,Listing Signed,Sold,Expired,Cancelled,LOI,In Contract,Available not Advertised";
                $where= " and FIND_IN_SET(bstatuslist,'".$status."')";
            } elseif($status != "All"){
                $where= " and FIND_IN_SET(bstatuslist,'".$status."')";
            } else {
                $where= " and FIND_IN_SET(bstatuslist,'".$status."')";
            }
            $total_rec = 0;
            $dataArr = array();
            if(isset($request->agent) && !empty($request->agent)){
                if(isset($request->search) && !empty($request->search)){
                    $search = $request->search;
                    $rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l  join listing_bat as lb on l.id=lb.listing_id  agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " and l.olagent=".$request->agent." and l.bname like '%$search%' LIMIT ".$per_page." OFFSET ".$page));
                    
                    $count_rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id  join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " and l.olagent=".$request->agent." and l.bname like '%$search%' "));
                    $total_rec = count($count_rawQry);
                } else {
                    $rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id  join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " and l.olagent=".$request->agent." LIMIT ".$per_page." OFFSET ".$page));
                    
                    $count_rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " and l.olagent=".$request->agent ));
                    $total_rec = count($count_rawQry);
                }
            } else {
                if(isset($request->search) && !empty($request->search)){
                    $search = $request->search;
                    $rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id  join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " and l.bname like '%$search%'  LIMIT ".$per_page." OFFSET ".$page));
                    
                    $count_rawQry =  DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " and l.bname like '%$search%'  "));
                    $total_rec = count($count_rawQry);
                } else {
                    $rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where. " LIMIT ".$per_page." OFFSET ".$page));
                    
                    $count_rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.bstatuslist,l.filtertype,l.olagent,lb.batFranchise,a.id as agent,a.firstname,a.lastname from listing l join listing_bat as lb on l.id=lb.listing_id  join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))" .$where ));
                    $total_rec = count($count_rawQry);
                }
            }
            
            $count = count($rawQry);
            $i = 0;
            $c = $count-1;
            if($count > 0){
                for($i=0; $i<=$c; $i++){
                    $btype = explode(",", $rawQry[$i]->btype);
                    $filtertype = explode(",", $rawQry[$i]->filtertype);
                    $batFranchise = explode(',',$rawQry[$i]->batFranchise);
                    $bat = $filter = $category ="No Match";
                    if(in_array(87,$btype)){
                        $category ="Franchise";
                    }
                    if(in_array(1,$filtertype)){
                        $filter ="Franchise";
                    }
                    if($batFranchise === "Yes"){
                        $bat ='Franchise';
                    } 
                    if($category==="Franchise" AND $filter==="Franchise" AND $bat==="Franchise"){
                    }else{
                        $html = array(
                            'listing_id' => $rawQry[$i]->id,
                            'bname' => $rawQry[$i]->bname,
                            'category' => $category,
                            'filter' => $filter,
                            'bat' => $bat,
                            'agentname' => $rawQry[$i]->firstname . ' ' . $rawQry[$i]->lastname,
                            'status' => $rawQry[$i]->bstatuslist,
                            'agent' => $rawQry[$i]->agent
                        );
                        array_push($dataArr, $html);
                    }
                }
            }
            return response()->json(['message'=>'success','code'=>'200','data'=>$dataArr,'total'=>$total_rec]);
        } catch(\Exception $e){
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function download(Request $request){
        try {
            $status = "Available,Coming Soon,Listing Signed,Sold,Expired,Cancelled,LOI,In Contract,Available not Advertised";
            $where= " AND FIND_IN_SET(bstatuslist,'".$status."')";
            $dataArr = array();
            if(isset($request->listing_id) || $request->listing_id != ''){
                foreach($request->listing_id as $key=>$val){
                    $rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.filtertype,l.olagent,lb.batFranchise,u.username,a.firstname,a.lastname from listing l left join listing_bat as lb on l.id=lb.listing_id left join users as u on u.id=l.olagent left join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1)) and l.id=".$val." "));
                    $count = count($rawQry);
                    $i = 0;
                    $c = $count-1;
                    if($count > 0){
                        for($i=0; $i<=$c; $i++){
                            $btype = explode(",", $rawQry[$i]->btype);
                            $filtertype = explode(",", $rawQry[$i]->filtertype);
                            $batFranchise = explode(',',$rawQry[$i]->batFranchise);
                            $bat = $filter = $category ="No Match";
                            if(in_array(87,$btype)){
                                $category ="Franchise";
                            }
                            if(in_array(1,$filtertype)){
                                $filter ="Franchise";
                            }
                            if($batFranchise === "Yes"){
                                $bat ='Franchise';
                            } 
                            if($category==="Franchise" AND $filter==="Franchise" AND $bat==="Franchise"){
                            }else{
                                $html = array(
                                    'listing_id' => $rawQry[$i]->id,
                                    'agentname' => $rawQry[$i]->firstname . ' ' . $rawQry[$i]->lastname,
                                    'bname' => $rawQry[$i]->bname,
                                    'category' => $category,
                                    'filter' => $filter,
                                    'bat' => $bat
                                );
                                array_push($dataArr, $html);
                            }
                        }
                    }
                }
            }
            else {
                $rawQry = DB::select(DB::raw("Select l.id,l.bname,l.btype,l.filtertype,l.olagent,lb.batFranchise,u.username,a.firstname,a.lastname from listing l left join listing_bat as lb on l.id=lb.listing_id left join users as u on u.id=l.olagent left join agents as a on a.id=l.olagent where (FIND_IN_SET(btype,87) || FIND_IN_SET(filtertype,1))"));
                $count = count($rawQry);
                $i = 0;
                $c = $count-1;
                if($count > 0){
                    for($i=0; $i<=$c; $i++){
                        $btype = explode(",", $rawQry[$i]->btype);
                        $filtertype = explode(",", $rawQry[$i]->filtertype);
                        $batFranchise = explode(',',$rawQry[$i]->batFranchise);
                        $bat = $filter = $category ="No Match";
                        if(in_array(87,$btype)){
                            $category ="Franchise";
                        }
                        if(in_array(1,$filtertype)){
                            $filter ="Franchise";
                        }
                        if($batFranchise === "Yes"){
                            $bat ='Franchise';
                        } 
                        if($category==="Franchise" AND $filter==="Franchise" AND $bat==="Franchise"){
                        }else{
                            $html = array(
                                'listing_id' => $rawQry[$i]->id,
                                'agentname' => $rawQry[$i]->firstname . ' ' . $rawQry[$i]->lastname,
                                'bname' => $rawQry[$i]->bname,
                                'category' => $category,
                                'filter' => $filter,
                                'bat' => $bat
                            );
                            array_push($dataArr, $html);
                        }
                    }
                }
            }
            
            $now = date('m-d-Y');
            $name = 'Franchise_Comparison_Report_Download.xls';
            $folder = "public/storage/bbs/export_files/";
            $path = url($folder.$name);
            Excel::store( new FranchiseExport($dataArr), $name, 'export_path' );
            return response()->json([ 'message'=>'success', 'code'=>'200', 'data'=>$path]);
        } catch(\Exception $e){
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
}
