<?php

namespace App\Http\Controllers\Api\Agent\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Listing;
use App\Models\User;


class AgentManagersController extends Controller
{
    public function index(Request $request){
        try{
            $user = Auth::user();
            $date_filter = $request->date;
            $sum_sale = 0;
            $total_price_sold_list = 0;
            $sum_sale_listid_arr = array();
            $sum_price_sold_list_arr = array();
            $sum_notadv = 0;
            $sum_notadv_listid_arr = array();
            $total_price_com_list = 0;
            $sum_price_com_list_arr = array();
            $total_price_cont_list = 0;
            $sum_price_cont_list_arr = array();
            $total_price_loi_list = 0;
            $sum_price_loi_list_arr = array();
            $total_price_exp_list = 0;
            $sum_price_exp_list_arr = array();

            if($user->hasRole('Agent')) {
                $available_listing = Listing::select('id','bsaleprice')->where('olagent',$user->id)->where('bstatuslist','Available')->get();
                $total_listings_available = count($available_listing);
                if($total_listings_available > 0){
                    foreach($available_listing as $k_sale=>$v_sale){
                        if($v_sale->bsaleprice != '' && $v_sale->bsaleprice != null){
                            $sum_sale += $v_sale->bsaleprice;
                        }
                        $sum_sale_listid = $v_sale->id;
                        array_push($sum_sale_listid_arr, $sum_sale_listid);
                    }
                }
                
                $available_notadv_listing = Listing::select('id')->where('olagent',$user->id)->where('bstatuslist','Available not Advertised')->get();
                $total_available_notadv_listing = count($available_notadv_listing);
                if($total_available_notadv_listing > 0){
                    foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                        if($v_notadv->bsaleprice != '' && $v_notadv->bsaleprice != null){
                            $sum_notadv += $v_notadv->bsaleprice;
                        }
                        $sum_notadv_listid = $v_notadv->id;
                        array_push($sum_notadv_listid_arr, $sum_notadv_listid);
                    }
                } 
                
                $coming_soon_listing = Listing::select('id')->where('olagent',$user->id)->where('bstatuslist','Coming Soon')->get();
                $total_coming_soon_listing = count($coming_soon_listing);
                if($total_coming_soon_listing > 0){
                    foreach($coming_soon_listing as $k_com=>$v_com){
                        if($v_com->selling_price != '' && $v_com->selling_price != null ){
                            $total_price_com_list += $v_com->selling_price;
                        }
                        $com_list_id = $v_com->id;
                        array_push($sum_price_com_list_arr, $com_list_id);
                    }
                }
                
                $listing_in_contract = Listing::select('id')->where('olagent',$user->id)->where('bstatuslist','In Contract')->get();
                $total_listing_in_contract = count($listing_in_contract);
                if($total_listing_in_contract > 0){
                    foreach($listing_in_contract as $k_cont=>$v_cont){
                        if($v_cont->selling_price != '' && $v_cont->selling_price != null ){
                            $total_price_cont_list += $v_cont->selling_price;
                        }
                        $cont_list_id = $v_cont->id;
                        array_push($sum_price_cont_list_arr, $cont_list_id);
                    }
                }
                
                $listing_in_LOI = Listing::select('id')->where('olagent',$user->id)->where('bstatuslist','LOI')->get();
                $total_listing_in_LOI = count($listing_in_LOI);
                if($total_listing_in_LOI > 0){
                    foreach($listing_in_LOI as $k_loi=>$v_loi){
                        if($v_loi->selling_price != '' && $v_loi->selling_price != null ){
                            $total_price_loi_list += $v_loi->selling_price;
                        }
                        $loi_list_id = $v_loi->id;
                        array_push($sum_price_loi_list_arr, $loi_list_id);
                    }
                }
            
                $current = date('Y-m-d');
                $current_year = date('Y');
                
                if($date_filter != ''){
                    $resDate= explode('/', $date_filter);   
                    $agent_from = $resDate[0];
                    $agent_to = $resDate[1];
                    
                    $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$user->id)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                    $total_listing_sold = count($listing_sold);
                    if($total_listing_sold > 0){
                        foreach($listing_sold as $k_sold=>$v_sold){
                            if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                $total_price_sold_list += $v_sold->selling_price;
                            }
                            $sold_list_id = $v_sold->id;
                            array_push($sum_price_sold_list_arr, $sold_list_id);
                        }
                    }
                    
                    $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$user->id)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                    $total_listing_expired = count($listing_expired);
                    if($total_listing_expired > 0){
                        foreach($listing_expired as $k_exp=>$v_exp){
                            if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                $total_price_exp_list += $v_exp->selling_price;
                            }
                            $exp_list_id = $v_exp->id;
                            array_push($sum_price_exp_list_arr, $exp_list_id);
                        }
                    }
                                       
                    $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$user->id)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                    $total_listing_cancelled = count($listing_cancelled);

                } else {
                    $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$user->id)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                    $total_listing_sold = count($listing_sold);
                    if($total_listing_sold > 0){
                        foreach($listing_sold as $k_sold=>$v_sold){
                            if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                $total_price_sold_list += $v_sold->selling_price;
                            }
                            $sold_list_id = $v_sold->id;
                            array_push($sum_price_sold_list_arr, $sold_list_id);
                        }
                    }

                    $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$user->id)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                    $total_listing_expired = count($listing_expired);
                    if($total_listing_expired > 0){
                        foreach($listing_expired as $k_exp=>$v_exp){
                            if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                $total_price_exp_list += $v_exp->selling_price;
                            }
                            $exp_list_id = $v_exp->id;
                            array_push($sum_price_exp_list_arr, $exp_list_id);
                        }
                    }
                                      
                    $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$user->id)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                    $total_listing_cancelled = count($listing_cancelled);
                }
                
                return response()->json([
                    'message' => 'success',
                    'code' => '200',
                    'data' => [
                        ['status' => 'Total Listings Available', 'count'=>$total_listings_available, 'operations'=>$sum_sale_listid_arr],
                        ['status' => 'Total Listing Available-Not Advertised', 'count'=>$total_available_notadv_listing, 'operations'=>$sum_notadv_listid_arr],
                        ['status' => 'Total Listing Coming Soon', 'count'=> $total_coming_soon_listing, 'operations'=> $sum_price_com_list_arr],
                        ['status' => 'Total Listing In Contract', 'count'=> $total_listing_in_contract, 'operations'=> $sum_price_cont_list_arr],
                        ['status' => 'Total Listing in LOI', 'count'=> $total_listing_in_LOI, 'operations'=> $sum_price_loi_list_arr],
                        ['status' => 'Total Sales Price of Listings', 'count'=> $sum_sale, 'operations'=> $sum_sale_listid_arr],
                        ['status' => 'Total Listings Sold This Year', 'count'=> $total_listing_sold, 'operations'=> $sum_price_sold_list_arr],
                        ['status' => 'Total Sold Prices This Year', 'count'=> $total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                        ['status' => 'Total Expired Listings This Year', 'count'=> $total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                        ['status' => 'Over 91 Days', 'count'=> 0, 'operations'=> ''],
                    ],
                ]);
            }

            if($user->hasRole('Agent Manager')) { 
                if((isset($request->id)) && ($request->id != '')){
                    $agentId = $request->id;
                    $available_listing = Listing::select('id','bsaleprice')->where('olagent',$agentId)->where('bstatuslist','Available')->get();
                    $total_listings_available = count($available_listing);
                    if($total_listings_available > 0){
                        foreach($available_listing as $k_sale=>$v_sale){
                            if($v_sale->bsaleprice != '' && $v_sale->bsaleprice != null){
                                $sum_sale += $v_sale->bsaleprice;
                            }
                            $sum_sale_listid = $v_sale->id;
                            array_push($sum_sale_listid_arr, $sum_sale_listid);
                        }
                    }
                
                    $available_notadv_listing = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','Available not Advertised')->get();
                    $total_available_notadv_listing = count($available_notadv_listing);
                    if($total_available_notadv_listing > 0){
                        foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                            if($v_notadv->bsaleprice != '' && $v_notadv->bsaleprice != null){
                                $sum_notadv += $v_notadv->bsaleprice;
                            }
                            $sum_notadv_listid = $v_notadv->id;
                            array_push($sum_notadv_listid_arr, $sum_notadv_listid);
                        }
                    }
                
                    $coming_soon_listing = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','Coming Soon')->get();
                    $total_coming_soon_listing = count($coming_soon_listing);
                    if($total_coming_soon_listing > 0){
                        foreach($coming_soon_listing as $k_com=>$v_com){
                            if($v_com->selling_price != '' && $v_com->selling_price != null ){
                                $total_price_com_list += $v_com->selling_price;
                            }
                            $com_list_id = $v_com->id;
                            array_push($sum_price_com_list_arr, $com_list_id);
                        }
                    }
                
                    $listing_in_contract = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','In Contract')->get();
                    $total_listing_in_contract = count($listing_in_contract);
                    if($total_listing_in_contract > 0){
                        foreach($listing_in_contract as $k_cont=>$v_cont){
                            if($v_cont->selling_price != '' && $v_cont->selling_price != null ){
                                $total_price_cont_list += $v_cont->selling_price;
                            }
                            $cont_list_id = $v_cont->id;
                            array_push($sum_price_cont_list_arr, $cont_list_id);
                        }
                    }
                
                    $listing_in_LOI = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','LOI')->get();
                    $total_listing_in_LOI = count($listing_in_LOI);
                    if($total_listing_in_LOI > 0){
                        foreach($listing_in_LOI as $k_loi=>$v_loi){
                            if($v_loi->selling_price != '' && $v_loi->selling_price != null ){
                                $total_price_loi_list += $v_loi->selling_price;
                            }
                            $loi_list_id = $v_loi->id;
                            array_push($sum_price_loi_list_arr, $loi_list_id);
                        }
                    }
            
                    $current = date('Y-m-d');
                    $current_year = date('Y');
                    
                    if($date_filter != ''){
                        $resDate= explode('/', $date_filter);   
                        $agent_from = $resDate[0];
                        $agent_to = $resDate[1];
                        
                        $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                        $total_listing_sold = count($listing_sold);
                        if($total_listing_sold > 0){
                            foreach($listing_sold as $k_sold=>$v_sold){
                                if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                    $total_price_sold_list += $v_sold->selling_price;
                                }
                                $sold_list_id = $v_sold->id;
                                array_push($sum_price_sold_list_arr, $sold_list_id);
                            }
                        }
                        
                        $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                        $total_listing_expired = count($listing_expired);
                        if($total_listing_expired > 0){
                            foreach($listing_expired as $k_exp=>$v_exp){
                                if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                    $total_price_exp_list += $v_exp->selling_price;
                                }
                                $exp_list_id = $v_exp->id;
                                array_push($sum_price_exp_list_arr, $exp_list_id);
                            }
                        }
                        
                        $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                        $total_listing_cancelled = count($listing_cancelled);
                        
                    } else {
                        $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                        $total_listing_sold = count($listing_sold);
                        if($total_listing_sold > 0){
                            foreach($listing_sold as $k_sold=>$v_sold){
                                if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                    $total_price_sold_list += $v_sold->selling_price;
                                }
                                $sold_list_id = $v_sold->id;
                                array_push($sum_price_sold_list_arr, $sold_list_id);
                            }
                        }
                        
                        $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                        $total_listing_expired = count($listing_expired);
                        if($total_listing_expired > 0){
                            foreach($listing_expired as $k_exp=>$v_exp){
                                if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                    $total_price_exp_list += $v_exp->selling_price;
                                }
                                $exp_list_id = $v_exp->id;
                                array_push($sum_price_exp_list_arr, $exp_list_id);
                            }
                        }
                                                
                        $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                        $total_listing_cancelled = count($listing_cancelled);
                    }
            
                    return response()->json([
                        'message' => 'success',
                        'code' => '200',
                        'data' => [
                            ['status' => 'Total Listings Available', 'count'=>$total_listings_available, 'operations'=>$sum_sale_listid_arr],
                            ['status' => 'Total Listing Available-Not Advertised', 'count'=>$total_available_notadv_listing, 'operations'=>$sum_notadv_listid_arr],
                            ['status' => 'Total Listing Coming Soon', 'count'=> $total_coming_soon_listing, 'operations'=> $sum_price_com_list_arr],
                            ['status' => 'Total Listing In Contract', 'count'=> $total_listing_in_contract, 'operations'=> $sum_price_cont_list_arr],
                            ['status' => 'Total Listing in LOI', 'count'=> $total_listing_in_LOI, 'operations'=> $sum_price_loi_list_arr],
                            ['status' => 'Total Sales Price of Listings', 'count'=> $sum_sale, 'operations'=> $sum_sale_listid_arr],
                            ['status' => 'Total Listings Sold This Year', 'count'=> $total_listing_sold, 'operations'=> $sum_price_sold_list_arr],
                            ['status' => 'Total Sold Prices This Year', 'count'=> $total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                            ['status' => 'Total Expired Listings This Year', 'count'=> $total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                            ['status' => 'Over 91 Days', 'count'=> 0, 'operations'=> ''],
                        ],
                    ]);
                } else {
                    $available_listing = Listing::select('id','bsaleprice')->where('olagent','!=','')->where('bstatuslist','Available')->get();
                    $total_listings_available = count($available_listing);
                    if($total_listings_available > 0){
                        foreach($available_listing as $k_sale=>$v_sale){
                            if($v_sale->bsaleprice != '' && $v_sale->bsaleprice != null){
                                $sum_sale += $v_sale->bsaleprice;
                            }
                            $sum_sale_listid = $v_sale->id;
                            array_push($sum_sale_listid_arr, $sum_sale_listid);
                        }
                    }
                
                    $available_notadv_listing = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','Available not Advertised')->get();
                    $total_available_notadv_listing = count($available_notadv_listing);
                    if($total_available_notadv_listing > 0){
                        foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                            if($v_notadv->bsaleprice != '' && $v_notadv->bsaleprice != null){
                                $sum_notadv += $v_notadv->bsaleprice;
                            }
                            $sum_notadv_listid = $v_notadv->id;
                            array_push($sum_notadv_listid_arr, $sum_notadv_listid);
                        }
                    }
                
                    $coming_soon_listing = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','Coming Soon')->get();
                    $total_coming_soon_listing = count($coming_soon_listing);
                    if($total_coming_soon_listing > 0){
                        foreach($coming_soon_listing as $k_com=>$v_com){
                            if($v_com->selling_price != '' && $v_com->selling_price != null ){
                                $total_price_com_list += $v_com->selling_price;
                            }
                            $com_list_id = $v_com->id;
                            array_push($sum_price_com_list_arr, $com_list_id);
                        }
                    }
                
                    $listing_in_contract = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','In Contract')->get();
                    $total_listing_in_contract = count($listing_in_contract);
                    if($total_listing_in_contract > 0){
                        foreach($listing_in_contract as $k_cont=>$v_cont){
                            if($v_cont->selling_price != '' && $v_cont->selling_price != null ){
                                $total_price_cont_list += $v_cont->selling_price;
                            }
                            $cont_list_id = $v_cont->id;
                            array_push($sum_price_cont_list_arr, $cont_list_id);
                        }
                    }
                
                    $listing_in_LOI = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','LOI')->get();
                    $total_listing_in_LOI = count($listing_in_LOI);
                    if($total_listing_in_LOI > 0){
                        foreach($listing_in_LOI as $k_loi=>$v_loi){
                            if($v_loi->selling_price != '' && $v_loi->selling_price != null ){
                                $total_price_loi_list += $v_loi->selling_price;
                            }
                            $loi_list_id = $v_loi->id;
                            array_push($sum_price_loi_list_arr, $loi_list_id);
                        }
                    }
            
                    $current = date('Y-m-d');
                    $current_year = date('Y');
                    
                    if($date_filter != ''){
                        $resDate= explode('/', $date_filter);   
                        $agent_from = $resDate[0];
                        $agent_to = $resDate[1];
                        
                        $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                        $total_listing_sold = count($listing_sold);
                        if($total_listing_sold > 0){
                            foreach($listing_sold as $k_sold=>$v_sold){
                                if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                    $total_price_sold_list += $v_sold->selling_price;
                                }
                                $sold_list_id = $v_sold->id;
                                array_push($sum_price_sold_list_arr, $sold_list_id);
                            }
                        }
                        
                        $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                        $total_listing_expired = count($listing_expired);
                        if($total_listing_expired > 0){
                            foreach($listing_expired as $k_exp=>$v_exp){
                                if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                    $total_price_exp_list += $v_exp->selling_price;
                                }
                                $exp_list_id = $v_exp->id;
                                array_push($sum_price_exp_list_arr, $exp_list_id);
                            }
                        }
                        
                        $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                        $total_listing_cancelled = count($listing_cancelled);
                        
                    } else {
                        $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                        $total_listing_sold = count($listing_sold);
                        if($total_listing_sold > 0){
                            foreach($listing_sold as $k_sold=>$v_sold){
                                if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                    $total_price_sold_list += $v_sold->selling_price;
                                }
                                $sold_list_id = $v_sold->id;
                                array_push($sum_price_sold_list_arr, $sold_list_id);
                            }
                        }
                        
                        $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                        $total_listing_expired = count($listing_expired);
                        if($total_listing_expired > 0){
                            foreach($listing_expired as $k_exp=>$v_exp){
                                if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                    $total_price_exp_list += $v_exp->selling_price;
                                }
                                $exp_list_id = $v_exp->id;
                                array_push($sum_price_exp_list_arr, $exp_list_id);
                            }
                        }
                        
                        
                        $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                        $total_listing_cancelled = count($listing_cancelled);
                    }
            
                    return response()->json([
                        'message' => 'success',
                        'code' => '200',
                        'data' => [
                            ['status' => 'Total Listings Available', 'count'=>$total_listings_available, 'operations'=>$sum_sale_listid_arr],
                            ['status' => 'Total Listing Available-Not Advertised', 'count'=>$total_available_notadv_listing, 'operations'=>$sum_notadv_listid_arr],
                            ['status' => 'Total Listing Coming Soon', 'count'=> $total_coming_soon_listing, 'operations'=> $sum_price_com_list_arr],
                            ['status' => 'Total Listing In Contract', 'count'=> $total_listing_in_contract, 'operations'=> $sum_price_cont_list_arr],
                            ['status' => 'Total Listing in LOI', 'count'=> $total_listing_in_LOI, 'operations'=> $sum_price_loi_list_arr],
                            ['status' => 'Total Sales Price of Listings', 'count'=> $sum_sale, 'operations'=> $sum_sale_listid_arr],
                            ['status' => 'Total Listings Sold This Year', 'count'=> $total_listing_sold, 'operations'=> $sum_price_sold_list_arr],
                            ['status' => 'Total Sold Prices This Year', 'count'=> $total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                            ['status' => 'Total Expired Listings This Year', 'count'=> $total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                            ['status' => 'Over 91 Days', 'count'=> 0, 'operations'=> ''],
                        ],
                    ]);
                }
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
                       if((isset($request->agent_id)) && ($request->agent_id != '')){
                            $agentId = $request->agent_id;
                            $available_listing = Listing::select('id','bsaleprice')->where('olagent',$agentId)->where('bstatuslist','Available')->get();
                            $total_listings_available = count($available_listing);
                            if($total_listings_available > 0){
                                foreach($available_listing as $k_sale=>$v_sale){
                                    if($v_sale->bsaleprice != '' && $v_sale->bsaleprice != null){
                                        $sum_sale += $v_sale->bsaleprice;
                                    }
                                    $sum_sale_listid = $v_sale->id;
                                    array_push($sum_sale_listid_arr, $sum_sale_listid);
                                }
                            }
                            
                            $available_notadv_listing = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','Available not Advertised')->get();
                            $total_available_notadv_listing = count($available_notadv_listing);
                            if($total_available_notadv_listing > 0){
                                foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                                    if($v_notadv->bsaleprice != '' && $v_notadv->bsaleprice != null){
                                        $sum_notadv += $v_notadv->bsaleprice;
                                    }
                                    $sum_notadv_listid = $v_notadv->id;
                                    array_push($sum_notadv_listid_arr, $sum_notadv_listid);
                                }
                            } 
                            
                            $coming_soon_listing = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','Coming Soon')->get();
                            $total_coming_soon_listing = count($coming_soon_listing);
                            if($total_coming_soon_listing > 0){
                                foreach($coming_soon_listing as $k_com=>$v_com){
                                    if($v_com->selling_price != '' && $v_com->selling_price != null ){
                                        $total_price_com_list += $v_com->selling_price;
                                    }
                                    $com_list_id = $v_com->id;
                                    array_push($sum_price_com_list_arr, $com_list_id);
                                }
                            }
                            
                            $listing_in_contract = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','In Contract')->get();
                            $total_listing_in_contract = count($listing_in_contract);
                            if($total_listing_in_contract > 0){
                                foreach($listing_in_contract as $k_cont=>$v_cont){
                                    if($v_cont->selling_price != '' && $v_cont->selling_price != null ){
                                        $total_price_cont_list += $v_cont->selling_price;
                                    }
                                    $cont_list_id = $v_cont->id;
                                    array_push($sum_price_cont_list_arr, $cont_list_id);
                                }
                            }
                            
                            $listing_in_LOI = Listing::select('id')->where('olagent',$agentId)->where('bstatuslist','LOI')->get();
                            $total_listing_in_LOI = count($listing_in_LOI);
                            if($total_listing_in_LOI > 0){
                                foreach($listing_in_LOI as $k_loi=>$v_loi){
                                    if($v_loi->selling_price != '' && $v_loi->selling_price != null ){
                                        $total_price_loi_list += $v_loi->selling_price;
                                    }
                                    $loi_list_id = $v_loi->id;
                                    array_push($sum_price_loi_list_arr, $loi_list_id);
                                }
                            }

                            $current = date('Y-m-d');
                            $current_year = date('Y');
                        
                            if($date_filter != ''){
                                $resDate= explode('/', $date_filter);   
                                $agent_from = $resDate[0];
                                $agent_to = $resDate[1];
                                
                                $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                                $total_listing_sold = count($listing_sold);
                                if($total_listing_sold > 0){
                                    foreach($listing_sold as $k_sold=>$v_sold){
                                        if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                            $total_price_sold_list += $v_sold->selling_price;
                                        }
                                        $sold_list_id = $v_sold->id;
                                        array_push($sum_price_sold_list_arr, $sold_list_id);
                                    }
                                }
                                
                                $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                                $total_listing_expired = count($listing_expired);
                                if($total_listing_expired > 0){
                                    foreach($listing_expired as $k_exp=>$v_exp){
                                        if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                            $total_price_exp_list += $v_exp->selling_price;
                                        }
                                        $exp_list_id = $v_exp->id;
                                        array_push($sum_price_exp_list_arr, $exp_list_id);
                                    }
                                }
                                
                                $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                                $total_listing_cancelled = count($listing_cancelled);
                            } else {
                                $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                                $total_listing_sold = count($listing_sold);
                                if($total_listing_sold > 0){
                                    foreach($listing_sold as $k_sold=>$v_sold){
                                        if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                            $total_price_sold_list += $v_sold->selling_price;
                                        }
                                        $sold_list_id = $v_sold->id;
                                        array_push($sum_price_sold_list_arr, $sold_list_id);
                                    }
                                }
                                
                                $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                                $total_listing_expired = count($listing_expired);
                                if($total_listing_expired > 0){
                                    foreach($listing_expired as $k_exp=>$v_exp){
                                        if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                            $total_price_exp_list += $v_exp->selling_price;
                                        }
                                        $exp_list_id = $v_exp->id;
                                        array_push($sum_price_exp_list_arr, $exp_list_id);
                                    }
                                }
                                
                                $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$agentId)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                                $total_listing_cancelled = count($listing_cancelled);
                            }
            
                            return response()->json([
                                'message' => 'success',
                                'code' => '200',
                                'data' => [
                                    ['status' => 'Total Listings Available', 'count'=>$total_listings_available, 'operations'=>$sum_sale_listid_arr],
                                    ['status' => 'Total Listing Available-Not Advertised', 'count'=>$total_available_notadv_listing, 'operations'=>$sum_notadv_listid_arr],
                                    ['status' => 'Total Listing Coming Soon', 'count'=> $total_coming_soon_listing, 'operations'=> $sum_price_com_list_arr],
                                    ['status' => 'Total Listing In Contract', 'count'=> $total_listing_in_contract, 'operations'=> $sum_price_cont_list_arr],
                                    ['status' => 'Total Listing in LOI', 'count'=> $total_listing_in_LOI, 'operations'=> $sum_price_loi_list_arr],
                                    ['status' => 'Total Sales Price of Listings', 'count'=> $sum_sale, 'operations'=> $sum_sale_listid_arr],
                                    ['status' => 'Total Listings Sold This Year', 'count'=> $total_listing_sold, 'operations'=> $sum_price_sold_list_arr],
                                    ['status' => 'Total Sold Prices This Year', 'count'=> $total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                                    ['status' => 'Total Expired Listings This Year', 'count'=> $total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                                    ['status' => 'Over 91 Days', 'count'=> 0, 'operations'=> ''],
                                ],
                            ]);
                        } else {
                            $available_listing = Listing::select('id','bsaleprice')->where('olagent','!=','')->where('bstatuslist','Available')->get();
                            $total_listings_available = count($available_listing);
                            if($total_listings_available > 0){
                                foreach($available_listing as $k_sale=>$v_sale){
                                    if($v_sale->bsaleprice != '' && $v_sale->bsaleprice != null){
                                        $sum_sale += $v_sale->bsaleprice;
                                    }
                                    $sum_sale_listid = $v_sale->id;
                                    array_push($sum_sale_listid_arr, $sum_sale_listid);
                                }
                            }
                            
                            $available_notadv_listing = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','Available not Advertised')->get();
                            $total_available_notadv_listing = count($available_notadv_listing);
                            if($total_available_notadv_listing > 0){
                                foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                                    if($v_notadv->bsaleprice != '' && $v_notadv->bsaleprice != null){
                                        $sum_notadv += $v_notadv->bsaleprice;
                                    }
                                    $sum_notadv_listid = $v_notadv->id;
                                    array_push($sum_notadv_listid_arr, $sum_notadv_listid);
                                }
                            } 
                            
                            $coming_soon_listing = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','Coming Soon')->get();
                            $total_coming_soon_listing = count($coming_soon_listing);
                            if($total_coming_soon_listing > 0){
                                foreach($coming_soon_listing as $k_com=>$v_com){
                                    if($v_com->selling_price != '' && $v_com->selling_price != null ){
                                        $total_price_com_list += $v_com->selling_price;
                                    }
                                    $com_list_id = $v_com->id;
                                    array_push($sum_price_com_list_arr, $com_list_id);
                                }
                            }
                            
                            $listing_in_contract = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','In Contract')->get();
                            $total_listing_in_contract = count($listing_in_contract);
                            if($total_listing_in_contract > 0){
                                foreach($listing_in_contract as $k_cont=>$v_cont){
                                    if($v_cont->selling_price != '' && $v_cont->selling_price != null ){
                                        $total_price_cont_list += $v_cont->selling_price;
                                    }
                                    $cont_list_id = $v_cont->id;
                                    array_push($sum_price_cont_list_arr, $cont_list_id);
                                }
                            }
                            
                            $listing_in_LOI = Listing::select('id')->where('olagent','!=','')->where('bstatuslist','LOI')->get();
                            $total_listing_in_LOI = count($listing_in_LOI);
                            if($total_listing_in_LOI > 0){
                                foreach($listing_in_LOI as $k_loi=>$v_loi){
                                    if($v_loi->selling_price != '' && $v_loi->selling_price != null ){
                                        $total_price_loi_list += $v_loi->selling_price;
                                    }
                                    $loi_list_id = $v_loi->id;
                                    array_push($sum_price_loi_list_arr, $loi_list_id);
                                }
                            }

                            $current = date('Y-m-d');
                            $current_year = date('Y');
                        
                            if($date_filter != ''){
                                $resDate= explode('/', $date_filter);   
                                $agent_from = $resDate[0];
                                $agent_to = $resDate[1];
                                
                                $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                                $total_listing_sold = count($listing_sold);
                                if($total_listing_sold > 0){
                                    foreach($listing_sold as $k_sold=>$v_sold){
                                        if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                            $total_price_sold_list += $v_sold->selling_price;
                                        }
                                        $sold_list_id = $v_sold->id;
                                        array_push($sum_price_sold_list_arr, $sold_list_id);
                                    }
                                }
                                
                                $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                                $total_listing_expired = count($listing_expired);
                                if($total_listing_expired > 0){
                                    foreach($listing_expired as $k_exp=>$v_exp){
                                        if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                            $total_price_exp_list += $v_exp->selling_price;
                                        }
                                        $exp_list_id = $v_exp->id;
                                        array_push($sum_price_exp_list_arr, $exp_list_id);
                                    }
                                }
                                
                                $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                                $total_listing_cancelled = count($listing_cancelled);
                            } else {
                                $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                                $total_listing_sold = count($listing_sold);
                                if($total_listing_sold > 0){
                                    foreach($listing_sold as $k_sold=>$v_sold){
                                        if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                            $total_price_sold_list += $v_sold->selling_price;
                                        }
                                        $sold_list_id = $v_sold->id;
                                        array_push($sum_price_sold_list_arr, $sold_list_id);
                                    }
                                }
                                
                                $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                                $total_listing_expired = count($listing_expired);
                                if($total_listing_expired > 0){
                                    foreach($listing_expired as $k_exp=>$v_exp){
                                        if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                            $total_price_exp_list += $v_exp->selling_price;
                                        }
                                        $exp_list_id = $v_exp->id;
                                        array_push($sum_price_exp_list_arr, $exp_list_id);
                                    }
                                }
                                
                                $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent','!=','')->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                                $total_listing_cancelled = count($listing_cancelled);
                            }
            
                            return response()->json([
                                'message' => 'success',
                                'code' => '200',
                                'data' => [
                                    ['status' => 'Total Listings Available', 'count'=>$total_listings_available, 'operations'=>$sum_sale_listid_arr],
                                    ['status' => 'Total Listing Available-Not Advertised', 'count'=>$total_available_notadv_listing, 'operations'=>$sum_notadv_listid_arr],
                                    ['status' => 'Total Listing Coming Soon', 'count'=> $total_coming_soon_listing, 'operations'=> $sum_price_com_list_arr],
                                    ['status' => 'Total Listing In Contract', 'count'=> $total_listing_in_contract, 'operations'=> $sum_price_cont_list_arr],
                                    ['status' => 'Total Listing in LOI', 'count'=> $total_listing_in_LOI, 'operations'=> $sum_price_loi_list_arr],
                                    ['status' => 'Total Sales Price of Listings', 'count'=> $sum_sale, 'operations'=> $sum_sale_listid_arr],
                                    ['status' => 'Total Listings Sold This Year', 'count'=> $total_listing_sold, 'operations'=> $sum_price_sold_list_arr],
                                    ['status' => 'Total Sold Prices This Year', 'count'=> $total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                                    ['status' => 'Total Expired Listings This Year', 'count'=> $total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                                    ['status' => 'Over 91 Days', 'count'=> 0, 'operations'=> ''],
                                ],
                            ]);
                        }
                    }

                    if($user_type == '5'){
                        $available_listing = Listing::select('id','bsaleprice')->where('olagent',$user_id)->where('bstatuslist','Available')->get();
                        $total_listings_available = count($available_listing);
                        if($total_listings_available > 0){
                            foreach($available_listing as $k_sale=>$v_sale){
                                if($v_sale->bsaleprice != '' && $v_sale->bsaleprice != null){
                                    $sum_sale += $v_sale->bsaleprice;
                                }
                                $sum_sale_listid = $v_sale->id;
                                array_push($sum_sale_listid_arr, $sum_sale_listid);
                            }
                        }
                        
                        $available_notadv_listing = Listing::select('id')->where('olagent',$user_id)->where('bstatuslist','Available not Advertised')->get();
                        $total_available_notadv_listing = count($available_notadv_listing);
                        if($total_available_notadv_listing > 0){
                            foreach($available_notadv_listing as $k_notadv=>$v_notadv){
                                if($v_notadv->bsaleprice != '' && $v_notadv->bsaleprice != null){
                                    $sum_notadv += $v_notadv->bsaleprice;
                                }
                                $sum_notadv_listid = $v_notadv->id;
                                array_push($sum_notadv_listid_arr, $sum_notadv_listid);
                            }
                        } 
                        
                        $coming_soon_listing = Listing::select('id')->where('olagent',$user_id)->where('bstatuslist','Coming Soon')->get();
                        $total_coming_soon_listing = count($coming_soon_listing);
                        if($total_coming_soon_listing > 0){
                            foreach($coming_soon_listing as $k_com=>$v_com){
                                if($v_com->selling_price != '' && $v_com->selling_price != null ){
                                    $total_price_com_list += $v_com->selling_price;
                                }
                                $com_list_id = $v_com->id;
                                array_push($sum_price_com_list_arr, $com_list_id);
                            }
                        }
                        

                        $listing_in_contract = Listing::select('id')->where('olagent',$user_id)->where('bstatuslist','In Contract')->get();
                        $total_listing_in_contract = count($listing_in_contract);
                        if($total_listing_in_contract > 0){
                            foreach($listing_in_contract as $k_cont=>$v_cont){
                                if($v_cont->selling_price != '' && $v_cont->selling_price != null ){
                                    $total_price_cont_list += $v_cont->selling_price;
                                }
                                $cont_list_id = $v_cont->id;
                                array_push($sum_price_cont_list_arr, $cont_list_id);
                            }
                        }

                        $listing_in_LOI = Listing::select('id')->where('olagent',$user_id)->where('bstatuslist','LOI')->get();
                        $total_listing_in_LOI = count($listing_in_LOI);
                        if($total_listing_in_LOI > 0){
                            foreach($listing_in_LOI as $k_loi=>$v_loi){
                                if($v_loi->selling_price != '' && $v_loi->selling_price != null ){
                                    $total_price_loi_list += $v_loi->selling_price;
                                }
                                $loi_list_id = $v_loi->id;
                                array_push($sum_price_loi_list_arr, $loi_list_id);
                            }
                        }
                    

                        $current = date('Y-m-d');
                        $current_year = date('Y');
                        
                        if($date_filter != ''){
                            $resDate= explode('/', $date_filter);   
                            $agent_from = $resDate[0];
                            $agent_to = $resDate[1];
                            
                            $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$user_id)->where('bstatuslist','Sold')->whereBetween('bsolddate', [$agent_from, $agent_to])->get();
                            $total_listing_sold = count($listing_sold);
                            if($total_listing_sold > 0){
                                foreach($listing_sold as $k_sold=>$v_sold){
                                    if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                        $total_price_sold_list += $v_sold->selling_price;
                                    }
                                    $sold_list_id = $v_sold->id;
                                    array_push($sum_price_sold_list_arr, $sold_list_id);
                                }
                            }
                            
                            $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$user_id)->where('bstatuslist','Expired')->whereBetween('bexpiredate', [$agent_from, $agent_to])->get();
                            $total_listing_expired = count($listing_expired);
                            if($total_listing_expired > 0){
                                foreach($listing_expired as $k_exp=>$v_exp){
                                    if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                        $total_price_exp_list += $v_exp->selling_price;
                                    }
                                    $exp_list_id = $v_exp->id;
                                    array_push($sum_price_exp_list_arr, $exp_list_id);
                                }
                            }
                                                        
                            $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$user_id)->where('bstatuslist','Cancelled')->whereBetween('bcanceldate', [$agent_from, $agent_to])->get();
                            $total_listing_cancelled = count($listing_cancelled);

                        } else {
                            $listing_sold = Listing::select('id','bsolddate','olagent','bstatuslist','selling_price')->where('olagent',$user_id)->where('bstatuslist','Sold')->whereYear('bsolddate',$current_year)->get();
                            $total_listing_sold = count($listing_sold);
                            if($total_listing_sold > 0){
                                foreach($listing_sold as $k_sold=>$v_sold){
                                    if($v_sold->selling_price != '' && $v_sold->selling_price != null ){
                                        $total_price_sold_list += $v_sold->selling_price;
                                    }
                                    $sold_list_id = $v_sold->id;
                                    array_push($sum_price_sold_list_arr, $sold_list_id);
                                }
                            }
                            
                            $listing_expired = Listing::select('id','bexpiredate','olagent','bstatuslist','selling_price')->where('olagent',$user_id)->where('bstatuslist','Expired')->whereYear('bexpiredate', $current_year)->get();
                            $total_listing_expired = count($listing_expired);
                            if($total_listing_expired > 0){
                                foreach($listing_expired as $k_exp=>$v_exp){
                                    if($v_exp->selling_price != '' && $v_exp->selling_price != null ){
                                        $total_price_exp_list += $v_exp->selling_price;
                                    }
                                    $exp_list_id = $v_exp->id;
                                    array_push($sum_price_exp_list_arr, $exp_list_id);
                                }
                            }
                            
                            $listing_cancelled = Listing::select('id','bcanceldate','olagent','bstatuslist','selling_price')->where('olagent',$user_id)->where('bstatuslist','Cancelled')->whereYear('bcanceldate', $current_year)->get();
                            $total_listing_cancelled = count($listing_cancelled);
                        }
                        return response()->json([
                            'message' => 'success',
                            'code' => '200',
                            'data' => [
                                ['status' => 'Total Listings Available', 'count'=>$total_listings_available, 'operations'=>$sum_sale_listid_arr],
                                ['status' => 'Total Listing Available-Not Advertised', 'count'=>$total_available_notadv_listing, 'operations'=>$sum_notadv_listid_arr],
                                ['status' => 'Total Listing Coming Soon', 'count'=> $total_coming_soon_listing, 'operations'=> $sum_price_com_list_arr],
                                ['status' => 'Total Listing In Contract', 'count'=> $total_listing_in_contract, 'operations'=> $sum_price_cont_list_arr],
                                ['status' => 'Total Listing in LOI', 'count'=> $total_listing_in_LOI, 'operations'=> $sum_price_loi_list_arr],
                                ['status' => 'Total Sales Price of Listings', 'count'=> $sum_sale, 'operations'=> $sum_sale_listid_arr],
                                ['status' => 'Total Listings Sold This Year', 'count'=> $total_listing_sold, 'operations'=> $sum_price_sold_list_arr],
                                ['status' => 'Total Sold Prices This Year', 'count'=> $total_price_sold_list, 'operations'=> $sum_price_sold_list_arr],
                                ['status' => 'Total Expired Listings This Year', 'count'=> $total_listing_expired, 'operations'=> $sum_price_exp_list_arr],
                                ['status' => 'Over 91 Days', 'count'=> 0, 'operations'=> ''],
                            ],
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
    
    
}
