<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PhoneBurnerExport;
use App\Models\Buyers;
use App\Models\Listing;
use App\Http\Controllers\Api\Listing\ListingBatController as ListingBatController;
use Illuminate\Support\Carbon;
class PhoneBurnerReportController extends Controller
{
    public function index(Request $request){
        try { 
            if(isset($request->agent)){
                $rawQry = DB::select(DB::raw("Select bu.id as bu_id,bu.firstname,bu.lastname,bu.phoneno,bu.email,bu.agentid,bu.status,bun.buyer_id,bun.agent_id,bun.listing_id as bun_listing_id,bun.note_text,bun.created_at as note_created_date,a.id as agent,a.firstname as a_fname,a.lastname as a_lname,l.id as listing_id,l.bamount from buyer_users bu join buyer_user_notes as bun on bun.buyer_id=bu.id and bun.agent_id=bu.agentid join agents as a on a.id=bu.agentid join listing as l on l.id=bun.listing_id where bu.agentid=".$request->agent." "));
            } else {
                $rawQry = DB::select(DB::raw("Select bu.id as bu_id,bu.firstname,bu.lastname,bu.phoneno,bu.email,bu.agentid,bu.status,bun.buyer_id,bun.agent_id,bun.listing_id as bun_listing_id,bun.note_text,bun.created_at as note_created_date,a.id as agent,a.firstname as a_fname,a.lastname as a_lname,l.id as listing_id,l.bamount from buyer_users bu join buyer_user_notes as bun on bun.buyer_id=bu.id and bun.agent_id=bu.agentid join agents as a on a.id=bu.agentid join listing as l on l.id=bun.listing_id" ));
            }
            $column_array = array();
            $count = count($rawQry);
            if($count > 0){
                foreach($rawQry as $val){
                    $column_value = array(
                        'first_name' => $val->firstname,
                        'last_name' => $val->lastname,
                        'buyer_phone_no' => $val->phoneno,
                        'listing_no' => $val->listing_id,
                        'latest_note' => $val->note_text,
                        'date_of_note' => $val->note_created_date,
                        'pof' => $val->bamount,
                        'buyer_email' => $val->email,
                        'agent_name' => $val->a_fname . ' ' . $val->a_lname,
                        'hot_report_category' => $val->status
                    );
                    array_push($column_array,$column_value);
                }
            }
            $name = 'HotBuyers.xls';
            Excel::store( new PhoneBurnerExport($column_array), $name, 'export_path' );
            $folder = "public/storage/bbs/export_files/";
            $path = url($folder.$name);
            return response()->json(['message'=>'success','code'=>'200','data'=>$path,'agent'=>$rawQry,'total'=>$count]);
        } catch(\Exception $e){
            return response()->json([ 'message'=>'error','code'=>'302','data'=>$e->getMessage() ]);
        }
    }
}
  