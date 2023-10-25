<?php

namespace App\Http\Controllers\Api\Agent\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CaBuyers;
use App\Models\User;
use App\Models\Agents;

class BuyerConversionController extends Controller
{
    
    public function index(Request $request){
        try{
            $user = Auth::user();
            $agentId= $user->id;
            $current = date('Y-m-d');
            $current_year = date('Y');
            $reg_per = 0;
            $total_nosigned_ca = 0;
            $total_ca = 0;
            $ca_users_arr = array();
            $buyer_per = '0.00';

            $date_filter = $request->date;
            if($user->hasRole('Agent')) {
                if($date_filter != ''){
                    $resDate= explode('/', $date_filter);   
                    $agent_from = $resDate[0];
                    $agent_to = $resDate[1];
                    $buyer_users = Buyers::where('agentid',$agentId)->whereBetween('created_at',[$agent_from,$agent_to])->get();
                    $buyer_user_count = count($buyer_users);
                    $conversionRegister = Buyers::whereBetween('created_at',[$agent_from,$agent_to])->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                    $conversionRegister_count = count($conversionRegister);
                    if(count($buyer_users) > 0){
                        foreach($buyer_users as $b_val){
                            $ca_users = CaBuyers::where('agentid',$agentId)->where('id',$b_val['id'])->whereBetween('lastviewdate',[$agent_from,$agent_to])->get();
                            $total_ca += count($ca_users);
                            if(count($ca_users) > 0){
                                foreach($ca_users as $k_ca=>$v_ca){
                                    $total_nosigned_ca += ($v_ca['nosigned']);
                                }
                            }
                        }
                    }
                    
                    $total_buyer_users = Buyers::where('agentid',$agentId)->where('email','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                    $total_buyer_users_count = count($total_buyer_users);
                } else {
                    $buyer_users = Buyers::where('agentid',$agentId)->whereYear('created_at',$current_year)->get();
                    $buyer_user_count = count($buyer_users);
                    $conversionRegister = Buyers::whereYear('created_at',$current_year)->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                    $conversionRegister_count = count($conversionRegister);

                    if(count($buyer_users) > 0){
                        foreach($buyer_users as $b_val){
                            $ca_users = CaBuyers::where('agentid',$agentId)->where('id',$b_val['id'])->whereYear('lastviewdate',$current_year)->get();
                            $total_ca += count($ca_users);
                            if(count($ca_users) > 0){
                                foreach($ca_users as $k_ca=>$v_ca){
                                $total_nosigned_ca += ($v_ca['nosigned']);
                                }
                            }
                        }
                    }

                    $total_buyer_users = Buyers::where('agentid',$agentId)->where('email','!=','')->whereYear('created_at',$current_year)->get();
                    $total_buyer_users_count = count($total_buyer_users);
                }


                if(($buyer_user_count != '0') && ($conversionRegister_count != '0')){
                    $reg_per = ($buyer_user_count*100) / $conversionRegister_count;
                }

                if(($buyer_user_count != '0') && ($total_buyer_users_count != '0')){
                    $buyer_per = ($buyer_user_count*100) / $total_buyer_users_count;
                }

                return response()->json([
                    'message'=>'success',
                    'code'=>'200', 
                    'data'=>[
                        ['status'=>'New Buyers' , 'count'=>$buyer_user_count, 'operations'=> '' ],
                        ['status'=>'Conversion to Registration', 'count'=>$conversionRegister_count, 'operations'=> number_format($reg_per,2) .'%' ],
                        ['status'=>"Signed CA's for New Buyers", 'count'=>$total_ca, 'operations'=> number_format($buyer_per,2) .'%' ],
                        ['status'=>"Signed CA's ALL", 'count'=>$total_nosigned_ca, 'operations'=>''],
                    ]
                ]);
            }
            
            if($user->hasRole('Agent Manager')) {
                if((isset($request->id)) && ($request->id != '')){
                    if($date_filter != ''){
                        $resDate= explode('/', $date_filter);   
                        $agent_from = $resDate[0];
                        $agent_to = $resDate[1];
                        $buyer_users = Buyers::where('agentid',$request->id)->whereBetween('created_at',[$agent_from,$agent_to])->get();
                        $buyer_user_count = count($buyer_users);
                        $conversionRegister = Buyers::whereBetween('created_at',[$agent_from,$agent_to])->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                        $conversionRegister_count = count($conversionRegister);
                        if(count($buyer_users) > 0){
                            foreach($buyer_users as $b_val){
                                $ca_users = CaBuyers::where('agentid',$request->id)->where('id',$b_val['id'])->whereBetween('lastviewdate',[$agent_from,$agent_to])->get();
                                $total_ca += count($ca_users);
                                if(count($ca_users) > 0){
                                    foreach($ca_users as $k_ca=>$v_ca){
                                        $total_nosigned_ca += ($v_ca['nosigned']);
                                    }
                                }
                            }
                        }
                        
                        $total_buyer_users = Buyers::where('agentid',$request->id)->where('email','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                        $total_buyer_users_count = count($total_buyer_users);
                    } else {
                        $buyer_users = Buyers::where('agentid',$request->id)->whereYear('created_at',$current_year)->get();
                        $buyer_user_count = count($buyer_users);
                        $conversionRegister = Buyers::whereYear('created_at',$current_year)->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                        $conversionRegister_count = count($conversionRegister);

                        if(count($buyer_users) > 0){
                            foreach($buyer_users as $b_val){
                                $ca_users = CaBuyers::where('agentid',$request->id)->where('id',$b_val['id'])->whereYear('lastviewdate',$current_year)->get();
                                $total_ca += count($ca_users);
                                if(count($ca_users) > 0){
                                    foreach($ca_users as $k_ca=>$v_ca){
                                    $total_nosigned_ca += ($v_ca['nosigned']);
                                    }
                                }
                            }
                        }

                        $total_buyer_users = Buyers::where('agentid',$request->id)->where('email','!=','')->whereYear('created_at',$current_year)->get();
                        $total_buyer_users_count = count($total_buyer_users);
                    }


                    if(($buyer_user_count != '0') && ($conversionRegister_count != '0')){
                        $buyer_per = ($buyer_user_count*100) / $conversionRegister_count;
                    }

                    if(($buyer_user_count != '0') && ($total_buyer_users_count != '0')){
                        $buyer_per = ($buyer_user_count*100) / $total_buyer_users_count;
                    }

                    return response()->json([
                        'message'=>'success',
                        'code'=>'200', 
                        'data'=>[
                            ['status'=>'New Buyers' , 'count'=>$buyer_user_count, 'operations'=> '' ],
                            ['status'=>'Conversion to Registration', 'count'=>$conversionRegister_count, 'operations'=> number_format($reg_per,2) .'%' ],
                            ['status'=>"Signed CA's for New Buyers", 'count'=>$total_ca, 'operations'=> number_format($buyer_per,2) .'%' ],
                            ['status'=>"Signed CA's ALL", 'count'=>$total_nosigned_ca, 'operations'=>''],
                        ]
                    ]);
                } else {
                    if($date_filter != ''){
                        $resDate= explode('/', $date_filter);   
                        $agent_from = $resDate[0];
                        $agent_to = $resDate[1];
                        $buyer_users = Buyers::where('agentid','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                        $buyer_user_count = count($buyer_users);
                        $conversionRegister = Buyers::whereBetween('created_at',[$agent_from,$agent_to])->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                        $conversionRegister_count = count($conversionRegister);
                        if(count($buyer_users) > 0){
                            foreach($buyer_users as $b_val){
                                $ca_users = CaBuyers::where('agentid','!=','')->where('id',$b_val['id'])->whereBetween('lastviewdate',[$agent_from,$agent_to])->get();
                                $total_ca += count($ca_users);
                                if(count($ca_users) > 0){
                                    foreach($ca_users as $k_ca=>$v_ca){
                                        $total_nosigned_ca += ($v_ca['nosigned']);
                                    }
                                }
                            }
                        }
                        
                        $total_buyer_users = Buyers::where('agentid','!=','')->where('email','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                        $total_buyer_users_count = count($total_buyer_users);
                    } else {
                        $buyer_users = Buyers::where('agentid','!=','')->whereYear('created_at',$current_year)->get();
                        $buyer_user_count = count($buyer_users);
                        $conversionRegister = Buyers::whereYear('created_at',$current_year)->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                        $conversionRegister_count = count($conversionRegister);

                        if(count($buyer_users) > 0){
                            foreach($buyer_users as $b_val){
                                $ca_users = CaBuyers::where('agentid','!=','')->where('id',$b_val['id'])->whereYear('lastviewdate',$current_year)->get();
                                $total_ca += count($ca_users);
                                if(count($ca_users) > 0){
                                    foreach($ca_users as $k_ca=>$v_ca){
                                    $total_nosigned_ca += ($v_ca['nosigned']);
                                    }
                                }
                            }
                        }

                        $total_buyer_users = Buyers::where('agentid','!=','')->where('email','!=','')->whereYear('created_at',$current_year)->get();
                        $total_buyer_users_count = count($total_buyer_users);
                    }


                    if(($buyer_user_count != '0') && ($conversionRegister_count != '0')){
                        $buyer_per = ($buyer_user_count*100) / $conversionRegister_count;
                    }

                    if(($buyer_user_count != '0') && ($total_buyer_users_count != '0')){
                        $buyer_per = ($buyer_user_count*100) / $total_buyer_users_count;
                    }

                    return response()->json([
                        'message'=>'success',
                        'code'=>'200', 
                        'data'=>[
                            ['status'=>'New Buyers' , 'count'=>$buyer_user_count, 'operations'=> '' ],
                            ['status'=>'Conversion to Registration', 'count'=>$conversionRegister_count, 'operations'=> number_format($reg_per,2) .'%' ],
                            ['status'=>"Signed CA's for New Buyers", 'count'=>$total_ca, 'operations'=> number_format($buyer_per,2) .'%' ],
                            ['status'=>"Signed CA's ALL", 'count'=>$total_nosigned_ca, 'operations'=>''],
                        ]
                    ]);
                }
            }

            if($user->hasRole('Super User')){
                $user_type = 0;
                if((isset($request->id)) && ($request->id != '')){
                    $user_id = $request->id;
                    // $user = User::where('id',$user_id)->first();
                    $result = Agents::select('id','firstname','lastname','user_id')->where('id',$request->id)->where('status',1)->where('isTypeAO','A')->first();
                    if(isset($result->user_id)){
                        $user = User::where('id',$result->user_id)->first();
                        if(isset($user->type)){
                            $user_type = $user->type;
                        }
                    }
                    
                    
                    if($user_type == '6') {
                        if((isset($request->agent_id)) && ($request->agent_id != '')){
                            if($date_filter != ''){
                                $resDate= explode('/', $date_filter);   
                                $agent_from = $resDate[0];
                                $agent_to = $resDate[1];
                                $buyer_users = Buyers::where('agentid',$request->agent_id)->whereBetween('created_at',[$agent_from,$agent_to])->get();
                                $buyer_user_count = count($buyer_users);
                                $conversionRegister = Buyers::whereBetween('created_at',[$agent_from,$agent_to])->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                                $conversionRegister_count = count($conversionRegister);
                                if(count($buyer_users) > 0){
                                    foreach($buyer_users as $b_val){
                                        $ca_users = CaBuyers::where('agentid',$request->agent_id)->where('id',$b_val['id'])->whereBetween('lastviewdate',[$agent_from,$agent_to])->get();
                                        $total_ca += count($ca_users);
                                        if(count($ca_users) > 0){
                                            foreach($ca_users as $k_ca=>$v_ca){
                                                $total_nosigned_ca += ($v_ca['nosigned']);
                                            }
                                        }
                                    }
                                }
                                
                                $total_buyer_users = Buyers::where('agentid',$request->agent_id)->where('email','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                                $total_buyer_users_count = count($total_buyer_users);
                            } else {
                                $buyer_users = Buyers::where('agentid',$request->agent_id)->whereYear('created_at',$current_year)->get();
                                $buyer_user_count = count($buyer_users);
                                $conversionRegister = Buyers::whereYear('created_at',$current_year)->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                                $conversionRegister_count = count($conversionRegister);
            
                                if(count($buyer_users) > 0){
                                    foreach($buyer_users as $b_val){
                                        $ca_users = CaBuyers::where('agentid',$request->agent_id)->where('id',$b_val['id'])->whereYear('lastviewdate',$current_year)->get();
                                        $total_ca += count($ca_users);
                                        if(count($ca_users) > 0){
                                            foreach($ca_users as $k_ca=>$v_ca){
                                            $total_nosigned_ca += ($v_ca['nosigned']);
                                            }
                                        }
                                    }
                                }
            
                                $total_buyer_users = Buyers::where('agentid',$request->agent_id)->where('email','!=','')->whereYear('created_at',$current_year)->get();
                                $total_buyer_users_count = count($total_buyer_users);
                            }
            
            
                            if(($buyer_user_count != '0') && ($conversionRegister_count != '0')){
                                $buyer_per = ($buyer_user_count*100) / $conversionRegister_count;
                            }
            
                            if(($buyer_user_count != '0') && ($total_buyer_users_count != '0')){
                                $buyer_per = ($buyer_user_count*100) / $total_buyer_users_count;
                            }
            
                            return response()->json([
                                'message'=>'success',
                                'code'=>'200', 
                                'data'=>[
                                    ['status'=>'New Buyers' , 'count'=>$buyer_user_count, 'operations'=> '' ],
                                    ['status'=>'Conversion to Registration', 'count'=>$conversionRegister_count, 'operations'=> number_format($reg_per,2) .'%' ],
                                    ['status'=>"Signed CA's for New Buyers", 'count'=>$total_ca, 'operations'=> number_format($buyer_per,2) .'%' ],
                                    ['status'=>"Signed CA's ALL", 'count'=>$total_nosigned_ca, 'operations'=>''],
                                ]
                            ]);
                        } else {
                            if($date_filter != ''){
                                $resDate= explode('/', $date_filter);   
                                $agent_from = $resDate[0];
                                $agent_to = $resDate[1];
                                $buyer_users = Buyers::where('agentid','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                                $buyer_user_count = count($buyer_users);
                                $conversionRegister = Buyers::whereBetween('created_at',[$agent_from,$agent_to])->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                                $conversionRegister_count = count($conversionRegister);
                                if(count($buyer_users) > 0){
                                    foreach($buyer_users as $b_val){
                                        $ca_users = CaBuyers::where('agentid','!=','')->where('id',$b_val['id'])->whereBetween('lastviewdate',[$agent_from,$agent_to])->get();
                                        $total_ca += count($ca_users);
                                        if(count($ca_users) > 0){
                                            foreach($ca_users as $k_ca=>$v_ca){
                                                $total_nosigned_ca += ($v_ca['nosigned']);
                                            }
                                        }
                                    }
                                }
                                
                                $total_buyer_users = Buyers::where('agentid','!=','')->where('email','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                                $total_buyer_users_count = count($total_buyer_users);
                            } else {
                                $buyer_users = Buyers::where('agentid','!=','')->whereYear('created_at',$current_year)->get();
                                $buyer_user_count = count($buyer_users);
                                $conversionRegister = Buyers::whereYear('created_at',$current_year)->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                                $conversionRegister_count = count($conversionRegister);
            
                                if(count($buyer_users) > 0){
                                    foreach($buyer_users as $b_val){
                                        $ca_users = CaBuyers::where('agentid','!=','')->where('id',$b_val['id'])->whereYear('lastviewdate',$current_year)->get();
                                        $total_ca += count($ca_users);
                                        if(count($ca_users) > 0){
                                            foreach($ca_users as $k_ca=>$v_ca){
                                            $total_nosigned_ca += ($v_ca['nosigned']);
                                            }
                                        }
                                    }
                                }
            
                                $total_buyer_users = Buyers::where('agentid','!=','')->where('email','!=','')->whereYear('created_at',$current_year)->get();
                                $total_buyer_users_count = count($total_buyer_users);
                            }
            
            
                            if(($buyer_user_count != '0') && ($conversionRegister_count != '0')){
                                $buyer_per = ($buyer_user_count*100) / $conversionRegister_count;
                            }
            
                            if(($buyer_user_count != '0') && ($total_buyer_users_count != '0')){
                                $buyer_per = ($buyer_user_count*100) / $total_buyer_users_count;
                            }
            
                            return response()->json([
                                'message'=>'success',
                                'code'=>'200', 
                                'data'=>[
                                    ['status'=>'New Buyers' , 'count'=>$buyer_user_count, 'operations'=> '' ],
                                    ['status'=>'Conversion to Registration', 'count'=>$conversionRegister_count, 'operations'=> number_format($reg_per,2) .'%' ],
                                    ['status'=>"Signed CA's for New Buyers", 'count'=>$total_ca, 'operations'=> number_format($buyer_per,2) .'%' ],
                                    ['status'=>"Signed CA's ALL", 'count'=>$total_nosigned_ca, 'operations'=>''],
                                ]
                            ]);
                        }
                    }
                    
                    if($user_type == '5') {
                        if($date_filter != ''){
                            $resDate= explode('/', $date_filter);   
                            $agent_from = $resDate[0];
                            $agent_to = $resDate[1];
                            $buyer_users = Buyers::where('agentid','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                            $buyer_user_count = count($buyer_users);
                            $conversionRegister = Buyers::whereBetween('created_at',[$agent_from,$agent_to])->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                            $conversionRegister_count = count($conversionRegister);
                            if(count($buyer_users) > 0){
                                foreach($buyer_users as $b_val){
                                    $ca_users = CaBuyers::where('agentid','!=','')->where('id',$b_val['id'])->whereBetween('lastviewdate',[$agent_from,$agent_to])->get();
                                    $total_ca += count($ca_users);
                                    if(count($ca_users) > 0){
                                        foreach($ca_users as $k_ca=>$v_ca){
                                            $total_nosigned_ca += ($v_ca['nosigned']);
                                        }
                                    }
                                }
                            }
                            
                            $total_buyer_users = Buyers::where('agentid','!=','')->where('email','!=','')->whereBetween('created_at',[$agent_from,$agent_to])->get();
                            $total_buyer_users_count = count($total_buyer_users);
                        } else {
                            $buyer_users = Buyers::where('agentid','!=','')->whereYear('created_at',$current_year)->get();
                            $buyer_user_count = count($buyer_users);
                            $conversionRegister = Buyers::whereYear('created_at',$current_year)->where(['activate'=> '1', 'activate'=> 'Y'])->get();
                            $conversionRegister_count = count($conversionRegister);
        
                            if(count($buyer_users) > 0){
                                foreach($buyer_users as $b_val){
                                    $ca_users = CaBuyers::where('agentid','!=','')->where('id',$b_val['id'])->whereYear('lastviewdate',$current_year)->get();
                                    $total_ca += count($ca_users);
                                    if(count($ca_users) > 0){
                                        foreach($ca_users as $k_ca=>$v_ca){
                                        $total_nosigned_ca += ($v_ca['nosigned']);
                                        }
                                    }
                                }
                            }
        
                            $total_buyer_users = Buyers::where('agentid','!=','')->where('email','!=','')->whereYear('created_at',$current_year)->get();
                            $total_buyer_users_count = count($total_buyer_users);
                        }
        
        
                        if(($buyer_user_count != '0') && ($conversionRegister_count != '0')){
                            $buyer_per = ($buyer_user_count*100) / $conversionRegister_count;
                        }
        
                        if(($buyer_user_count != '0') && ($total_buyer_users_count != '0')){
                            $buyer_per = ($buyer_user_count*100) / $total_buyer_users_count;
                        }
        
                        return response()->json([
                            'message'=>'success',
                            'code'=>'200', 
                            'data'=>[
                                ['status'=>'New Buyers' , 'count'=>$buyer_user_count, 'operations'=> '' ],
                                ['status'=>'Conversion to Registration', 'count'=>$conversionRegister_count, 'operations'=> number_format($reg_per,2) .'%' ],
                                ['status'=>"Signed CA's for New Buyers", 'count'=>$total_ca, 'operations'=> number_format($buyer_per,2) .'%' ],
                                ['status'=>"Signed CA's ALL", 'count'=>$total_nosigned_ca, 'operations'=>''],
                            ]
                        ]);
                    }
                }
            }
        } catch(\Exception $e){
            return response()->json(['message'=>'error', 'code'=>'302', 'data'=> $e->getMessage() ]);
        }
    }
}
