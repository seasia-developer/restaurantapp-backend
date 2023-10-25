<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Buyers;
use App\Models\CaBuyers;
use App\Models\Listing;
use App\Models\Ca;
use App\Models\BuyerUserDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BuyerDocumentMail;
use App\Mail\BuyerBuildAdvertisingMail;

use App\Models\BuyerUserHot;
use App\Models\User;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportBuyerNameEmail;
use App\Exports\ExportBuyerNotes;
use App\Exports\ExportHotReport;

use App\Models\ExcelExportReport;

use Illuminate\Support\Str;

use App\Models\BuyerUserNotes;

class BuyerController extends Controller
{
    
    public function all(Request $request)
    {
        try {
            $model = new Buyers(); 
            $prefix = 'buyers';
            $select_column = ['id', 'firstname', 'lastname', 'email', 'phoneno', 'buyerlegalname'];

            $buyers = redisGetAllRows($model, $select_column, $prefix);

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyers]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        try {
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            }

            $buyers_listing = Buyers::select('id', 'willlistingno', 'email')->get();
            $buyer_listing_ids = [];
            $buyer_listing_emails = [];
            foreach ($buyers_listing as $buyer) {
                if(isset($buyer->willlistingno)) {
                    $buyer_listing_ids[] = $buyer->willlistingno;
                    $buyer_listing_emails[] = $buyer->email;
                }
            }
            $listings = Listing::select('id', 'bstatuslist', 'buyer_email')->whereIn('id', $buyer_listing_ids)->whereIn('bstatuslist', ['Available', 'Coming Soon', 'LOI', 'In Contract'])->get();
            $listing_ids = [];
            $listing_loi_bemail = [];
            $listing_contract_bemail = [];
            foreach ($listings as $list) {
                $listing_ids[] = $list->id;

                if($list->bstatuslist == 'LOI'){;
                    if (in_array($list->buyer_email, $buyer_listing_emails))
                    {
                        $listing_loi_bemail[] = $list->buyer_email;
                    }
                }

                if($list->bstatuslist == 'In Contract'){
                    if (in_array($list->buyer_email, $buyer_listing_emails))
                    {
                        $listing_contract_bemail[] = $list->buyer_email;
                    }
                }

            }


            /* $get_hot_buyers = BuyerUserHot::get();
            $hot_buyer_ids = [];
            $hot_agent_ids = [];
            foreach ($get_hot_buyers as $hot_buyer) {
                $hot_buyer_ids[] = $hot_buyer->buyer_id;
                $hot_agent_ids[] = $hot_buyer->agent_id;
            } */

            //$query = Buyers::select('id', 'firstname', 'lastname', 'email', 'phoneno', 'buyerlegalname', 'created_at');

            //$query = Buyers::select('id', 'firstname', 'lastname', 'email', 'phoneno', 'willlistingno', 'agentid', 'created_at')->whereIn('willlistingno', $listing_ids)->orWhereNull('willlistingno')->

            $query = Buyers::select('id', 'firstname', 'lastname', 'email', 'phoneno', 'willlistingno', 'agentid', 'created_at')->
                with(['agent' => function($agent){
                    $agent->select('id', 'firstname', 'lastname');
                }])->
                with(['listing' => function($listing){
                    $listing->select('id', 'bname', 'bstatuslist', 'bamount', 'olagent', 'buyer_email')->whereIn('bstatuslist', ['Available', 'Coming Soon', 'LOI', 'In Contract']);
                }])->
                with(['hot' => function($hot){
                    $hot->select('id', 'buyer_id', 'agent_id');
                }])->
                with(['ca' => function($ca){
                    $ca->select('id', 'buyer_id', 'listing_id', 'agentid', 'nosigned');
                }]);

            $user = Auth::user();

            if($user->hasRole('Agent')) {
                $query->where('agentid', auth_agent_id());
            }

            if(!empty($request->agent) && $request->agent != 'All') {
                $query->where('agentid', $request->agent);
            }

            if($request->filled('stage')) {

                if($request->stage == 'New Buyers' || $request->stage == 'In Contract' || $request->stage == 'LOI'){
                    $query->whereHas('listing', function ($listing_filter)  use ($request, $listing_ids, $listing_loi_bemail, $listing_contract_bemail){
                        if($request->stage == 'New Buyers') {
                            $listing_filter->whereIn('bstatuslist', ['Available', 'Coming Soon', 'LOI', 'In Contract']);
                        }
                        if($request->stage == 'In Contract') {
                            $listing_filter->where('bstatuslist', 'In Contract')->whereIn('id', $listing_ids)->whereIn('buyer_email', $listing_contract_bemail);
                        }
                        if($request->stage == 'LOI') {
                            $listing_filter->where('bstatuslist', 'LOI')->whereIn('id', $listing_ids)->whereIn('buyer_email', $listing_loi_bemail);
                        } 
                    });
                }

                if($request->stage == 'Hot Buyers') {
                    $query->whereHas('hot');
                }

                if($request->stage == 'Signed CAs') {
                    $query->whereHas('ca', function ($ca_filter)  use ($request){
                        $ca_filter->where('nosigned', '>', '0');
                    });
                }

                if($request->stage == 'LOI') {
                    $query->whereIn('email', $listing_loi_bemail);
                } 

                if($request->stage == 'In Contract') {
                    $query->whereIn('email', $listing_contract_bemail);
                } 

                if($request->stage == 'New Buyers') {
                    $query->orWhereNull('willlistingno');
                }

            } else {
                $query->whereNull('willlistingno')->orWhereHas('listing', function ($listing_filter){
                    $listing_filter->whereIn('bstatuslist', ['Available', 'Coming Soon', 'LOI', 'In Contract']);
                });
            }

            // else {
            //     $listing->whereIn('bstatuslist', ['Available', 'Coming Soon', 'LOI', 'In Contract']);
            // }

            if($request->filled('email')) {
                $query->where('email', $request->email);
            }

            if($request->filled('firstname')) {
                $query->where('firstname', $request->firstname);
            }

            if($request->filled('lastname')) {
                $query->where('lastname', $request->lastname);
            }

            if($request->filled('phoneno')) {
                $query->where('phoneno', $request->phoneno);
            }

            

            $buyers = $query->orderBy('id', 'DESC')->paginate($per_page);

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyers]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'firstname' => 'required',
                'lastname' => 'required',
                //'email' => 'required|email:rfc,dns|unique:buyer_users|unique:users',
                'email' => 'required|email:rfc,dns',
                'agentid' => 'required',
                'lookingstates' => 'required',
                'willlistingno' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            if (User::where('email', $input['email'])->exists()) {
                $user = User::where('email', '=', $input['email'])->first();
            } else {
                // Create User for Login
                $input_2['email'] = $input['email'];
                $input_2['password'] = Hash::make(Str::random(8));
                $input_2['username'] = $input['firstname'];
                $input_2['firstname'] = $input['firstname'];
                $input_2['lastname'] = $input['lastname'];
                $input_2['type'] = '4';
                $model_2 = new User();
                $prefix_2 = 'user';
                $delete_from_redis_2 = null;
                $user = redisCreate($model_2, $input_2, $prefix_2, $delete_from_redis_2);
                $user->assignRole(['Buyer']);
            }

            $input['user_id'] = $user->id;

            if(!empty($input['willlistingno'])){
                $willlistingno = $input['willlistingno'];
                $willlistingno_array = explode(',', $willlistingno);
                $willlistingno_array_trimmed = array_map('trim', $willlistingno_array);

                foreach ($willlistingno_array_trimmed as $key => $listingno) {
                    $input['willlistingno'] = $listingno;
                    $model = new Buyers();
                    $prefix = 'buyer';
                    $delete_from_redis = 'buyers';
                    $buyer[$key] = redisCreate($model, $input, $prefix, $delete_from_redis);
                }
            }

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyer]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $model = new Buyers();
            $prefix = 'buyer';
            $select_column = null;

            $buyer = redisFind($model, $select_column, $id, $prefix);

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyer]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            if (isset($request->password) && empty($request->password)) {
                $input = $request->except(['password']);
            }
            else {
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
            }   

            $buyer = Buyers::select('id', 'user_id')->find($id);

            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email:rfc,dns',
                // 'email' => [
                //     'required', 'email:rfc,dns',
                //     Rule::unique('buyer_users')->ignore($id),
                // ],
                'lookingstates' => 'required',
                'staddress' => 'required',
                'city' => 'required',
                'postalcode' => 'required',
                'phoneno' => 'required',
                'cellno' => 'required',
            ];
        
            if(isset($request->password) && !empty($request->password)){
                $rules = array_merge($rules, ['password' => 'required|min:8|string']);
            }
            
            $validator = Validator::make($input, $rules);

            /* $validator = Validator::make($input, [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => [
                    'required', 'email:rfc,dns',
                    //Rule::unique('buyer_users')->ignore($buyer->id),
                ],
                'lookingstates' => 'required',
            ]); */
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            // user table
            if(isset($request->password) && !empty($request->password)){
                $input_2['password'] = $input['password'];
            }
            $input_2['email'] = $input['email'];
            $input_2['type'] = '4';
            $input_2['username'] = $input['firstname'];
            $input_2['firstname'] = $input['firstname'];
            $input_2['lastname'] = $input['lastname'];

            if(isset($buyer)){
                $buyer_user_id = $buyer->user_id;
            } else {
                $buyer_user_id = null;
            }
            $model_2 = new User();
            $prefix_2 = 'user';
            $delete_from_redis_2 = null;
            $input_match_2 = ['id'   => $buyer_user_id];
            $user = redisUpdateOrCreate($model_2, $input_match_2, $input_2, $prefix_2, $delete_from_redis_2);
            $user->assignRole(['Buyer']);


            if(isset($buyer)){
                $buyer_list = Buyers::where('user_id', $buyer->user_id)->get();

                foreach ($buyer_list as $get_buyer) {
                    $model = new Buyers();
                    $prefix = 'buyer';
                    $delete_from_redis = 'buyers';
                    $buyer_update = redisUpdate($model, $input, $get_buyer->id, $prefix, $delete_from_redis);

                }
            }
            
            // $model = new Buyers();
            // $prefix = 'buyer_'.$id;
            // $delete_from_redis = 'buyers';
            // $column_name = 'listing_id';

            // $buyer_update = redisUpdateForRetrieve($model, $input, $id, $prefix, $delete_from_redis, $column_name);



            /* if(isset($request->password) && !empty($request->password)){
                $input_2['password'] = $input['password'];
            }
            $input_2['email'] = $input['email'];
            $input_2['username'] = $input['firstname'];
            $input_2['type'] = '4';
            $model_2 = new User();
            $prefix_2 = 'user';
            $delete_from_redis_2 = null;
            $user = redisCreate($model_2, $input_2, $prefix_2, $delete_from_redis_2);
            $user->assignRole(['Buyer']); */

            return response()->json(['message'=>'success','code'=>'200','data'=>'Buyer Updated Successfully']);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }


    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            if(!empty($id)){
                $id_array = explode(',', $id);
                foreach ($id_array as $buyer_id) {
                    $model = new Buyers();
                    $prefix = 'buyer';
                    $delete_from_redis = 'buyers';
                    $buyer = redisDelete($model, $buyer_id, $prefix, $delete_from_redis);
                }
            }
            return response()->json(['message'=>'success','code'=>'200','data'=>'Buyer deleted successfully']);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    //CA's Submitted tab

    public function ca_submitted(Request $request, $id)
    {
        try {
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            }

            $query = CaBuyers::select('id', 'buyer_id', 'listing_id', 'lastviewdate', 'nosigned')->where('buyer_id', $id)
            ->with(['listing' => function($listing) {
                $listing->select('id', 'bname');
            }]);

            $ca_submissions = $query->paginate($per_page);

            return response()->json(['message'=>'success','code'=>'200','data'=>$ca_submissions]);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }


    public function ca_print(Request $request, $id, $listing_id)
    {
        try {
            $listing = Listing::select('bstate', 'burldes')->find($listing_id);
            $buyer = Buyers::select('firstname', 'lastname', 'email')->find($id);
            
            if(isset($listing->bstate)) {
                $ca =  Ca::select('catext')->where('code', $listing->bstate)->first();
            }
            
            $ca_buyer = CaBuyers::select('lastviewdate')->where('buyer_id', $id)->where('listing_id', $listing_id)->orderBy('lastviewdate', 'DESC')->first();
            $ca_print['listing_id'] = $listing_id;
            $ca_print['date_time'] = isset($ca_buyer->lastviewdate)?$ca_buyer->lastviewdate:'';
            $buyer_firstname = isset($buyer->firstname)?$buyer->firstname:'';
            $buyer_lastname = isset($buyer->lastname)?$buyer->lastname:'';
            $ca_print['your_full_name'] = $buyer_firstname.' '.$buyer_lastname;
            $ca_print['buyer_email'] = isset($buyer->email)?$buyer->email:'';
            $ca_print['description'] = isset($listing->burldes)?$listing->burldes:'';
            $ca_print['title'] = 'BUYER CONFIDENTIALITY AGREEMENT';
            $ca_print['text'] = isset($ca->catext)?$ca->catext:'';

            return response()->json(['message'=>'success','code'=>'200','data'=> $ca_print ]);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    //End CA's Submitted tab

    //Documents tab

    public function documents_upload(Request $request, $id)
    {
        try {
            $request->validate([
                'doc_file' => 'required',
                'doc_file.*' => 'file|max:20480',
                //'doc_file.*' => 'mimes:pdf,xlsx,xls,doc,docx,csv,ppt,pptx,ods,odt,odp,jpg,png,gif|max:20480',
            ]);
          
            $files = [];
            if ($request->file('doc_file')){
                foreach($request->file('doc_file') as $key => $file)
                {
                    $fileSize[] = $file->getSize();
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $new_filename = $filename.'_'.time();
                    $new_filenameWithExtension = $new_filename.'.'.$extension;
                    $file->move('storage/buyer/docs', $new_filenameWithExtension);
                    $files[]['nameWithExtension'] = $new_filenameWithExtension;
                }
            }

            $input = $request->except(['doc_file']);

            foreach ($files as $key => $file) {
                $input['doc_file'] = $file['nameWithExtension'];
                $input['doc_title'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file['nameWithExtension']);
                $input['buyer_id'] = $id;
                $input['doc_agent'] = Auth::id();
                $input['agent_type'] = Auth::user()->type;

                BuyerUserDocument::create($input);
            }

            return response()->json(['message'=>'success','code'=>'200','data'=>'You have successfully upload file.']);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }

    public function document_list(Request $request, $id)
    {
        try {
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            }

            

            $docs = BuyerUserDocument::with(['agent' => function($agent){
                $agent->select('id', 'username');
            }])->
            with(['apa' => function($apa){
                $apa->select('id', 'listingId');
            }])->
            with(['amendment' => function($amendment){
                $amendment->select('id', 'listing_id');
            }])->
            with(['terminate' => function($terminate){
                $terminate->select('id', 'listing_id');
            }])->
            with(['confidentiality' => function($confidentiality){
                $confidentiality->select('id', 'listing_id');
            }])->
            where('buyer_id', $id)->latest()->paginate($per_page);

            return response()->json(['message'=>'success','code'=>'200','data'=>$docs]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function delete_document($id)
    {
        try {

            BuyerUserDocument::findOrFail($id)->delete();
            
            return response()->json(['message'=>'success','code'=>'200','data'=>'Document deleted successfully']);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function document_email(Request $request, $id)
    {
        try {
            $request->validate([
                'email_address' => 'required',
                'email_draft' => 'required',
                'file_to_attach' => 'required',
            ]);

            //only response email function implement later
            $input = $request->all();

            $file_to_attach = explode(",",$input['file_to_attach']);

            $mailData = [
                'subject_name' => 'Buyer document',
                'text_body' => $input['email_draft'],
                //'attach_file' => $input['file_to_attach'],
                'attach_file' => $file_to_attach,
            ];

            $recipient = $input['email_address'];

            if(validEmail($recipient)){
                Mail::to($recipient)->queue(new BuyerDocumentMail($mailData));
            }
            
            return response()->json(['message'=>'success','code'=>'200','data'=>$input]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }

    //End Documents tab


    //Make-Hot tab

    public function make_hot(Request $request, $id)
    {
        try {
            //$input = $request->except(['id']);

            //$id = isset($request->id)?$request->id:null;

            $input = $request->all();

            $validator = Validator::make($input, [
                'agent_id' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }


            $model = new BuyerUserHot();
            $prefix = 'buyer_user_hot_'.$id.'_'.$request->agent_id;
            $delete_from_redis = null;

            $input_match = [
                'buyer_id'   => $id,
                'agent_id'   => $request->agent_id
            ];

            $buyer_user_hot = redisUpdateOrCreateForRetrieve($model, $input_match, $input, $prefix, $delete_from_redis);

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyer_user_hot]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function make_not_hot(Request $request, $id)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'agent_id' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            $model = new BuyerUserHot();
            $prefix = 'buyer_user_hot_'.$id.'_'.$request->agent_id;
            $delete_from_redis = null;

            $where = [
                ['buyer_id', '=', $id],
                ['agent_id', '=', $request->agent_id]
            ];

            $buyer_user_not_hot = redisRetrieveDelete($model, $where, $prefix, $delete_from_redis);

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyer_user_not_hot]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function make_hot_show(Request $request, $id, $agent_id)
    {
        try {
            $model = new BuyerUserHot();
            $select_column = ['id', 'buyer_id', 'agent_id'];
            $prefix = 'buyer_user_hot_'.$id.'_'.$agent_id;

            $where = [
                ['buyer_id', '=', $id],
                ['agent_id', '=', $request->agent_id]
            ];

            $buyer = redisRetrieveFind($model, $select_column, $where, $prefix);

            return response()->json(['message'=>'success','code'=>'200','data'=>$buyer]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function make_hot_list($id)
    {
        try {
            $model = new BuyerUserHot();
            $prefix = 'buyer_hotlist_'.$id;
            $select_column = ['id', 'buyer_id', 'agent_id', 'created_at'];
            $where = [
                ['buyer_id', '=', $id]
            ];
            $orWhere = null;
            $hot_list = redisGetConditionRows($model, $select_column, $prefix, $where, $orWhere);

            return response()->json(['message'=>'success','code'=>'200','data'=>$hot_list]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function make_hot_list_update(Request $request, $id)
    {
        try {

            $input = $request->all();

            $agents = explode(",",$input['agent']);

            $model = new BuyerUserHot();
            $prefix = 'buyer_user_hot_'.$id.'_*';
            $delete_from_redis = 'buyer_hotlist_'.$id;

            $where = [
                ['buyer_id', '=', $id]
            ];

            $buyer_user_not_hot = redisRetrieveDelete($model, $where, $prefix, $delete_from_redis);

            foreach($agents as $agent_id){
                if(isset($agent_id) && !empty($agent_id)){
                    $prefix_2 = 'buyer_user_hot_'.$id.'_'.$agent_id;
                    $delete_from_redis_2 = null;
        
                    $input_match = [
                        'buyer_id'   => $id,
                        'agent_id'   => $agent_id
                    ];

                    $buyer_user_hot = redisUpdateOrCreateForRetrieve($model, $input_match, $input, $prefix_2, $delete_from_redis_2);
                }
            }
            
            return response()->json(['message'=>'success','code'=>'200','data'=>'Updated Successfully']);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    //End Make-Hot tab


    public function name_email_export(Request $request)
    {
        try {

            $current_time = date('F-d-Y_H_i_s');

            $input = $request->all();

            // Begin excel_export_history
            $excel_export_history = ExcelExportReport::create([
                'agent_id'=> Auth::id(),
                'agent_type'=> Auth::user()->type, 
                'date_time'=> date('m-d-Y h:i:s'), 
                'agreement_id'=> null,
                'type'=> 'Buyers',
                'ipaddress'=> $_SERVER['REMOTE_ADDR'],
                'description'=> 'Buyer Users Download',
            ]);
            // End excel_export_history

            return Excel::download(new ExportBuyerNameEmail($input), 'Buyer-Users-'.$current_time.'.xlsx');

            //return response()->json(['message'=>'success','code'=>'200','data'=>'Export Successfully']);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function buyer_notes_export(Request $request)
    {
        try {
            $current_time = date('F-d-Y_H_i_s');

            $input = $request->all();

            // Begin excel_export_history
            $excel_export_history = ExcelExportReport::create([
                'agent_id'=> Auth::id(),
                'agent_type'=> Auth::user()->type, 
                'date_time'=> date('m-d-Y h:i:s'), 
                'agreement_id'=> null,
                'type'=> 'BuyerNotes',
                'ipaddress'=> $_SERVER['REMOTE_ADDR'],
                'description'=> 'Buyer Notes Download',
            ]);
            // End excel_export_history

            return Excel::download(new ExportBuyerNotes($input), 'Buyer-Notes-'.$current_time.'.xlsx');

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }


    public function hot_report_export(Request $request)
    {
        try {
            $current_time = date('F-d-Y_H_i_s');

            return Excel::download(new ExportHotReport, 'Hot-Report-'.$current_time.'.xlsx');

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function build_advertising_email(Request $request, $id) {

        try {
            $input = $request->all();

            $buyer = Buyers::select('id', 'email', 'firstname', 'lastname', 'phoneno')->find($id);
            
            $mailData = [
                'subject_name' => $input['subject'],
                'text_body' => $input['bdetailedad'],
            ];

            if(validEmail($buyer->email)){
                Mail::to($buyer->email)->queue(new BuyerBuildAdvertisingMail($mailData));
            }

            if(!empty($input['listing_id'])){
                $listing_id = trim($input['listing_id'], '"');
                $listing_id_array = explode(',', $listing_id);
                $listing_id_array_trimmed = array_map('trim', $listing_id_array);

                foreach ($listing_id_array_trimmed as $get_listing) {
                    $data['listing_id'] = $get_listing;
                    $data['buyer_id'] = $buyer->id;
                    $data['agent_id'] = Auth::id();

                    $listing = Listing::select('id', 'bname', 'olagent', 'buyer_email')->find($get_listing);
                    $data['business_name'] = $listing->bname;

                    $data['related_to'] = 'email';
                    $data['email_to_seller'] = 'N';
                    $data['email_to_agent'] = 'N';
                    $data['email_to_buyer'] = 'N';
                    $data['note_text']  = 
                    "Template Option:" . "1" . 
                    " Buyer Name: " . 
                    $buyer->firstname.' '.$buyer->lastname . 
                    "Email: ". $buyer->email . 
                    "Telephone: ". $buyer->phoneno . 
                    "Message:";

                    $model = new BuyerUserNotes();
                    $prefix = 'buyer_user_note';
                    $delete_from_redis = null;
                    $note = redisCreate($model, $data, $prefix, $delete_from_redis);

                }
            }

            
            
            return response()->json(['message'=>'success','code'=>'200','data'=>'New member created successfully!']);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }

    
    public function email_format(Request $request)
    {
        try {
            $emailTextArray = array( 
            1 =>'<table align="center" border="0" cellpadding="0" cellspacing="0" class="c-width email-container" role="presentation" style="margin: auto; width:100% !important; max-width:700px; background: url(https://www.wesellrestaurants.com/public/images/email-bg.png); background-size: cover; font-family: arial;" width="700">
            <tbody>
            <tr>
            <td style="padding: 20px; vertical-align: middle;" class="header-column">
            <div style="border-radius: 50%; background: #fff; width: 220px; height: 220px; text-align: center;" class="header-logo">
            <a href="https://www.wesellrestaurants.com/"><img src="https://www.wesellrestaurants.com/public/images/e-logo.png" alt="logo" style="max-width: 150px; margin-top: 60px;"></a>
            </div>
            </td>
            <td style="width: 428px; padding: 20px; vertical-align: middle; font-family: sans-serif;" class="header-column">
            <h2 style="border-bottom: 2px solid #000; padding-bottom: 15px; margin: 0; color: #e70033; font-size: 22px; font-weight: 600;">
            Our Name Says It All
            </h2>
            <p style="font-style: italic; color: #333; font-weight: 600; font-size: 22px; margin: 15px 0px 0px; text-align: right;">
            We Sell Restaurants
            </p>
            </td>
            </tr>
            <tr>
            <td style="padding: 20px;" colspan="2">
            <div style="background: #fff; padding: 20px;">
            <h2 style="color: #000; font-weight: bold; font-size: 28px; margin: 0 0 15px; text-align: center;">Quickly & Easily Get Information on Restaurants for Sale!</h2>
            <p style="color: #e70033; font-size: 20px; font-style: italic; margin: 0 0 8px; font-weight: 600; text-align: left;">Ist</p>
            <p style="margin: 0 0 8px; text-align: left;"><a href="https://www.wesellrestaurants.com/sign-in.php" style="color: #333; font-size: 14px; text-decoration: underline; display: inline-block; margin-left: 15px; font-weight: 600; text-align: left;">Register Online at this link</a></p>
            <p style="color: #e70033; font-size: 20px; font-style: italic; margin: 0 0 8px; font-weight: 600; text-align: left;">2nd</p>
            <p style="margin: 0 0 8px; color: #333; font-size: 14px; font-weight: 600; margin-left: 15px; text-align: left;">Return to Your Email & Confirm Your Account</p>
            <p style="color: #e70033; font-size: 20px; font-style: italic; margin: 0 0 8px; font-weight: 600; text-align: left;">3rd</p>
            <p style="margin: 0 0 15px; color: #333; font-size: 14px; font-weight: 600; margin-left: 15px; text-align: left;">Browse Opportunities at  <a href="https://www.wesellrestaurants.com" style="color: #333; font-size: 14px; text-decoration: underline; display: inline-block; font-weight: 600;">wesellrestaurants.com</a></p>
            <p style="color: #e70033; font-size: 20px; font-style: italic; margin: 0 0 15px; font-weight: 600; text-align: left;">Simply Click</p>
            <ul style="margin: 0 15px 15px; padding: 0 15px; text-align: left;">
            <li style="list-style: disc; font-size: 14px; color: #333; margin: 0 0 8px;">To "View Complete Listings"</li>
            <li style="list-style: disc; font-size: 14px; color: #333; margin: 0 0 8px;">Acknowledge Confidentiality </li>
            <li style="list-style: disc; font-size: 14px; color: #333; margin: 0 0 8px;">Get Complete Packages</li>
            </ul>
            <p style="margin: 0 0 8px; color: #333; font-size: 14px;  margin-left: 8px; text-align: left;">* Note: some listings may require proof of funds.</p>
            <div style="text-align: center">
            <a href="https://www.wesellrestaurants.com/listings.php" style="background: #e70033; padding: 11px 15px; color: #fff; font-size: 35px; font-weight: bold; text-transform: uppercase; text-decoration: none; margin: 15px 0px; display: inline-block;">Restaurants for sale</a>
            <p style="color: #000; font-weight: bold; font-size: 25px; margin: 0 0 0px;"><span style="color: #e70033;">Questions?</span> Call: 1-888-814 8226</p>

            </div>
            </div>
            </td>
            </tr>
            <tr>
            <td colspan="2">
            <a href="#"><img src="https://www.wesellrestaurants.com/public/images/footer-text.png" alt="footer" style="max-width: 100%; width: 100%;" /></a>
            </td>
            </tr>

            </tbody>
            </table>' ,
                                
            2 => "<p>Thank you for your interest in this listing.  Due to the highly profitable nature of the restaurant and/or the franchise requirements, we must pre-qualify your ability to purchase before providing the name and address.  We will also need a signed confidentiality agreement.  You may register as a buyer on our website and electronically sign the confidentiality agreement.</p>
                <p>For prequalification we will need one of the following:  1)  Copy of a bank statement showing sufficient liquidity to purchase OR 2) Copy of brokerage account showing sufficient liquidity to purchase OR 3)  Letter from your banker or brokerage firm direct to us stating you have sufficient funds on hand to qualify. </p>
                <p>The financial requirements are specified in the listing.  Please black out your account number before sending to our secure fax at 1-888-668-8625.</p>
                <!--p><a href=\"http://v2.staging.wesellrestaurants.com/sign-up.php\">Need help with registration? Click our video to watch the easy process</a> .</p-->
                <p>If you have any questions, contact We Sell Restaurants at 1-888-814-8226</p>",

            3 => "<p>Thank you for your interest in this listing for lease.  There is no key money on the transaction but the landlord will require a business plan, menu, security deposit and credit check.  To view the location, log onto our website as a buyer and electronically sign the confidentiality agreement for the location and photos.  If you like the location contact us to set up a showing.</p>
                <!--p><a href=\"http://v2.staging.wesellrestaurants.com/sign-up.php\">Need help with registration? Click our video to watch the easy process</a> .</p-->
                <p>If you have any questions, contact We Sell Restaurants at 1-888-814-8226</p>",

            4 =>'<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                <meta content="width=device-width, initial-scale=1.0" name="viewport"/> <!-- Forcing initial-scale shouldnt be necessary -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                <meta name="x-apple-disable-message-reformatting">	<!-- Disable auto-scale in iOS 10 Mail entirely -->
                <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    
                <!-- Web Font / @font-face : BEGIN -->
                <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->
    
                <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
                <!--[if mso]>
                <style>
                * {
                font-family: sans-serif !important;
                }
                </style>
                <![endif]-->
    
                <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
                <!--[if !mso]><!-->
                <!-- insert web font reference, eg: <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css"> -->
                <!--<![endif]-->
    
                <!-- Web Font / @font-face : END -->
    
                <!-- CSS Reset -->
                <style>
    
                /* What it does: Remove spaces around the email design added by some email clients. */
                /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                html,
                body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
                }
    
                /* What it does: Stops email clients resizing small text. */
                * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                }
    
                /* What it does: Centers email on Android 4.4 */
                div[style*="margin: 16px 0"] {
                margin:0 !important;
                }
    
                /* What it does: Stops Outlook from adding extra spacing to tables. */
                table,
                td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
                }
    
                /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
                table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
                }
                table table table {
                table-layout: auto;
                }
    
                /* What it does: Uses a better rendering method when resizing images in IE. */
                img {
                -ms-interpolation-mode:bicubic;
                }
    
                /* What it does: A work-around for email clients meddling in triggered links. */
                *[x-apple-data-detectors],	/* iOS */
                .x-gmail-data-detectors, 	/* Gmail */
                .x-gmail-data-detectors *,
                .aBn {
                border-bottom: 0 !important;
                cursor: default !important;
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                }
    
                /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
                .a6S {
                display: none !important;
                opacity: 0.01 !important;
                }
                /* If the above doesnt work, add a .g-img class to any image in question. */
                img.g-img + div {
                display:none !important;
                }
    
                /* What it does: Prevents underlining the button text in Windows 10 */
                .button-link {
                text-decoration: none !important;
                }
    
                /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
                /* Create one of these media queries for each additional viewport size youd like to fix */
                /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */
                @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
                .email-container {
                min-width: 375px !important;
                }
                }
    
                </style>
    
                <!-- Progressive Enhancements -->
                <style>
    
                /* What it does: Hover styles for buttons */
                .button-td,
                .button-a {
                transition: all 100ms ease-in;
                }
                .button-td:hover,
                .button-a:hover {
                background: #555555 !important;
                border-color: #555555 !important;
                }
                td{line-height:21px;}
    
                /* Media Queries */
                @media screen and (min-width: 701px) {
                .wd340{max-width:340px;}
                .wd220{max-width:220px;}
                .wd470{max-width:470px;}
                }
                @media screen and (max-width: 700px) {
    
                .email-container {
                width: 100% !important;
                margin: auto !important;
                }
    
                /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
                .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
                }
    
                /* What it does: Forces table cells into full-width rows. */
                .stack-column,
                .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
                }
                /* And center justify these ones. */
                .stack-column-center {
                text-align: center !important;
                }
    
                /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
                .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
                }
                table.center-on-narrow {
                display: inline-block !important;
                }
    
                /* What it does: Adjust typography on small screens to improve readability */
                .email-container p {
                font-size: 17px !important;
                line-height: 22px !important;
                }
    
                .wd100{width:100% !important; max-width:100% !important;}
                .wd220 tbody > tr > td{padding-top:15px !important;}
                .wd340 img{height:auto !important;}
                }
    
                </style>
    
                <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
                <!--[if gte mso 9]>
                <xml>
                <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
                </xml>
                <![endif]-->
    
                <!--[if gte mso 9]>
                <style type="text/css">
                span{display:table-cell;}
                </style>
                <![endif]-->
    
                </head>
    
                <body width="100%" bgcolor="#fff" style="margin: 0; mso-line-height-rule: exactly;">
                <center style="width: 100%; background: #fff; text-align: left;">
    
                <!-- Email Body : BEGIN -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="700" style="margin: auto; width:100% !important; max-width:700px;" class="c-width email-container">
    
                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                <td bgcolor="#ffffff" align="center">
                <a href="http://wesellrestaurants.com">
                
                <img src="https://www.wesellrestaurants.com/public/mailassets/logo.jpg" width="700" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 700px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; margin:auto;" class="g-img">
                
                </a>
                </td>
                </tr>
                <!-- Hero Image, Flush : END -->
    
                
    
    
                <tr>
                <td class="c-width" height="20"></td>
                </tr>
                <!-- 4 Even Columns : BEGIN -->
                <tr>
                <td bgcolor="#cfc9c9" align="center" style="padding: 0; background:#cfc9c9;" valign="middle">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                <!-- Column : BEGIN -->
                <td class="stack-column-center" width="15%" style="padding: 5px" style="width:15%;" >
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
    
                    <td><img src="https://www.wesellrestaurants.com/public/mailassets/blog-img.jpg"></td>
    
    
                </tr>
                </table>
                </td>
                <!-- Column : END -->
                <!-- Column : BEGIN -->
                <td class="stack-column-center" width="85%" valign="middle" style="width:85%;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                
               
    
                </tr>
                </table>
                </td>
                <!-- Column : END -->
                </tr>
                </table>
                </td>
                </tr>
                <!-- 4 Even Columns : END -->
                <!-- 5 Even Columns : BEGIN -->
                <tr>
                <td bgcolor="#e80033" align="center" style="padding: 0; background:#e80033;" valign="middle">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                <!-- Column : BEGIN -->
                <td class="stack-column-center" width="15%" style="padding: 5px" >
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td width="25%" align="center" style="font-family: sans-serif; text-align:center;"> 
                    
                    //var
                    <a href="http://wesellrestaurants.com/category/Restaurants-for-Sale" style="color: #fff; text-decoration: none; font-size: 14px;  padding: 0 5px;">Buy a Restaurant</a>
                    
                    
                    </td>
                    <td width="25%" align="center" style="font-family: sans-serif; font-size: 14px;  padding: 0 5px; text-align:center;"><a href=" http://blog.wesellrestaurants.com/sell-your-restaurant-with-the-restaurant-brokers" style="color: #fff; text-decoration: none;  padding: 0 5px;">Sell a Restaurant</a></td>
                    <td width="25%" align="center" style="font-family: sans-serif; font-size: 14px;  padding: 0 5px; text-align:center;"><a href="https://app.guidantfinancial.com/Partner/Prequal/GetByName/we-sell-restaurants/?cid=701400000%E2%80%A6" style="color: #fff; text-decoration: none;">Get Funded</a></td>
                    <td width="25%" align="center" style="font-family: sans-serif; font-size: 14px;  padding: 0 5px; text-align:center;">
                    
                    //var
                    <a href="http://wesellrestaurants.com/category/Franchises-for-Sale" style="color: #fff; text-decoration: none;  padding: 0 5px;">Franchises for Sale</a>
                    
                    
                    </td>
                </tr>
                </table>
                </td>
                <!-- Column : END -->
                </tr>
                </table>
                </td>
                </tr>
                <!-- 5 Even Columns : END -->
    
                <!-- 6 Even Columns : BEGIN -->
                <tr>
                <td bgcolor="#fff" align="center" style="padding: 0;" valign="middle">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                <!-- Column : BEGIN -->
                <td class="stack-column-center" width="15%" style="padding: 0" >
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td>
                    
                   
                    <a href=" http://www.wsrfranchise.com/"><img class="c-width" src="https://www.wesellrestaurants.com/public/mailassets/footer-top.jpg" width="700" style="width:100% !important; max-width:700px;"></a>
                    
                    
                    </td>
                </tr>
                </table>
                </td>
                <!-- Column : END -->
                </tr>
                </table>
                </td>
                </tr>
                <!-- 6 Even Columns : END -->
    
                </table>
                <!-- Email Body : END -->
    
                </center>
                </body>
                </html>'
            );
            

             $data['bdetailedad'] = $emailTextArray[$request->emlformatOption];

            return response()->json(['message'=>'success','code'=>'200','data'=>$data]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function find_listing_status(Request $request)
    {
        try {
            $listings = Listing::select('id', 'bname', 'bstatuslist', 'olagent', 'bregion')->whereIn('id', explode(',', $request->id))->get();
            return response()->json(['message'=>'success','code'=>'200','data'=>$listings]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }


// Firstname'=>$row->firstname, 
// 'Lastname'=>$row->lastname,
// 'Email'=>$row->email,
// 'Contact Phone'=>ltrim($phone),
// 'Cell Phone'=>$row->cellno,
// 'Listing Number'=>$row->willlistingno,
// 'Copy to Agent'=>$agentName,
// 'State where they are looking to BUY a Restaurant?'=>$marketstr,
// 'How Did you Find Us?'=>$row->sourcehear,
// 'Date Created'=>$row->datecreated);

}
