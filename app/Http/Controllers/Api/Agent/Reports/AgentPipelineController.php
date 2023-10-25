<?php

namespace App\Http\Controllers\Api\Agent\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AgentPipelineController extends Controller
{
    public function index(){
        try{
            $user = Auth::user();
            $userId= $user->id;
            if($user->hasRole('Agent Manager')) { 
                $result = Agents::select('id','firstname','lastname')->where('status',1)->where('isTypeAO','A')->get();
            }
            elseif($user->hasRole('Agent')) {
                $result = Agents::select('id','firstname','lastname')->where('status',1)->where('isTypeAO','A')->where('id',$userId)->get();
            } 
            else {
                $result = Agents::select('id','firstname','lastname')->where('status',1)->where('isTypeAO','A')->get();
            }
            return response()->json(['message'=>'success','code'=>'200','data'=>$result]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
    public function get_agent_data(Request $request){
        try{
            // return 'here';
            $user = Auth::user();
            // $userId= $user->id;
            $current = date('Y-m-d');
            $sum_sale = 0;
            $sum_comm = 0;
            $sum_sale_loi = 0;
            $sum_comm_loi = 0;
            $total_datepay_term = 0;
            $datepay_term = [];
            $dateTopay = '';
            $total_datepay_sold = 0;
            $dateTopay_sold = '';
            $rw_total = 0;
            $uponclosing30 = 0;
            $uponclosing60 = 0;
            $uponclosing90 = 0;
            $uponclosing91 = 0;
            $sale_id_arr = array();
            $comm_id_arr = array();
            $sale_loi_arr = array();
            $comm_loi_arr = array();
            $v_term_fee_arr = array();
            $v_sold_arr = array();
            $closing30 = 0;
            $closing60 = 0;
            $closing90 = 0;
            $closing91 = 0;
            $incont_id_arr = array(); 
            
            if($user->hasRole('Agent')) {
                // dd('Agent');
                $result = Agents::select('id','firstname','lastname')->where('status',1)->where('isTypeAO','A')->where('id',$user->id)->first();
                
                $in_contract_selling_price =  Listing::where('bstatuslist','In Contract')->where('olagent',$user->id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                if(count($in_contract_selling_price) > 0){
                    foreach($in_contract_selling_price as $k_sale=>$v_sale){
                        if($v_sale->selling_price != null){
                            $sum_sale += $v_sale->selling_price;
                        }
                        
                        $sale_id = $v_sale->id;
                        array_push($incont_id_arr, $sale_id);
                    }
                }

                $bcommissionamount = DB::table('listing')->where('bstatuslist','In Contract')->where('olagent',$user->id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                if(count($bcommissionamount) > 0){
                    foreach($bcommissionamount as $k_comm=>$v_comm){
                        if($v_comm->bcommissionamount != null){
                            $sum_comm += $v_comm->bcommissionamount;
                        }
                        
                        $list_comm_id = $v_comm->id;
                        array_push($comm_id_arr,$list_comm_id);
                    }
                }
                
                $loi_selling_price = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$user->id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                if(count($loi_selling_price) > 0){
                    foreach($loi_selling_price as $Kloi_sale=>$v_loi_sale){
                        if($v_loi_sale->selling_price != null){
                            $sum_sale_loi += $v_loi_sale->selling_price;
                        }
                        
                        $sale_loi_id = $v_loi_sale->id;
                        array_push($sale_loi_arr, $sale_loi_id);
                    }
                }

                $bcommissionamount_loi = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$user->id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                if(count($bcommissionamount_loi) > 0){
                    foreach($bcommissionamount_loi as $k_comm_loi=>$v_comm_loi){
                        if($v_comm_loi->bcommissionamount != null){
                            $sum_comm_loi += $v_comm_loi->bcommissionamount;
                        }
                        
                        $comm_loi_id = $v_comm_loi->id;
                        array_push($comm_loi_arr, $comm_loi_id);
                    }
                }
                          
                $termination_fee = DB::table('listing')->where('bstatuslist','Cancelled')->where('olagent',$user->id)->select('id','date_on_fee','amount_fee')->get();
                if(count($termination_fee) > 0 ){
                    foreach($termination_fee as $k_term_fee=>$v_term_fee){
                        if($v_term_fee->amount_fee != ""){
                            $amount_fee_term = explode(',',$v_term_fee->amount_fee);
                        }
                        if($v_term_fee->date_on_fee != ""){
                            $datepay_term = explode(',',$v_term_fee->date_on_fee);
                            if($datepay_term[0] != ""){
                                $i=0;
                                foreach($datepay_term as $datePay){
                                    if (strtotime($datePay) > strtotime($current)) {
                                        $dateTopay .= $datePay[$i].",";
                                        $total_datepay_term += $amount_fee_term[$i];
                                    } 
                                    $i++;
                                }    
                            }
                        }
                        $v_term_fee_id = $v_term_fee->id;
                        array_push($v_term_fee_arr, $v_term_fee_id);
                        
                    }
                }

                $sold_not_funded = DB::table('listing')->where('bstatuslist','Sold')->where('olagent',$user->id)->select('id','date_on_fee','amount_fee')->get();
                if(count($sold_not_funded) > 0 ){
                    foreach($sold_not_funded as $k_sold=>$v_sold){
                        if($v_sold->amount_fee != ""){
                            $amount_fee_sold = explode(',',$v_sold->amount_fee);
                        }
                        if($v_sold->date_on_fee != ""){
                            $datepay_sold = explode(',',$v_sold->date_on_fee);
                            if($datepay_sold[0] != ""){
                                $j=0;
                                foreach($datepay_sold as $datePaySold){
                                    if (strtotime($datePaySold) > strtotime($current)) {
                                        $dateTopay_sold .= $datePaySold[$j].",";
                                        $total_datepay_sold += $amount_fee_sold[$j];
                                    } 
                                    $j++;
                                }    
                            }
                        }
                        $v_sold_id = $v_sold->id;
                        array_push($v_sold_arr, $v_sold_id);
                    }
                }
                
                $current30 =date('Y-m-d');
                $upto30 = date('Y-m-d', strtotime("+30 days"));
                $uponclosing30 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current30." AND '$upto30') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user->id." order by bclosingdate desc"));
                if(count($uponclosing30) > 0){
                    foreach($uponclosing30 as $k3=>$v3){
                        if($v3->total != null){
                            $closing30 = $v3->total;
                        } else {
                            $closing30 = 0;
                        }
                        
                    }
                }
                
                
                $current60 = date('Y-m-d', strtotime("+30 days"));
                $upto60 = date('Y-m-d', strtotime("+60 days"));
                $uponclosing60 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current60." AND '$upto60') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user->id." order by bclosingdate desc"));
                if(count($uponclosing60) > 0){
                    foreach($uponclosing60 as $k6=>$v6){
                        if($v6->total != null){
                            $closing60 = $v6->total;
                        } else {
                            $closing60 = 0;
                        }
                        
                    }
                }

                $current90 = date('Y-m-d', strtotime("+61 days"));
                $upto90 = date('Y-m-d', strtotime("+91 days"));
                $uponclosing90 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current90." AND '$upto90') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user->id." order by bclosingdate desc"));
                if(count($uponclosing90) > 0){
                    foreach($uponclosing90 as $k9=>$v9){
                        if($v9->total != null){
                            $closing90 = $v9->total;
                        } else {
                            $closing90 = 0;
                        }
                        
                    }
                }

                $current91 = date('Y-m-d', strtotime("+91 days"));
                $uponclosing91 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) > ".$current91.") AND commission_payable = 'Upon Closing' AND 'olagent'=".$user->id." order by bclosingdate desc"));
                if(count($uponclosing91) > 0){
                    foreach($uponclosing91 as $k91=>$v91){
                        if($v91->total != null){
                            $closing91 = $v91->total;
                        } else {
                            $closing91 = 0;
                        }
                        
                    }
                }
                
                return response()->json([
                    'message'=>'success',
                    'code'=>'200',
                    'login'=>'agent',
                    'data'=>[
                        ['status'=>'In Contract Selling Price' ,'count'=>$sum_sale , 'operations'=> $incont_id_arr],
                        ['status'=>'In Contract Commission' ,'count'=>$sum_comm , 'operations'=>$comm_id_arr ],
                        ['status'=>'In LOI Selling Price' ,'count'=>$sum_sale_loi , 'operations'=> $sale_loi_arr],
                        ['status'=>'In LOI Commission' ,'count'=>$sum_comm_loi , 'operations'=> $comm_loi_arr],
                        ['status'=>'Termination/Cancellation Fees Pending' ,'count'=>'$'.$total_datepay_term , 'operations'=>$v_term_fee_arr ],
                        ['status'=>'Sold but Not Funded' ,'count'=>'$'.$total_datepay_sold , 'operations'=> $v_sold_arr],
                        ['status'=>'0-30 Days' ,'count'=>$closing30 , 'operations'=> ''],
                        ['status'=>'31-60 Days' ,'count'=>$closing60 , 'operations'=>'' ],
                        ['status'=>'61-90 Days' ,'count'=>$closing90 , 'operations'=>'' ],
                        ['status'=>'Over 91 Days' ,'count'=>$closing91 , 'operations'=> ''],
                    ]
                    // 'data'=>[
                    //     'status'=>[ 'In Contract Selling Price', 'In Contract Commission', 'In LOI Selling Price', 'In LOI Commission','Termination/Cancellation Fees Pending', 'Sold but Not Funded', '0-30 Days', '31-60 Days', '61-90 Days', 'Over 91 Days' ],
                    //     'count'=>[ $sum_sale, $sum_comm, $sum_sale_loi, $sum_comm_loi, $total_datepay_term, $total_datepay_sold, $closing30, $closing60, $closing90, $closing91 ],
                    //     'operations'=> $op ,
                    // ]
                    // 'status1'=>'In Contract Selling Price', 'count1'=>$sum_sale, 'operations1'=>$sale_id_arr,
                    // 'status2'=>'In Contract Commission', 'count2'=>$sum_comm, 'operations2'=>$comm_id_arr
                ]);
            
            }

            if($user->hasRole('Agent Manager')) { 
                
                // $result = Agents::select('id','firstname','lastname')->where('status',1)->where('isTypeAO','A')->get();
                
                if((isset($request->id)) && ($request->id != '')){
                    $result = Agents::select('id','firstname','lastname')->where('id',$request->id)->where('status',1)->where('isTypeAO','A')->get();
                } else {
                    $result = Agents::select('id','firstname','lastname')->where('status',1)->where('isTypeAO','A')->get();
                }

                if(count($result) > 0){
                    
                    foreach($result as $a_key=>$a_val){

                        $in_contract_selling_price =  Listing::where('bstatuslist','In Contract')->where('olagent',$a_val->id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                        if(count($in_contract_selling_price) > 0){
                            foreach($in_contract_selling_price as $k_sale=>$v_sale){
                                if($v_sale->selling_price != null){
                                    $sum_sale += $v_sale->selling_price;
                                }
                                
                                $sale_id = $v_sale->id;
                                array_push($incont_id_arr, $sale_id);
                            }
                        }

                        $bcommissionamount = DB::table('listing')->where('bstatuslist','In Contract')->where('olagent',$a_val->id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                        if(count($bcommissionamount) > 0){
                            foreach($bcommissionamount as $k_comm=>$v_comm){
                                if($v_comm->bcommissionamount != null){
                                    $sum_comm += $v_comm->bcommissionamount;
                                }
                                
                                $list_comm_id = $v_comm->id;
                                array_push($comm_id_arr,$list_comm_id);
                            }
                        }
                        
                        $loi_selling_price = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$a_val->id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                        if(count($loi_selling_price) > 0){
                            foreach($loi_selling_price as $Kloi_sale=>$v_loi_sale){
                                if($v_loi_sale->selling_price != null){
                                    $sum_sale_loi += $v_loi_sale->selling_price;
                                }
                                
                                $sale_loi_id = $v_loi_sale->id;
                                array_push($sale_loi_arr, $sale_loi_id);
                            }
                        }

                        $bcommissionamount_loi = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$a_val->id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                        if(count($bcommissionamount_loi) > 0){
                            foreach($bcommissionamount_loi as $k_comm_loi=>$v_comm_loi){
                                if($v_comm_loi->bcommissionamount != null){
                                    $sum_comm_loi += $v_comm_loi->bcommissionamount;
                                }
                                
                                $comm_loi_id = $v_comm_loi->id;
                                array_push($comm_loi_arr, $comm_loi_id);
                            }
                        }
                                
                        $termination_fee = DB::table('listing')->where('bstatuslist','Cancelled')->where('olagent',$a_val->id)->select('id','date_on_fee','amount_fee')->get();
                        if(count($termination_fee) > 0 ){
                            foreach($termination_fee as $k_term_fee=>$v_term_fee){
                                if($v_term_fee->amount_fee != ""){
                                    $amount_fee_term = explode(',',$v_term_fee->amount_fee);
                                    $v_term_fee_id = $v_term_fee->id;
                                    array_push($v_term_fee_arr, $v_term_fee_id);
                                }
                                if($v_term_fee->date_on_fee != ""){
                                    $datepay_term = explode(',',$v_term_fee->date_on_fee);
                                    if($datepay_term[0] != ""){
                                        $i=0;
                                        foreach($datepay_term as $datePay){
                                            if (strtotime($datePay) > strtotime($current)) {
                                                $dateTopay .= $datePay[$i].",";
                                                $total_datepay_term += $amount_fee_term[$i];
                                            } 
                                            $i++;
                                        }    
                                    }
                                    
                                }
                            }

                            // foreach($termination_fee as $k_term_fee=>$v_term_fee){
                            //     if(($v_term_fee->amount_fee != "")  && ($v_term_fee->date_on_fee != "")){
                            //         $amount_fee_term = explode(',',$v_term_fee->amount_fee);
                            //         // print_r($amount_fee_term);
                            //     }
                            // }
                        }

                        $sold_not_funded = DB::table('listing')->where('bstatuslist','Sold')->where('olagent',$a_val->id)->select('id','date_on_fee','amount_fee')->get();
                        if(count($sold_not_funded) > 0 ){
                            foreach($sold_not_funded as $k_sold=>$v_sold){
                                if($v_sold->amount_fee != ""){
                                    $amount_fee_sold = explode(',',$v_sold->amount_fee);
                                }
                                if($v_sold->date_on_fee != ""){
                                    $datepay_sold = explode(',',$v_sold->date_on_fee);
                                    if($datepay_sold[0] != ""){
                                        $j=0;
                                        foreach($datepay_sold as $datePaySold){
                                            if (strtotime($datePaySold) > strtotime($current)) {
                                                $dateTopay_sold .= $datePaySold[$j].",";
                                                $total_datepay_sold += $amount_fee_sold[$j];
                                            } 
                                            $j++;
                                        }    
                                    }
                                }
                                $v_sold_id = $v_sold->id;
                                array_push($v_sold_arr, $v_sold_id);
                            }
                        }
                
                        $current30 =date('Y-m-d');
                        $upto30 = date('Y-m-d', strtotime("+30 days"));
                        $uponclosing30 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current30." AND '$upto30') AND commission_payable = 'Upon Closing' AND 'olagent'=".$a_val->id." order by bclosingdate desc"));
                        if(count($uponclosing30) > 0){
                            foreach($uponclosing30 as $k3=>$v3){
                                if($v3->total != null){
                                    $closing30 = $v3->total;
                                } else {
                                    $closing30 = 0;
                                }
                                
                            }
                        }
                        
                        
                        $current60 = date('Y-m-d', strtotime("+30 days"));
                        $upto60 = date('Y-m-d', strtotime("+60 days"));
                        $uponclosing60 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current60." AND '$upto60') AND commission_payable = 'Upon Closing' AND 'olagent'=".$a_val->id." order by bclosingdate desc"));
                        if(count($uponclosing60) > 0){
                            foreach($uponclosing60 as $k6=>$v6){
                                if($v6->total != null){
                                    $closing60 = $v6->total;
                                } else {
                                    $closing60 = 0;
                                }
                                
                            }
                        }

                        $current90 = date('Y-m-d', strtotime("+61 days"));
                        $upto90 = date('Y-m-d', strtotime("+91 days"));
                        $uponclosing90 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current90." AND '$upto90') AND commission_payable = 'Upon Closing' AND 'olagent'=".$a_val->id." order by bclosingdate desc"));
                        if(count($uponclosing90) > 0){
                            foreach($uponclosing90 as $k9=>$v9){
                                if($v9->total != null){
                                    $closing90 = $v9->total;
                                } else {
                                    $closing90 = 0;
                                }
                                
                            }
                        }

                        $current91 = date('Y-m-d', strtotime("+91 days"));
                        $uponclosing91 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) > ".$current91.") AND commission_payable = 'Upon Closing' AND 'olagent'=".$a_val->id." order by bclosingdate desc"));
                        if(count($uponclosing91) > 0){
                            foreach($uponclosing91 as $k91=>$v91){
                                if($v91->total != null){
                                    $closing91 = $v91->total;
                                } else {
                                    $closing91 = 0;
                                }
                                
                            }
                        }

                        
                    }
                    return response()->json([
                        'message'=>'success',
                        'code'=>'200',
                        'login'=>'agent manager',
                        'data'=>[
                            ['status'=>'In Contract Selling Price' ,'count'=>$sum_sale , 'operations'=> $incont_id_arr],
                            ['status'=>'In Contract Commission' ,'count'=>$sum_comm , 'operations'=>$comm_id_arr ],
                            ['status'=>'In LOI Selling Price' ,'count'=>$sum_sale_loi , 'operations'=> $sale_loi_arr],
                            ['status'=>'In LOI Commission' ,'count'=>$sum_comm_loi , 'operations'=> $comm_loi_arr],
                            ['status'=>'Termination/Cancellation Fees Pending' ,'count'=>'$'.$total_datepay_term , 'operations'=>$v_term_fee_arr ],
                            ['status'=>'Sold but Not Funded' ,'count'=>'$'.$total_datepay_sold , 'operations'=> $v_sold_arr],
                            ['status'=>'0-30 Days' ,'count'=>$closing30 , 'operations'=> ''],
                            ['status'=>'31-60 Days' ,'count'=>$closing60 , 'operations'=>'' ],
                            ['status'=>'61-90 Days' ,'count'=>$closing90 , 'operations'=>'' ],
                            ['status'=>'Over 91 Days' ,'count'=>$closing91 , 'operations'=> ''],
                        ]
                    ]);
                } 
                else {
                    return response()->json(['message'=>'success','code'=>'200','data'=>'No record found']);
                }
            }

           
            if($user->hasRole('Super User')){ 
                $user_type = 0;
                if((isset($request->id)) && ($request->id != '')){
                    $user_id = $request->id;
                    $result = Agents::select('id','firstname','lastname','user_id')->where('id',$request->id)->where('status',1)->where('isTypeAO','A')->first();
                    
                    if(isset($result->user_id)){
                        $user_data = User::where('id',$result->user_id)->first();
                        
                        if($user_data->type == '5'){
                            $in_contract_selling_price =  Listing::where('bstatuslist','In Contract')->where('olagent',$user_id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                            
                            if(count($in_contract_selling_price) > 0){
                                foreach($in_contract_selling_price as $k_sale=>$v_sale){
                                    if($v_sale->selling_price != null){
                                        $sum_sale += $v_sale->selling_price;
                                    }
                                    $sale_id = $v_sale->id;
                                    array_push($incont_id_arr, $sale_id);
                                }
                            }
                            $bcommissionamount = DB::table('listing')->where('bstatuslist','In Contract')->where('olagent',$user_id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                            if(count($bcommissionamount) > 0){
                                foreach($bcommissionamount as $k_comm=>$v_comm){
                                    if($v_comm->bcommissionamount != null){
                                        $sum_comm += $v_comm->bcommissionamount;
                                    }
                                    $list_comm_id = $v_comm->id;
                                    array_push($comm_id_arr,$list_comm_id);
                                }
                            }
                            
                            $loi_selling_price = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$user_id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                            if(count($loi_selling_price) > 0){
                                foreach($loi_selling_price as $Kloi_sale=>$v_loi_sale){
                                    if($v_loi_sale->selling_price != null){
                                        $sum_sale_loi += $v_loi_sale->selling_price;
                                    }
                                    
                                    $sale_loi_id = $v_loi_sale->id;
                                    array_push($sale_loi_arr, $sale_loi_id);
                                }
                            }
    
                            $bcommissionamount_loi = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$user_id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                            if(count($bcommissionamount_loi) > 0){
                                foreach($bcommissionamount_loi as $k_comm_loi=>$v_comm_loi){
                                    if($v_comm_loi->bcommissionamount != null){
                                        $sum_comm_loi += $v_comm_loi->bcommissionamount;
                                    }
                                    $comm_loi_id = $v_comm_loi->id;
                                    array_push($comm_loi_arr, $comm_loi_id);
                                }
                            }
                                    
                            $termination_fee = DB::table('listing')->where('bstatuslist','Cancelled')->where('olagent',$user_id)->select('id','date_on_fee','amount_fee')->get();
                            if(count($termination_fee) > 0 ){
                                foreach($termination_fee as $k_term_fee=>$v_term_fee){
                                    if($v_term_fee->amount_fee != ""){
                                        $amount_fee_term = explode(',',$v_term_fee->amount_fee);
                                        $v_term_fee_id = $v_term_fee->id;
                                        array_push($v_term_fee_arr, $v_term_fee_id);
                                    }
                                    if($v_term_fee->date_on_fee != ""){
                                        $datepay_term = explode(',',$v_term_fee->date_on_fee);
                                        if($datepay_term[0] != ""){
                                            $i=0;
                                            foreach($datepay_term as $datePay){
                                                if (strtotime($datePay) > strtotime($current)) {
                                                    $dateTopay .= $datePay[$i].",";
                                                    $total_datepay_term += $amount_fee_term[$i];
                                                } 
                                                $i++;
                                            }    
                                        }
                                        
                                    }
                                }
                            }
                            $sold_not_funded = DB::table('listing')->where('bstatuslist','Sold')->where('olagent',$user_id)->select('id','date_on_fee','amount_fee')->get();
                            if(count($sold_not_funded) > 0 ){
                                foreach($sold_not_funded as $k_sold=>$v_sold){
                                    if($v_sold->amount_fee != ""){
                                        $amount_fee_sold = explode(',',$v_sold->amount_fee);
                                    }
                                    if($v_sold->date_on_fee != ""){
                                        $datepay_sold = explode(',',$v_sold->date_on_fee);
                                        if($datepay_sold[0] != ""){
                                            $j=0;
                                            foreach($datepay_sold as $datePaySold){
                                                if (strtotime($datePaySold) > strtotime($current)) {
                                                    $dateTopay_sold .= $datePaySold[$j].",";
                                                    $total_datepay_sold += $amount_fee_sold[$j];
                                                } 
                                                $j++;
                                            }    
                                        }
                                    }
                                    $v_sold_id = $v_sold->id;
                                    array_push($v_sold_arr, $v_sold_id);
                                }
                            }
                        
                            $current30 =date('Y-m-d');
                            $upto30 = date('Y-m-d', strtotime("+30 days"));
                            $uponclosing30 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current30." AND '$upto30') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                            if(count($uponclosing30) > 0){
                                foreach($uponclosing30 as $k3=>$v3){
                                    if($v3->total != null){
                                        $closing30 += $v3->total;
                                    } else {
                                        $closing30 = 0;
                                    }
                                    
                                }
                            }
                                
                                
                            $current60 = date('Y-m-d', strtotime("+30 days"));
                            $upto60 = date('Y-m-d', strtotime("+60 days"));
                            $uponclosing60 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current60." AND '$upto60') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                            if(count($uponclosing60) > 0){
                                foreach($uponclosing60 as $k6=>$v6){
                                    if($v6->total != null){
                                        $closing60 += $v6->total;
                                    } else {
                                        $closing60 = 0;
                                    }
                                    
                                }
                            }
        
                            $current90 = date('Y-m-d', strtotime("+61 days"));
                            $upto90 = date('Y-m-d', strtotime("+91 days"));
                            $uponclosing90 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current90." AND '$upto90') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                            if(count($uponclosing90) > 0){
                                foreach($uponclosing90 as $k9=>$v9){
                                    if($v9->total != null){
                                        $closing90 += $v9->total;
                                    } else {
                                        $closing90 = 0;
                                    }
                                    
                                }
                            }
        
                            $current91 = date('Y-m-d', strtotime("+91 days"));
                            $uponclosing91 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) > ".$current91.") AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                            if(count($uponclosing91) > 0){
                                foreach($uponclosing91 as $k91=>$v91){
                                    if($v91->total != null){
                                        $closing91 += $v91->total;
                                    } else {
                                        $closing91 = 0;
                                    }
                                    
                                }
                            }
                            
                            return response()->json([
                                'message'=>'success',
                                'code'=>'200',
                                'data'=>[
                                    ['status'=>'In Contract Selling Price' ,'count'=>$sum_sale , 'operations'=> $incont_id_arr],
                                    ['status'=>'In Contract Commission' ,'count'=>$sum_comm , 'operations'=>$comm_id_arr ],
                                    ['status'=>'In LOI Selling Price' ,'count'=>$sum_sale_loi , 'operations'=> $sale_loi_arr],
                                    ['status'=>'In LOI Commission' ,'count'=>$sum_comm_loi , 'operations'=> $comm_loi_arr],
                                    ['status'=>'Termination/Cancellation Fees Pending' ,'count'=>'$'.$total_datepay_term , 'operations'=>$v_term_fee_arr ],
                                    ['status'=>'Sold but Not Funded' ,'count'=>'$'.$total_datepay_sold , 'operations'=> $v_sold_arr],
                                    ['status'=>'0-30 Days' ,'count'=>$closing30 , 'operations'=> ''],
                                    ['status'=>'31-60 Days' ,'count'=>$closing60 , 'operations'=>'' ],
                                    ['status'=>'61-90 Days' ,'count'=>$closing90 , 'operations'=>'' ],
                                    ['status'=>'Over 91 Days' ,'count'=>$closing91 , 'operations'=> ''],
                                ]
                            ]);
                        }

                        if($user_data->type == '6'){
                            if((isset($request->agent_id)) && ($request->agent_id != '')){
                                $in_contract_selling_price =  Listing::where('bstatuslist','In Contract')->where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                                
                                if(count($in_contract_selling_price) > 0){
                                    foreach($in_contract_selling_price as $k_sale=>$v_sale){
                                        if($v_sale->selling_price != null){
                                            $sum_sale += $v_sale->selling_price;
                                        }
                                        $sale_id = $v_sale->id;
                                        array_push($incont_id_arr, $sale_id);
                                    }
                                }
                                $bcommissionamount = DB::table('listing')->where('bstatuslist','In Contract')->where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                                if(count($bcommissionamount) > 0){
                                    foreach($bcommissionamount as $k_comm=>$v_comm){
                                        if($v_comm->bcommissionamount != null){
                                            $sum_comm += $v_comm->bcommissionamount;
                                        }
                                        $list_comm_id = $v_comm->id;
                                        array_push($comm_id_arr,$list_comm_id);
                                    }
                                }
                                                        
                                $loi_selling_price = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                                if(count($loi_selling_price) > 0){
                                    foreach($loi_selling_price as $Kloi_sale=>$v_loi_sale){
                                        if($v_loi_sale->selling_price != null){
                                            $sum_sale_loi += $v_loi_sale->selling_price;
                                        }
                                        
                                        $sale_loi_id = $v_loi_sale->id;
                                        array_push($sale_loi_arr, $sale_loi_id);
                                    }
                                }
                        
                                $bcommissionamount_loi = DB::table('listing')->where('bstatuslist','LOI')->where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                                if(count($bcommissionamount_loi) > 0){
                                    foreach($bcommissionamount_loi as $k_comm_loi=>$v_comm_loi){
                                        if($v_comm_loi->bcommissionamount != null){
                                            $sum_comm_loi += $v_comm_loi->bcommissionamount;
                                        }
                                        $comm_loi_id = $v_comm_loi->id;
                                        array_push($comm_loi_arr, $comm_loi_id);
                                    }
                                }
                                                                
                                $termination_fee = DB::table('listing')->where('bstatuslist','Cancelled')->where('olagent',$request->agent_id)->select('id','date_on_fee','amount_fee')->get();
                                if(count($termination_fee) > 0 ){
                                    foreach($termination_fee as $k_term_fee=>$v_term_fee){
                                        if($v_term_fee->amount_fee != ""){
                                            $amount_fee_term = explode(',',$v_term_fee->amount_fee);
                                            $v_term_fee_id = $v_term_fee->id;
                                            array_push($v_term_fee_arr, $v_term_fee_id);
                                        }
                                        if($v_term_fee->date_on_fee != ""){
                                            $datepay_term = explode(',',$v_term_fee->date_on_fee);
                                            if($datepay_term[0] != ""){
                                                $i=0;
                                                foreach($datepay_term as $datePay){
                                                    if (strtotime($datePay) > strtotime($current)) {
                                                        $dateTopay .= $datePay[$i].",";
                                                        $total_datepay_term += $amount_fee_term[$i];
                                                    } 
                                                    $i++;
                                                }    
                                            }
                                            
                                        }
                                    }
                                }
                                $sold_not_funded = DB::table('listing')->where('bstatuslist','Sold')->where('olagent',$request->agent_id)->select('id','date_on_fee','amount_fee')->get();
                                if(count($sold_not_funded) > 0 ){
                                    foreach($sold_not_funded as $k_sold=>$v_sold){
                                        if($v_sold->amount_fee != ""){
                                            $amount_fee_sold = explode(',',$v_sold->amount_fee);
                                        }
                                        if($v_sold->date_on_fee != ""){
                                            $datepay_sold = explode(',',$v_sold->date_on_fee);
                                            if($datepay_sold[0] != ""){
                                                $j=0;
                                                foreach($datepay_sold as $datePaySold){
                                                    if (strtotime($datePaySold) > strtotime($current)) {
                                                        $dateTopay_sold .= $datePaySold[$j].",";
                                                        $total_datepay_sold += $amount_fee_sold[$j];
                                                    } 
                                                    $j++;
                                                }    
                                            }
                                        }
                                        $v_sold_id = $v_sold->id;
                                        array_push($v_sold_arr, $v_sold_id);
                                    }
                                }
                        
                                $current30 =date('Y-m-d');
                                $upto30 = date('Y-m-d', strtotime("+30 days"));
                                // $uponclosing30 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current30." AND '$upto30') AND commission_payable = 'Upon Closing' AND 'olagent'!=".$user_id." order by bclosingdate desc"));
                                $uponclosing30 = Listing::where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('bcommissionamount')->whereBetween('bclosingdate',[$current30,$upto30])->get();
                                if(count($uponclosing30) > 0){
                                    foreach($uponclosing30 as $k3=>$v3){
                                        if($v3->bcommissionamount != null){
                                            $closing30 += $v3->bcommissionamount;
                                        } else {
                                            $closing30 = 0;
                                        }
                                        
                                    }
                                }
                                                            
                                                            
                                $current60 = date('Y-m-d', strtotime("+30 days"));
                                $upto60 = date('Y-m-d', strtotime("+60 days"));
                                // $uponclosing60 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current60." AND '$upto60') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                                $uponclosing60 = Listing::where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('bcommissionamount')->whereBetween('bclosingdate',[$current60,$upto60])->get();
                                if(count($uponclosing60) > 0){
                                    foreach($uponclosing60 as $k6=>$v6){
                                        if($v6->bcommissionamount != null){
                                            $closing60 += $v6->bcommissionamount;
                                        } else {
                                            $closing60 = 0;
                                        }
                                        
                                    }
                                }
                                    
                                $current90 = date('Y-m-d', strtotime("+61 days"));
                                $upto90 = date('Y-m-d', strtotime("+91 days"));
                                // $uponclosing90 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current90." AND '$upto90') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                                $uponclosing90 = Listing::where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('bcommissionamount')->whereBetween('bclosingdate',[$current90,$upto90])->get();
                                if(count($uponclosing90) > 0){
                                    foreach($uponclosing90 as $k9=>$v9){
                                        if($v9->bcommissionamount != null){
                                            $closing90 += $v9->bcommissionamount;
                                        } else {
                                            $closing90 = 0;
                                        }
                                        
                                    }
                                }
                                    
                                $current91 = date('Y-m-d', strtotime("+91 days"));
                                // $uponclosing91 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) > ".$current91.") AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                                $uponclosing91 = Listing::where('olagent',$request->agent_id)->where('commission_payable','Upon Closing')->select('bcommissionamount')->where('bclosingdate','>',$current91)->get();
                                if(count($uponclosing91) > 0){
                                    foreach($uponclosing91 as $k91=>$v91){
                                        if($v91->total != null){
                                            $closing91 += $v91->total;
                                        } else {
                                            $closing91 = 0;
                                        }
                                        
                                    }
                                }
                                                        
                                return response()->json([
                                    'message'=>'success',
                                    'code'=>'200',
                                    'data'=>[
                                        ['status'=>'In Contract Selling Price' ,'count'=>$sum_sale , 'operations'=> $incont_id_arr],
                                        ['status'=>'In Contract Commission' ,'count'=>$sum_comm , 'operations'=>$comm_id_arr ],
                                        ['status'=>'In LOI Selling Price' ,'count'=>$sum_sale_loi , 'operations'=> $sale_loi_arr],
                                        ['status'=>'In LOI Commission' ,'count'=>$sum_comm_loi , 'operations'=> $comm_loi_arr],
                                        ['status'=>'Termination/Cancellation Fees Pending' ,'count'=>'$'.$total_datepay_term , 'operations'=>$v_term_fee_arr ],
                                        ['status'=>'Sold but Not Funded' ,'count'=>'$'.$total_datepay_sold , 'operations'=> $v_sold_arr],
                                        ['status'=>'0-30 Days' ,'count'=>$closing30 , 'operations'=> ''],
                                        ['status'=>'31-60 Days' ,'count'=>$closing60 , 'operations'=>'' ],
                                        ['status'=>'61-90 Days' ,'count'=>$closing90 , 'operations'=>'' ],
                                        ['status'=>'Over 91 Days' ,'count'=>$closing91 , 'operations'=> ''],
                                    ]
                                ]);
                            }
                            else{
                                $in_contract_selling_price =  Listing::where('bstatuslist','In Contract')->where('olagent','!=','')->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                                
                                if(count($in_contract_selling_price) > 0){
                                    foreach($in_contract_selling_price as $k_sale=>$v_sale){
                                        if($v_sale->selling_price != null){
                                            $sum_sale += $v_sale->selling_price;
                                        }
                                        $sale_id = $v_sale->id;
                                        array_push($incont_id_arr, $sale_id);
                                    }
                                }
                                $bcommissionamount = DB::table('listing')->where('bstatuslist','In Contract')->where('olagent','!=','')->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                                if(count($bcommissionamount) > 0){
                                    foreach($bcommissionamount as $k_comm=>$v_comm){
                                        if($v_comm->bcommissionamount != null){
                                            $sum_comm += $v_comm->bcommissionamount;
                                        }
                                        $list_comm_id = $v_comm->id;
                                        array_push($comm_id_arr,$list_comm_id);
                                    }
                                }
                                                        
                                $loi_selling_price = DB::table('listing')->where('bstatuslist','LOI')->where('olagent','!=','')->where('commission_payable','Upon Closing')->select('selling_price','id')->get();
                                if(count($loi_selling_price) > 0){
                                    foreach($loi_selling_price as $Kloi_sale=>$v_loi_sale){
                                        if($v_loi_sale->selling_price != null){
                                            $sum_sale_loi += $v_loi_sale->selling_price;
                                        }
                                        
                                        $sale_loi_id = $v_loi_sale->id;
                                        array_push($sale_loi_arr, $sale_loi_id);
                                    }
                                }
                        
                                $bcommissionamount_loi = DB::table('listing')->where('bstatuslist','LOI')->where('olagent','!=','')->where('commission_payable','Upon Closing')->select('bcommissionamount','id')->get();
                                if(count($bcommissionamount_loi) > 0){
                                    foreach($bcommissionamount_loi as $k_comm_loi=>$v_comm_loi){
                                        if($v_comm_loi->bcommissionamount != null){
                                            $sum_comm_loi += $v_comm_loi->bcommissionamount;
                                        }
                                        $comm_loi_id = $v_comm_loi->id;
                                        array_push($comm_loi_arr, $comm_loi_id);
                                    }
                                }
                                                                
                                $termination_fee = DB::table('listing')->where('bstatuslist','Cancelled')->where('olagent','!=','')->select('id','date_on_fee','amount_fee')->get();
                                if(count($termination_fee) > 0 ){
                                    foreach($termination_fee as $k_term_fee=>$v_term_fee){
                                        if($v_term_fee->amount_fee != ""){
                                            $amount_fee_term = explode(',',$v_term_fee->amount_fee);
                                            $v_term_fee_id = $v_term_fee->id;
                                            array_push($v_term_fee_arr, $v_term_fee_id);
                                        }
                                        if($v_term_fee->date_on_fee != ""){
                                            $datepay_term = explode(',',$v_term_fee->date_on_fee);
                                            if($datepay_term[0] != ""){
                                                $i=0;
                                                foreach($datepay_term as $datePay){
                                                    if (strtotime($datePay) > strtotime($current)) {
                                                        $dateTopay .= $datePay[$i].",";
                                                        $total_datepay_term += $amount_fee_term[$i];
                                                    } 
                                                    $i++;
                                                }    
                                            }
                                            
                                        }
                                    }
                                }
                                $sold_not_funded = DB::table('listing')->where('bstatuslist','Sold')->where('olagent','!=','')->select('id','date_on_fee','amount_fee')->get();
                                if(count($sold_not_funded) > 0 ){
                                    foreach($sold_not_funded as $k_sold=>$v_sold){
                                        if($v_sold->amount_fee != ""){
                                            $amount_fee_sold = explode(',',$v_sold->amount_fee);
                                        }
                                        if($v_sold->date_on_fee != ""){
                                            $datepay_sold = explode(',',$v_sold->date_on_fee);
                                            if($datepay_sold[0] != ""){
                                                $j=0;
                                                foreach($datepay_sold as $datePaySold){
                                                    if (strtotime($datePaySold) > strtotime($current)) {
                                                        $dateTopay_sold .= $datePaySold[$j].",";
                                                        $total_datepay_sold += $amount_fee_sold[$j];
                                                    } 
                                                    $j++;
                                                }    
                                            }
                                        }
                                        $v_sold_id = $v_sold->id;
                                        array_push($v_sold_arr, $v_sold_id);
                                    }
                                }
                        
                                $current30 =date('Y-m-d');
                                $upto30 = date('Y-m-d', strtotime("+30 days"));
                                // $uponclosing30 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current30." AND '$upto30') AND commission_payable = 'Upon Closing' AND 'olagent'!=".$user_id." order by bclosingdate desc"));
                                $uponclosing30 = Listing::where('olagent','!=','')->where('commission_payable','Upon Closing')->select('bcommissionamount')->whereBetween('bclosingdate',[$current30,$upto30])->get();
                                if(count($uponclosing30) > 0){
                                    foreach($uponclosing30 as $k3=>$v3){
                                        if($v3->bcommissionamount != null){
                                            $closing30 += $v3->bcommissionamount;
                                        } else {
                                            $closing30 = 0;
                                        }
                                        
                                    }
                                }
                                                            
                                                            
                                $current60 = date('Y-m-d', strtotime("+30 days"));
                                $upto60 = date('Y-m-d', strtotime("+60 days"));
                                // $uponclosing60 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current60." AND '$upto60') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                                $uponclosing60 = Listing::where('olagent','!=','')->where('commission_payable','Upon Closing')->select('bcommissionamount')->whereBetween('bclosingdate',[$current60,$upto60])->get();
                                if(count($uponclosing60) > 0){
                                    foreach($uponclosing60 as $k6=>$v6){
                                        if($v6->bcommissionamount != null){
                                            $closing60 += $v6->bcommissionamount;
                                        } else {
                                            $closing60 = 0;
                                        }
                                        
                                    }
                                }
                                    
                                $current90 = date('Y-m-d', strtotime("+61 days"));
                                $upto90 = date('Y-m-d', strtotime("+91 days"));
                                // $uponclosing90 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) BETWEEN ".$current90." AND '$upto90') AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                                $uponclosing90 = Listing::where('olagent','!=','')->where('commission_payable','Upon Closing')->select('bcommissionamount')->whereBetween('bclosingdate',[$current90,$upto90])->get();
                                if(count($uponclosing90) > 0){
                                    foreach($uponclosing90 as $k9=>$v9){
                                        if($v9->bcommissionamount != null){
                                            $closing90 += $v9->bcommissionamount;
                                        } else {
                                            $closing90 = 0;
                                        }
                                        
                                    }
                                }
                                    
                                $current91 = date('Y-m-d', strtotime("+91 days"));
                                // $uponclosing91 = DB::select(DB::raw("SELECT sum(bcommissionamount) as total FROM listing WHERE (DATE(bclosingdate) > ".$current91.") AND commission_payable = 'Upon Closing' AND 'olagent'=".$user_id." order by bclosingdate desc"));
                                $uponclosing91 = Listing::where('olagent','!=','')->where('commission_payable','Upon Closing')->select('bcommissionamount')->where('bclosingdate','>',$current91)->get();
                                if(count($uponclosing91) > 0){
                                    foreach($uponclosing91 as $k91=>$v91){
                                        if($v91->total != null){
                                            $closing91 += $v91->total;
                                        } else {
                                            $closing91 = 0;
                                        }
                                        
                                    }
                                }
                                                        
                                return response()->json([
                                    'message'=>'success',
                                    'code'=>'200',
                                    'data'=>[
                                        ['status'=>'In Contract Selling Price' ,'count'=>$sum_sale , 'operations'=> $incont_id_arr],
                                        ['status'=>'In Contract Commission' ,'count'=>$sum_comm , 'operations'=>$comm_id_arr ],
                                        ['status'=>'In LOI Selling Price' ,'count'=>$sum_sale_loi , 'operations'=> $sale_loi_arr],
                                        ['status'=>'In LOI Commission' ,'count'=>$sum_comm_loi , 'operations'=> $comm_loi_arr],
                                        ['status'=>'Termination/Cancellation Fees Pending' ,'count'=>'$'.$total_datepay_term , 'operations'=>$v_term_fee_arr ],
                                        ['status'=>'Sold but Not Funded' ,'count'=>'$'.$total_datepay_sold , 'operations'=> $v_sold_arr],
                                        ['status'=>'0-30 Days' ,'count'=>$closing30 , 'operations'=> ''],
                                        ['status'=>'31-60 Days' ,'count'=>$closing60 , 'operations'=>'' ],
                                        ['status'=>'61-90 Days' ,'count'=>$closing90 , 'operations'=>'' ],
                                        ['status'=>'Over 91 Days' ,'count'=>$closing91 , 'operations'=> ''],
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

    public function get_agent_listing(Request $request){
        try{
            $list_id = explode(',',$request->id);
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            } 
            $user = Auth::user();
            $userId= $user->id;
            $agent = '';
            // if($user->hasRole('Agent')) {
                $data = Listing::select('listing.id as list_id','listing.bname','listing.bcity','listing.bstate','listing.bsaleprice','listing.selling_price','listing.bcommissionamount','listing.olagent','listing.bstatuslist','listing.bexpiredate','listing.daysonmarket','agents.id as agent_id','agents.firstname','agents.lastname','listing.bcanceldate','listing.buyers_id','listing.amount_fee','buyer_users.firstname as b_fname', 'buyer_users.lastname as b_lname')
                ->leftJoin('agents','agents.id','=', 'listing.olagent')
                ->leftJoin('buyer_users','buyer_users.id','=','listing.buyers_id')
                ->whereIn('listing.id', $list_id)
                ->paginate($per_page);
                return response()->json(['message'=>'success','code'=>'200','data'=>$data]);
            // } 
            // if($user->hasRole('Agent Manager')) {
            //     $data = Listing::select('listing.id as list_id','listing.bname','listing.bcity','listing.bstate','listing.bsaleprice','listing.selling_price','listing.bcommissionamount','listing.olagent','listing.bstatuslist','listing.bexpiredate','listing.daysonmarket','agents.id as agent_id','agents.firstname','agents.lastname')
            //     ->leftJoin('agents','agents.id','=', 'listing.olagent')
            //     ->whereIn('listing.id', $list_id)
            //     ->paginate($per_page);
            //     return response()->json(['message'=>'success','code'=>'200','data'=>$data]);
            // } 
            // if($user->hasRole('Super User')){
            //     $data = Listing::select('listing.id as list_id','listing.bname','listing.bcity','listing.bstate','listing.bsaleprice','listing.selling_price','listing.bcommissionamount','listing.olagent','listing.bstatuslist','listing.bexpiredate','listing.daysonmarket','agents.id as agent_id','agents.firstname','agents.lastname')
            //     ->leftJoin('agents','agents.id','=', 'listing.olagent')
            //     ->whereIn('listing.id', $list_id)
            //     ->paginate($per_page);
            //     return response()->json(['message'=>'success','code'=>'200','data'=>$data]);
            // }
            
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
}
