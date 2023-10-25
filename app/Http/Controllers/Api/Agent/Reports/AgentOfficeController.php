<?php

namespace App\Http\Controllers\Api\Agent\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AgentDetails;
use App\Models\BuyerLeads;
use App\Models\User;

class AgentOfficeController extends Controller
{
    public function index(Request $request){
        try{
            $user = Auth::user();
            $agentId=$user->id;
            $date_filter = $request->date;
            $current = date('Y-m-d');
            $current_year = date('Y');
            $sum_sale = 0;
            $total_price_sold_list = 0;
            $sum_sale_listid_arr = array();
            $sum_price_sold_list_arr = array();
            $sum_price_exp_list_arr = array();
            $sum_price_cancel_list_arr = array();
            $total_price_exp_list = 0;
            $total_price_cancel_list = 0;
            $total_price_in_con_list = 0;
            $sum_incont_listid_arr = array();
            $total_price_in_comm_list = 0;
            $sum_incont_comm_listid_arr = array();
            $lead_per = 0;
            $sum_notadv_list_arr = array(); 
            $total_price_v_notadv_list = 0;
            $sum_com_list_arr = array(); 
            $total_price_v_com_list = 0;
            $total_price_in_loi_list = 0;
            $sum_loi_listid_arr = array();
            $total_listing_sold = 0;
            $total_listing_expired = 0;
            $total_listing_cancelled = 0;
            $total_available_notadv_listing = 0;
            
            if($user->hasRole('Agent')) {
                $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchiseofficeid','agent_details.franchisename')
                ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
                ->where('agents.id','=',$agentId)
                ->first();
    
                if($franchise->franchiseofficeid != ''){
                    $franchiseId = $franchise->franchiseofficeid;
                    $available_listing = Listing::select('id','bsaleprice')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available')->get();
                    $total_listings_available = count($available_listing);
                    if($total_listings_available > 0){
                        foreach($available_listing as $k_sale=>$v_sale){
                            if($v_sale->bsaleprice != ''){
                                $sum_sale += $v_sale->bsaleprice;
                            }
                            $sum_sale_listid = $v_sale->id;
                            array_push($sum_sale_listid_arr, $sum_sale_listid);
                        }
                    }
                    
                    if($date_filter != ''){
                        $resDate= explode('/', $date_filter);   
                        $agent_from = $resDate[0];
                        $agent_to = $resDate[1];
                        
                        $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                        $total_listing_sold = count($listing_sold);
                                                
                        $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                        $total_listing_expired = count($listing_expired);
    
                        $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                        $total_listing_cancelled = count($listing_cancelled);
    
                        $buyer_leads = BuyerLeads::where('agent_id',$agentId)->where('franchiseofficeid',$franchiseId)->where('status','Converted')->get();
    
                        $buyer_leads_per = BuyerLeads::where('agent_id',$agentId)->where('franchiseofficeid',$franchiseId)->whereYear('createddate',$current_year)->get();
    
                        $count_buyer_leads = count($buyer_leads);
                        $count_buyer_leads_per = count($buyer_leads_per);
                        
                        if($count_buyer_leads_per != '0'){
                            $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                        }
                            
                    } else {
                        $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                        $total_listing_sold = count($listing_sold);
        
                        $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                        $total_listing_expired = count($listing_expired);
            
                        $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                        $total_listing_cancelled = count($listing_cancelled);
    
                        $buyer_leads = BuyerLeads::where('agent_id',$agentId)->where('status','Converted')->get();
    
                        $buyer_leads_per = BuyerLeads::where('agent_id',$agentId)->whereYear('createddate',$current_year)->get();
    
                        $count_buyer_leads = count($buyer_leads);
                        $count_buyer_leads_per = count($buyer_leads_per);
                        
                        if($count_buyer_leads_per != '0'){
                            $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                        }
                    }
    
                    
                    
                    $available_notadv_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available not Advertised')->get();
                    $total_available_notadv_listing = count($available_notadv_listing);
        
                    $coming_soon_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Coming Soon')->get();
                    
        
                    $listing_in_contract = Listing::select('id','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                    $total_listing_in_contract = count($listing_in_contract);
                    if($total_listing_in_contract > 0){
                        foreach($listing_in_contract as $k_con=>$v_con){
                            if($v_con->selling_price != null){
                                $total_price_in_con_list += $v_con->selling_price;
                            }
                            
                            $con_list_id = $v_con->id;
                            array_push($sum_incont_listid_arr, $con_list_id);
                        }
                    }
        
                    $listing_in_contract_comm = Listing::select('id','bcommissionamount')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                    $total_listing_in_contract_comm = count($listing_in_contract_comm);
                    if($total_listing_in_contract_comm > 0){
                        foreach($listing_in_contract_comm as $k_comm=>$v_comm){
                            if($v_comm->bcommissionamount != null){
                                $total_price_in_comm_list += $v_comm->bcommissionamount;
                            }
                            
                            $comm_list_id = $v_comm->id;
                            array_push($sum_incont_comm_listid_arr, $comm_list_id);
                        }
                    }
        
                    $listing_in_LOI = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','LOI')->get();
                    $total_listing_in_LOI = count($listing_in_LOI);
                    if($total_listing_in_LOI > 0){
                        foreach($listing_in_LOI as $k_loi=>$v_loi){
                            if($v_loi->bcommissionamount != null){
                                $total_price_in_loi_list += $v_loi->bcommissionamount;
                            }
                            
                            $loi_list_id = $v_loi->id;
                            array_push($sum_loi_listid_arr, $loi_list_id);
                        }
                    }
                    if($total_listing_sold > 0){
                        foreach($listing_sold as $k_sold1=>$v_sold1){
                            if($v_sold1->selling_price != null){
                                $total_price_sold_list += $v_sold1->selling_price;
                            }
                            
                            $sold_list_id = $v_sold1->id;
                            array_push($sum_price_sold_list_arr, $sold_list_id);
                        }
                    }
        
                    
                    if($total_listing_expired > 0){
                        foreach($listing_expired as $k_exp1=>$v_exp1){
                            if($v_exp1->selling_price != null){
                                $total_price_exp_list += $v_exp1->selling_price;
                            }
                            
                            $exp_list_id = $v_exp1->id;
                            array_push($sum_price_exp_list_arr, $exp_list_id);
                        }
                    }
        
                    
                    if($total_listing_cancelled > 0){
                        foreach($listing_cancelled as $k_can1=>$v_can1){
                            if($v_can1->selling_price != null){
                                $total_price_cancel_list += $v_can1->selling_price;
                            }
                            
                            $can_list_id = $v_can1->id;
                            array_push($sum_price_cancel_list_arr, $can_list_id);
                        }
                    }
        
                    
                    if($total_available_notadv_listing > 0){
                        foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                            if($v_notadv->selling_price != null){
                                $total_price_v_notadv_list += $v_notadv->selling_price;
                            }
                            
                            $notadv_list_id = $v_notadv->id;
                            array_push($sum_notadv_list_arr, $notadv_list_id);
                        }
                    } 
        
                    $total_coming_soon_listing = count($coming_soon_listing);
                    if($total_coming_soon_listing > 0){
                        foreach($coming_soon_listing as $k_com=>$v_com){
                            if($v_com->selling_price != null){
                                $total_price_v_com_list += $v_com->selling_price;
                            }
                            
                            $nv_com_list_id = $v_com->id;
                            array_push($sum_com_list_arr, $nv_com_list_id);
                        }
                    } 
    
                    return response()->json([
                        'message' => 'success',
                        'code'=>'200',
                        'data'=>[
                            ['status'=>'Total Listings Available' , 'count'=>$total_listings_available, 'operations'=> $sum_sale_listid_arr ],
        
                            ['status'=>'Total Listing Available-Not Advertised' , 'count'=>$total_available_notadv_listing, 'operations'=> $sum_notadv_list_arr],
        
                            ['status'=>'Total Listing Coming Soon', 'count'=>$total_coming_soon_listing, 'operations'=> $sum_com_list_arr],
        
                            ['status'=>'Total Listing In Contract', 'count'=>$total_listing_in_contract, 'operations'=> $sum_incont_comm_listid_arr],
        
                            ['status'=>'Total Listing in LOI', 'count'=>$total_listing_in_LOI, 'operations'=> $sum_loi_listid_arr],
        
                            ['status'=>'Total Sales Price of Listings', 'count'=>$sum_sale, 'operations'=> $sum_sale_listid_arr ],
        
                            ['status'=>'Total Listings Sold This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
        
                            ['status'=>'Total Sold Prices This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
        
                            ['status'=>'Total Expired Listings This Year', 'count'=>$total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
        
                            ['status'=>'Total Cancelled Listings This Year', 'count'=>$total_listing_cancelled, 'operations'=> $sum_price_cancel_list_arr],
        
                            ['status'=>'Lead Conversion Count', 'count'=>$count_buyer_leads, 'operations'=> ''],
        
                            ['status'=>'Lead Conversion Percentage', 'count'=>$lead_per, 'operations'=> ''],
        
                            ['status'=>'Total Leads', 'count'=>$count_buyer_leads_per, 'operations'=> ''],
                        ]
                    ]);
                }
                else {
                    return response()->json(['message'=>'success','code'=>'200','data'=>'Data not found']); 
                }
            }
    
            if($user->hasRole('Agent Manager')) { 
                $total_listings_available = 0;
                $total_coming_soon_listing = 0;
                $total_listing_in_contract = 0;
                $total_listing_in_LOI = 0;
                $count_buyer_leads = 0;
                $count_buyer_leads_per = 0;
                $total_listing_in_contract_comm = 0;
                if((isset($request->id)) && ($request->id != '')){
                    $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchiseofficeid','agent_details.franchisename')
                    ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
                    ->where('agents.id','=',$request->id )
                    ->get();
                } else {
                    $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchiseofficeid','agent_details.franchisename')
                    ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
                    ->get();
                }     
                
                foreach($franchise as $key=>$val){
                    if($val->franchiseofficeid != ''){
                        $franchiseId = $val->franchiseofficeid;
                        
                        $available_listing = Listing::select('id','bsaleprice')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available')->get();
                        $total_listings_available += count($available_listing);
                        // return $total_listings_available;
                        if($date_filter != ''){
                            $resDate= explode('/', $date_filter);   
                            $agent_from = $resDate[0];
                            $agent_to = $resDate[1];
                            
                            $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                            $total_listing_sold += count($listing_sold);
                            
                            $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                            $total_listing_expired += count($listing_expired);
    
                            $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                            $total_listing_cancelled += count($listing_cancelled);
    
                            $buyer_leads = BuyerLeads::where('agent_id',$agentId)->where('franchiseofficeid',$franchiseId)->where('status','Converted')->get();
    
                            $buyer_leads_per = BuyerLeads::where('agent_id',$agentId)->where('franchiseofficeid',$franchiseId)->whereYear('createddate',$current_year)->get();
    
                            $count_buyer_leads += count($buyer_leads);
                            $count_buyer_leads_per += count($buyer_leads_per);
                            
                            // if($count_buyer_leads_per != '0'){
                            //     $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                            // }
                                
                        } else {
                            $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                            $total_listing_sold += count($listing_sold);
            
                            $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                            $total_listing_expired += count($listing_expired);
                
                            $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                            $total_listing_cancelled += count($listing_cancelled);
    
                            $buyer_leads = BuyerLeads::where('agent_id',$agentId)->where('status','Converted')->get();
    
                            $buyer_leads_per = BuyerLeads::where('agent_id',$agentId)->whereYear('createddate',$current_year)->get();
    
                            $count_buyer_leads += count($buyer_leads);
                            $count_buyer_leads_per += count($buyer_leads_per);
                            
                            
                        }
    
                        if($count_buyer_leads_per != '0'){
                            $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                        }
                        if($total_listings_available > 0){
                            foreach($available_listing as $k_sale=>$v_sale){
                                if($v_sale->bsaleprice != ''){
                                    $sum_sale += $v_sale->bsaleprice;
                                }
                                $sum_sale_listid = $v_sale->id;
                                array_push($sum_sale_listid_arr, $sum_sale_listid);
                            }
                        }
                        
                        $available_notadv_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available not Advertised')->get();
                        $total_available_notadv_listing += count($available_notadv_listing);
            
                        $coming_soon_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Coming Soon')->get();
                        $total_coming_soon_listing += count($coming_soon_listing);
            
                        $listing_in_contract = Listing::select('id','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                        $total_listing_in_contract += count($listing_in_contract);
                        if($total_listing_in_contract > 0){
                            foreach($listing_in_contract as $k_con=>$v_con){
                                if($v_con->selling_price != null){
                                    $total_price_in_con_list += $v_con->selling_price;
                                }
                                
                                $con_list_id = $v_con->id;
                                array_push($sum_incont_listid_arr, $con_list_id);
                            }
                        }
            
                        $listing_in_contract_comm = Listing::select('id','bcommissionamount')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                        $total_listing_in_contract_comm += count($listing_in_contract_comm);
                        if($total_listing_in_contract_comm > 0){
                            foreach($listing_in_contract_comm as $k_comm=>$v_comm){
                                if($v_comm->bcommissionamount != null){
                                    $total_price_in_comm_list += $v_comm->bcommissionamount;
                                }
                                
                                $comm_list_id = $v_comm->id;
                                array_push($sum_incont_comm_listid_arr, $comm_list_id);
                            }
                        }
            
                        $listing_in_LOI = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','LOI')->get();
                        $total_listing_in_LOI += count($listing_in_LOI);
                        if($total_listing_in_LOI > 0){
                            foreach($listing_in_LOI as $k_loi=>$v_loi){
                                if($v_loi->bcommissionamount != null){
                                    $total_price_in_loi_list += $v_loi->bcommissionamount;
                                }
                                
                                $loi_list_id = $v_loi->id;
                                array_push($sum_loi_listid_arr, $loi_list_id);
                            }
                        }
                        if($total_listing_sold > 0){
                            foreach($listing_sold as $k_sold1=>$v_sold1){
                                if($v_sold1->selling_price != null){
                                    $total_price_sold_list += $v_sold1->selling_price;
                                }
                                
                                $sold_list_id = $v_sold1->id;
                                array_push($sum_price_sold_list_arr, $sold_list_id);
                            }
                        }
            
                        
                        if($total_listing_expired > 0){
                            foreach($listing_expired as $k_exp1=>$v_exp1){
                                if($v_exp1->selling_price != null){
                                    $total_price_exp_list += $v_exp1->selling_price;
                                }
                                
                                $exp_list_id = $v_exp1->id;
                                array_push($sum_price_exp_list_arr, $exp_list_id);
                            }
                        }
            
                        
                        if($total_listing_cancelled > 0){
                            foreach($listing_cancelled as $k_can1=>$v_can1){
                                if($v_can1->selling_price != null){
                                    $total_price_cancel_list += $v_can1->selling_price;
                                }
                                
                                $can_list_id = $v_can1->id;
                                array_push($sum_price_cancel_list_arr, $can_list_id);
                            }
                        }
            
                        
                        if($total_available_notadv_listing > 0){
                            foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                                if($v_notadv->selling_price != null){
                                    $total_price_v_notadv_list += $v_notadv->selling_price;
                                }
                                
                                $notadv_list_id = $v_notadv->id;
                                array_push($sum_notadv_list_arr, $notadv_list_id);
                            }
                        } 
            
                        
                        if($total_coming_soon_listing > 0){
                            foreach($coming_soon_listing as $k_com=>$v_com){
                                if($v_com->selling_price != null){
                                    $total_price_v_com_list += $v_com->selling_price;
                                }
                                
                                $nv_com_list_id = $v_com->id;
                                array_push($sum_com_list_arr, $nv_com_list_id);
                            }
                        } 
    
                        
                    }
                } 
                return response()->json([
                    'message' => 'success',
                    'code'=>'200',
                    'data'=>[
                        ['status'=>'Total Listings Available' , 'count'=>$total_listings_available, 'operations'=> $sum_sale_listid_arr ],
    
                        ['status'=>'Total Listing Available-Not Advertised' , 'count'=>$total_available_notadv_listing, 'operations'=> $sum_notadv_list_arr],
    
                        ['status'=>'Total Listing Coming Soon', 'count'=>$total_coming_soon_listing, 'operations'=> $sum_com_list_arr],
    
                        ['status'=>'Total Listing In Contract', 'count'=>$total_listing_in_contract, 'operations'=> $sum_incont_comm_listid_arr],
    
                        ['status'=>'Total Listing in LOI', 'count'=>$total_listing_in_LOI, 'operations'=> $sum_loi_listid_arr],
    
                        ['status'=>'Total Sales Price of Listings', 'count'=>$sum_sale, 'operations'=> $sum_sale_listid_arr ],
    
                        ['status'=>'Total Listings Sold This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
    
                        ['status'=>'Total Sold Prices This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
    
                        ['status'=>'Total Expired Listings This Year', 'count'=>$total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
    
                        ['status'=>'Total Cancelled Listings This Year', 'count'=>$total_listing_cancelled, 'operations'=> $sum_price_cancel_list_arr],
    
                        ['status'=>'Lead Conversion Count', 'count'=>$count_buyer_leads, 'operations'=> ''],
    
                        ['status'=>'Lead Conversion Percentage', 'count'=>$lead_per, 'operations'=> ''],
    
                        ['status'=>'Total Leads', 'count'=>$count_buyer_leads_per, 'operations'=> ''],
                    ]
                ]);
            }
    
            if($user->hasRole('Super User')) {
                $user_type = 0;
                if((isset($request->id)) && ($request->id != '')){
                    $user_id = $request->id;
                    $agent = Agents::where('id',$user_id)->where('status','1')->where('isTypeAO','A')->first();
                    if(isset($agent->user_id)){
                        $user = User::where('id',$agent->user_id)->first();
                        if(isset($user->type)){
                            $user_type = $user->type;
                        }
                    }
    
                    if($user_type == '6'){ 
                        $total_listings_available = 0;
                        $total_coming_soon_listing = 0;
                        $total_listing_in_contract = 0;
                        $total_listing_in_LOI = 0;
                        $count_buyer_leads = 0;
                        $count_buyer_leads_per = 0;
                        $total_listing_in_contract_comm = 0;
                        if((isset($request->agent_id)) && ($request->agent_id != '')){
                            $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchiseofficeid','agent_details.franchisename')
                            ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
                            ->where('agents.id','=',$request->agent_id)
                            ->get();
                        } else {
                            $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchiseofficeid','agent_details.franchisename')
                            ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
                            ->get();
                        }
                        foreach($franchise as $key=>$val){
                            if($val->franchiseofficeid != ''){
                                $franchiseId = $val->franchiseofficeid;
                                
                                $available_listing = Listing::select('id','bsaleprice')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available')->get();
                                $total_listings_available += count($available_listing);
                                
                                if($date_filter != ''){
                                    $resDate= explode('/', $date_filter);   
                                    $agent_from = $resDate[0];
                                    $agent_to = $resDate[1];
                                    
                                    $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                                    $total_listing_sold += count($listing_sold);
                                    
                                    $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                                    $total_listing_expired += count($listing_expired);
            
                                    $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                                    $total_listing_cancelled += count($listing_cancelled);
            
                                    $buyer_leads = BuyerLeads::where('agent_id',$agentId)->where('franchiseofficeid',$franchiseId)->where('status','Converted')->get();
            
                                    $buyer_leads_per = BuyerLeads::where('agent_id',$agentId)->where('franchiseofficeid',$franchiseId)->whereYear('createddate',$current_year)->get();
            
                                    $count_buyer_leads += count($buyer_leads);
                                    $count_buyer_leads_per += count($buyer_leads_per);
                                    
                                    // if($count_buyer_leads_per != '0'){
                                    //     $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                                    // }
                                        
                                } else {
                                    $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                                    $total_listing_sold += count($listing_sold);
                    
                                    $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                                    $total_listing_expired += count($listing_expired);
                        
                                    $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                                    $total_listing_cancelled += count($listing_cancelled);
            
                                    $buyer_leads = BuyerLeads::where('agent_id',$agentId)->where('status','Converted')->get();
            
                                    $buyer_leads_per = BuyerLeads::where('agent_id',$agentId)->whereYear('createddate',$current_year)->get();
            
                                    $count_buyer_leads += count($buyer_leads);
                                    $count_buyer_leads_per += count($buyer_leads_per);
                                    
                                    
                                }
            
                                if($count_buyer_leads_per != '0'){
                                    $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                                }
                                if($total_listings_available > 0){
                                    foreach($available_listing as $k_sale=>$v_sale){
                                        if($v_sale->bsaleprice != ''){
                                            $sum_sale += $v_sale->bsaleprice;
                                        }
                                        $sum_sale_listid = $v_sale->id;
                                        array_push($sum_sale_listid_arr, $sum_sale_listid);
                                    }
                                }
                                
                                $available_notadv_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available not Advertised')->get();
                                $total_available_notadv_listing += count($available_notadv_listing);
                    
                                $coming_soon_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Coming Soon')->get();
                                $total_coming_soon_listing += count($coming_soon_listing);
                    
                                $listing_in_contract = Listing::select('id','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                                $total_listing_in_contract += count($listing_in_contract);
                                if($total_listing_in_contract > 0){
                                    foreach($listing_in_contract as $k_con=>$v_con){
                                        if($v_con->selling_price != null){
                                            $total_price_in_con_list += $v_con->selling_price;
                                        }
                                        
                                        $con_list_id = $v_con->id;
                                        array_push($sum_incont_listid_arr, $con_list_id);
                                    }
                                }
                    
                                $listing_in_contract_comm = Listing::select('id','bcommissionamount')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                                $total_listing_in_contract_comm += count($listing_in_contract_comm);
                                if($total_listing_in_contract_comm > 0){
                                    foreach($listing_in_contract_comm as $k_comm=>$v_comm){
                                        if($v_comm->bcommissionamount != null){
                                            $total_price_in_comm_list += $v_comm->bcommissionamount;
                                        }
                                        
                                        $comm_list_id = $v_comm->id;
                                        array_push($sum_incont_comm_listid_arr, $comm_list_id);
                                    }
                                }
                    
                                $listing_in_LOI = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','LOI')->get();
                                $total_listing_in_LOI += count($listing_in_LOI);
                                if($total_listing_in_LOI > 0){
                                    foreach($listing_in_LOI as $k_loi=>$v_loi){
                                        if($v_loi->bcommissionamount != null){
                                            $total_price_in_loi_list += $v_loi->bcommissionamount;
                                        }
                                        
                                        $loi_list_id = $v_loi->id;
                                        array_push($sum_loi_listid_arr, $loi_list_id);
                                    }
                                }
                                if($total_listing_sold > 0){
                                    foreach($listing_sold as $k_sold1=>$v_sold1){
                                        if($v_sold1->selling_price != null){
                                            $total_price_sold_list += $v_sold1->selling_price;
                                        }
                                        
                                        $sold_list_id = $v_sold1->id;
                                        array_push($sum_price_sold_list_arr, $sold_list_id);
                                    }
                                }
                    
                                
                                if($total_listing_expired > 0){
                                    foreach($listing_expired as $k_exp1=>$v_exp1){
                                        if($v_exp1->selling_price != null){
                                            $total_price_exp_list += $v_exp1->selling_price;
                                        }
                                        
                                        $exp_list_id = $v_exp1->id;
                                        array_push($sum_price_exp_list_arr, $exp_list_id);
                                    }
                                }
                    
                                
                                if($total_listing_cancelled > 0){
                                    foreach($listing_cancelled as $k_can1=>$v_can1){
                                        if($v_can1->selling_price != null){
                                            $total_price_cancel_list += $v_can1->selling_price;
                                        }
                                        
                                        $can_list_id = $v_can1->id;
                                        array_push($sum_price_cancel_list_arr, $can_list_id);
                                    }
                                }
                    
                                
                                if($total_available_notadv_listing > 0){
                                    foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                                        if($v_notadv->selling_price != null){
                                            $total_price_v_notadv_list += $v_notadv->selling_price;
                                        }
                                        
                                        $notadv_list_id = $v_notadv->id;
                                        array_push($sum_notadv_list_arr, $notadv_list_id);
                                    }
                                } 
                    
                                
                                if($total_coming_soon_listing > 0){
                                    foreach($coming_soon_listing as $k_com=>$v_com){
                                        if($v_com->selling_price != null){
                                            $total_price_v_com_list += $v_com->selling_price;
                                        }
                                        
                                        $nv_com_list_id = $v_com->id;
                                        array_push($sum_com_list_arr, $nv_com_list_id);
                                    }
                                } 
            
                                
                            }
                        } 
                        return response()->json([
                            'message' => 'success',
                            'code'=>'200',
                            'data'=>[
                                ['status'=>'Total Listings Available' , 'count'=>$total_listings_available, 'operations'=> $sum_sale_listid_arr ],
            
                                ['status'=>'Total Listing Available-Not Advertised' , 'count'=>$total_available_notadv_listing, 'operations'=> $sum_notadv_list_arr],
            
                                ['status'=>'Total Listing Coming Soon', 'count'=>$total_coming_soon_listing, 'operations'=> $sum_com_list_arr],
            
                                ['status'=>'Total Listing In Contract', 'count'=>$total_listing_in_contract, 'operations'=> $sum_incont_comm_listid_arr],
            
                                ['status'=>'Total Listing in LOI', 'count'=>$total_listing_in_LOI, 'operations'=> $sum_loi_listid_arr],
            
                                ['status'=>'Total Sales Price of Listings', 'count'=>$sum_sale, 'operations'=> $sum_sale_listid_arr ],
            
                                ['status'=>'Total Listings Sold This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
            
                                ['status'=>'Total Sold Prices This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
            
                                ['status'=>'Total Expired Listings This Year', 'count'=>$total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
            
                                ['status'=>'Total Cancelled Listings This Year', 'count'=>$total_listing_cancelled, 'operations'=> $sum_price_cancel_list_arr],
            
                                ['status'=>'Lead Conversion Count', 'count'=>$count_buyer_leads, 'operations'=> ''],
            
                                ['status'=>'Lead Conversion Percentage', 'count'=>$lead_per, 'operations'=> ''],
            
                                ['status'=>'Total Leads', 'count'=>$count_buyer_leads_per, 'operations'=> ''],
                            ]
                        ]);
                    }
               
                    if($user_type == '5'){ 
                        $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchiseofficeid','agent_details.franchisename')
                        ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
                        ->where('agents.id','=',$user_id)
                        ->get();
                    
                        foreach($franchise as $key=>$val){
                            if($val->franchiseofficeid != ''){
                                $franchiseId = $val->franchiseofficeid;
                                $available_listing = Listing::select('id','bsaleprice')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available')->get();
                                
                                if($date_filter != ''){
                                    $resDate= explode('/', $date_filter);   
                                    $agent_from = $resDate[0];
                                    $agent_to = $resDate[1];
                                    
                                    $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                                    $total_listing_sold = count($listing_sold);
                                    
                                    $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                                    $total_listing_expired = count($listing_expired);
            
                                    $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                                    $total_listing_cancelled = count($listing_cancelled);
            
                                    $buyer_leads = BuyerLeads::where('agent_id',$user_id)->where('franchiseofficeid',$franchiseId)->where('status','Converted')->get();
            
                                    $buyer_leads_per = BuyerLeads::where('agent_id',$user_id)->where('franchiseofficeid',$franchiseId)->whereYear('createddate',$current_year)->get();
            
                                    $count_buyer_leads = count($buyer_leads);
                                    $count_buyer_leads_per = count($buyer_leads_per);
                                    
                                    if($count_buyer_leads_per != '0'){
                                        $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                                    }
                                        
                                } else {
                                    $listing_sold = Listing::select('id','bsolddate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                                    $total_listing_sold = count($listing_sold);
                    
                                    $listing_expired = Listing::select('id','bexpiredate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                                    $total_listing_expired = count($listing_expired);
                        
                                    $listing_cancelled = Listing::select('id','bcanceldate','franchiseofficeid','bstatuslist','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                                    $total_listing_cancelled = count($listing_cancelled);
            
                                    $buyer_leads = BuyerLeads::where('agent_id',$user_id)->where('status','Converted')->get();
            
                                    $buyer_leads_per = BuyerLeads::where('agent_id',$user_id)->whereYear('createddate',$current_year)->get();
            
                                    $count_buyer_leads = count($buyer_leads);
                                    $count_buyer_leads_per = count($buyer_leads_per);
                                    
                                    if($count_buyer_leads_per != '0'){
                                        $lead_per = ($count_buyer_leads*100)/$count_buyer_leads_per;
                                    }
                                }
            
                                $total_listings_available = count($available_listing);
                                if($total_listings_available > 0){
                                    foreach($available_listing as $k_sale=>$v_sale){
                                        if($v_sale->bsaleprice != ''){
                                            $sum_sale += $v_sale->bsaleprice;
                                        }
                                        $sum_sale_listid = $v_sale->id;
                                        array_push($sum_sale_listid_arr, $sum_sale_listid);
                                    }
                                }
                                
                                $available_notadv_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Available not Advertised')->get();
                                $total_available_notadv_listing = count($available_notadv_listing);
                    
                                $coming_soon_listing = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','Coming Soon')->get();
                                
                    
                                $listing_in_contract = Listing::select('id','selling_price')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                                $total_listing_in_contract = count($listing_in_contract);
                                if($total_listing_in_contract > 0){
                                    foreach($listing_in_contract as $k_con=>$v_con){
                                        if($v_con->selling_price != null){
                                            $total_price_in_con_list += $v_con->selling_price;
                                        }
                                        
                                        $con_list_id = $v_con->id;
                                        array_push($sum_incont_listid_arr, $con_list_id);
                                    }
                                }
                    
                                $listing_in_contract_comm = Listing::select('id','bcommissionamount')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','In Contract')->get();
                                $total_listing_in_contract_comm = count($listing_in_contract_comm);
                                if($total_listing_in_contract_comm > 0){
                                    foreach($listing_in_contract_comm as $k_comm=>$v_comm){
                                        if($v_comm->bcommissionamount != null){
                                            $total_price_in_comm_list += $v_comm->bcommissionamount;
                                        }
                                        
                                        $comm_list_id = $v_comm->id;
                                        array_push($sum_incont_comm_listid_arr, $comm_list_id);
                                    }
                                }
                    
                                $listing_in_LOI = Listing::select('id')->where('franchiseofficeid',$franchiseId)->where('bstatuslist','LOI')->get();
                                $total_listing_in_LOI = count($listing_in_LOI);
                                if($total_listing_in_LOI > 0){
                                    foreach($listing_in_LOI as $k_loi=>$v_loi){
                                        if($v_loi->bcommissionamount != null){
                                            $total_price_in_loi_list += $v_loi->bcommissionamount;
                                        }
                                        
                                        $loi_list_id = $v_loi->id;
                                        array_push($sum_loi_listid_arr, $loi_list_id);
                                    }
                                }
                                if($total_listing_sold > 0){
                                    foreach($listing_sold as $k_sold1=>$v_sold1){
                                        if($v_sold1->selling_price != null){
                                            $total_price_sold_list += $v_sold1->selling_price;
                                        }
                                        
                                        $sold_list_id = $v_sold1->id;
                                        array_push($sum_price_sold_list_arr, $sold_list_id);
                                    }
                                }
                    
                                
                                if($total_listing_expired > 0){
                                    foreach($listing_expired as $k_exp1=>$v_exp1){
                                        if($v_exp1->selling_price != null){
                                            $total_price_exp_list += $v_exp1->selling_price;
                                        }
                                        
                                        $exp_list_id = $v_exp1->id;
                                        array_push($sum_price_exp_list_arr, $exp_list_id);
                                    }
                                }
                    
                                
                                if($total_listing_cancelled > 0){
                                    foreach($listing_cancelled as $k_can1=>$v_can1){
                                        if($v_can1->selling_price != null){
                                            $total_price_cancel_list += $v_can1->selling_price;
                                        }
                                        
                                        $can_list_id = $v_can1->id;
                                        array_push($sum_price_cancel_list_arr, $can_list_id);
                                    }
                                }
                    
                                
                                if($total_available_notadv_listing > 0){
                                    foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                                        if($v_notadv->selling_price != null){
                                            $total_price_v_notadv_list += $v_notadv->selling_price;
                                        }
                                        
                                        $notadv_list_id = $v_notadv->id;
                                        array_push($sum_notadv_list_arr, $notadv_list_id);
                                    }
                                } 
                    
                                $total_coming_soon_listing = count($coming_soon_listing);
                                if($total_coming_soon_listing > 0){
                                    foreach($coming_soon_listing as $k_com=>$v_com){
                                        if($v_com->selling_price != null){
                                            $total_price_v_com_list += $v_com->selling_price;
                                        }
                                        
                                        $nv_com_list_id = $v_com->id;
                                        array_push($sum_com_list_arr, $nv_com_list_id);
                                    }
                                } 
            
                                return response()->json([
                                    'message' => 'success',
                                    'code'=>'200',
                                    'data'=>[
                                        ['status'=>'Total Listings Available' , 'count'=>$total_listings_available, 'operations'=> $sum_sale_listid_arr ],
                    
                                        ['status'=>'Total Listing Available-Not Advertised' , 'count'=>$total_available_notadv_listing, 'operations'=> $sum_notadv_list_arr],
                    
                                        ['status'=>'Total Listing Coming Soon', 'count'=>$total_coming_soon_listing, 'operations'=> $sum_com_list_arr],
                    
                                        ['status'=>'Total Listing In Contract', 'count'=>$total_listing_in_contract, 'operations'=> $sum_incont_comm_listid_arr],
                    
                                        ['status'=>'Total Listing in LOI', 'count'=>$total_listing_in_LOI, 'operations'=> $sum_loi_listid_arr],
                    
                                        ['status'=>'Total Sales Price of Listings', 'count'=>$sum_sale, 'operations'=> $sum_sale_listid_arr ],
                    
                                        ['status'=>'Total Listings Sold This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                    
                                        ['status'=>'Total Sold Prices This Year', 'count'=>$total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                    
                                        ['status'=>'Total Expired Listings This Year', 'count'=>$total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                    
                                        ['status'=>'Total Cancelled Listings This Year', 'count'=>$total_listing_cancelled, 'operations'=> $sum_price_cancel_list_arr],
                    
                                        ['status'=>'Lead Conversion Count', 'count'=>$count_buyer_leads, 'operations'=> ''],
                    
                                        ['status'=>'Lead Conversion Percentage', 'count'=>$lead_per, 'operations'=> ''],
                    
                                        ['status'=>'Total Leads', 'count'=>$count_buyer_leads_per, 'operations'=> ''],
                                    ]
                                ]);
                            }
                        } 
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function franchiselist(){
        try{
            $user = Auth::user();
            $userId= $user->id;
            $franchise = Agents::select('agents.id','agent_details.id','agent_details.franchisename')
            ->leftJoin('agent_details', 'agent_details.agent_id','=','agents.id')
            ->where('agents.id','=',$userId)
            ->get();
            return response()->json(['message'=>'success','code'=>'200','data'=>$franchise]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
}
