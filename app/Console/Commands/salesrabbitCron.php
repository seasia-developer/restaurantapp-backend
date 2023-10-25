<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SellerData;
use App\Models\Sellerdatapage;
use App\Models\Agents;

class salesrabbitCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch sales rabbit data from sale rabbit site to ouyr db';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $agtmp = new AgentsMapper();
        $rstmp = new RestaurantMapper();
        $respagemp = new RestaurantPageMapper();
        $curl = curl_init();
        
        //$res = $respagemp->getPerPageRecord();
        
        $page_query = Sellerdatapage::select('*')->orderBy('id', 'DESC')->limit(1);
        //$result = $this->db_query("SELECT * FROM ".self::table." order by id desc limit 0,1");
		//$count = $this->db_getcount($result);
        $count=$page_query->count();
		if($count > 0){
            $rows = $page_query->get();
        }else{
        return 0;
        }
		return $rows;



        $page = '';
        if ($rows == 0) {
         
          $data = array(
            'page_num' =>1,
            'start_count' =>0,
            'total_count' =>1000,
		    'status' => 0,
        );
           $res = $db->db_insert(self::table, $data);
            return $db->db_insert_id();
	    

          $page = 1;
        } else {
          if ($res->status == 0) {
            $page = $res->page_num + 1;
            $start_count = $res->total_count;
            $page_id = $respagemp->saverestaurantCount($page, $start_count);
            $page = $res->page_num + 1;
          } else {
            die("END");
          }
        }
        //
        if ($page != '') {
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.salesrabbit.com/leads?perPage=1000&page='.$page.'&sortBy=dateCreated&order=asc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer 7ca4339a237b49cce717a21515bce4edff59bda0b26bf35c9a9dfb49662c831ea6a7d64437c5579cb625881e6ff86026bc7b0369262ee683612a072a76c8939d'
            ),
          ));
        
          $response = curl_exec($curl);
          curl_close($curl);
          //echo "<pre>";
          $final_res = json_decode($response);
          //echo '<pre>';
          //echo count($final_res->data);
          if (count($final_res->data) == 1000) {
            echo "ifff";
          } else {
            $respagemp->perPageUpdateStatus($page_id);
            echo "updated";
          }
          $i = 0;
        // print_r($final_res->data);die;
          foreach ($final_res->data as $value) {
            $value->status = str_replace(' ', '', $value->status);
            
            if ($value->status == "ContactMade") {
              $value->status = "contactmade";
            }else if ($value->status == "Contact Made") {
              $value->status = "contactmade";
            }
            if ($value->status == "SellerCallback") {
              $value->status = "sellercallback";
            }else if ($value->status == "Seller Callback") {
              $value->status = "sellercallback";
            }
            if ($value->status == "Appointment") {
              $value->status = "appointment";
            }
        
            if ($value->status == "NewLead") {
              $value->status = "new";
            }else if ($value->status == "New Lead") {
              $value->status = "new";
            }
            if ($value->status == "FollowUp") {
              $value->status = "followup";
            }else if ($value->status == "Follow Up") {
              $value->status = "followup";
            }
            if ($value->status == "Converted") {
              $value->status = "converted";
            }
            if ($value->status == "LeftPackage") {
              $value->status = "leftpackage";
            }else if ($value->status == "Left Package") {
              $value->status = "leftpackage";
            }
             if (!empty($value->userName)) {
            //  $user = explode(" ", $value->userName);
            
                $username_trim=trim($value->userName);
                $username = preg_replace('/\s\s+/', ' ', $username_trim);
                $agentid = $agtmp->getAgentdetailByName($username);
            }
            
        
            if ($agentid != 0) {
              $timestamp = strtotime($value->statusModified);
              $new_date = date("Y-m-d", $timestamp);
              $timestam = strtotime($value->dateCreated);
              $created = date("Y-m-d", $timestam);
              $data = array(
                "restaurantname" => $value->businessName,
                "owner" => $value->customFields->contactName,
                "agentid" => $agentid,
                "phone" => $value->phonePrimary,
                "email" => $value->email,
                "address" => $value->street1,
                "city" => $value->city,
                "state" => $value->state,
                "zip" => $value->zip,
                "rstatus" => $value->status,
                "note" => $value->notes,
                "status_date" => $new_date,
                "status_rab" => 1,
                "cdate" => $created
              );
             $rstmp->salesRabbitSave($data);
              // echo '<pre>';
              // print_r($data);
              // die;
            }
          }
         
        //echo '</pre><br>';
        }else{
          echo "kkhtammmmmmmmmm";
        }
        
        
    }
}
