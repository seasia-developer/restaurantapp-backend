<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;
use App\Models\User;
use App\Models\Royal;
use App\Models\ActivityLogs;
use App\Models\AgentsDocument;
// use App\Models\AgentDetails;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AgentController extends Controller
{

    public function index(Request $request)
    {
        try {
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            }

            $query = Agents::select('id', 'firstname', 'lastname', 'username', 'zipcode', 'status', 'placement', 'isTypeAO');

            /* if(isset($request->agent) && !empty($request->agent)){
                $query->where('id', $request->agent);
            } */

            if($request->filled('agents_and_offices')) {
                if($request->agents_and_offices == 'Active Agents') {
                    $query->where('isTypeAO', 'A')->where('status', '1');
                }

                if($request->agents_and_offices == 'Inactive Agents') {
                    $query->where('isTypeAO', 'A')->where('status', '0');
                }

                if($request->agents_and_offices == 'Active Offices') {
                    $query->where('isTypeAO', 'O')->where('status', '1');
                }

                if($request->agents_and_offices == 'Inactive Offices') {
                    $query->where('isTypeAO', 'O')->where('status', '0');
                }
            }

            $agents = $query->orderBy('id', 'DESC')->paginate($per_page);

            return response()->json(['message'=>'success','code'=>'200','data'=>$agents]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function store(Request $request) {
        try {

            $id = isset($request->id)?$request->id:null;

            if (isset($id) && isset($request->password) && empty($request->password)) {
                $input = $request->except(['id', 'royal', 'royality', 'marketing', 'password']);
            }
            else {
                $input = $request->except(['id', 'royal', 'royality', 'marketing']);
            }

            //$input_royal = $request->only(['royal']);

            $rules = [
                'title' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
            ];
        
            if(!isset($id)) {
                $rules = array_merge($rules, ['password' => 'required|min:8|string']);
                $rules = array_merge($rules, ['email' => 'required|email:rfc,dns|unique:agents|unique:users']);
            } else {
                $rules = array_merge($rules, [
                    'email' => [
                        'required', 'email:rfc,dns',
                        Rule::unique('agents')->ignore($id),
                    ]
                ]);
                if(isset($request->password) && !empty($request->password)){
                    $rules = array_merge($rules, ['password' => 'required|min:8|string']);
                }
            }

            if($request->hasFile('img')){  
                $rules = array_merge($rules, ['img' => 'image|nullable|max:5120']);
            }

            if($request->hasFile('map_img')){  
                $rules = array_merge($rules, ['img' => 'image|nullable|max:5120']);
            }
            

            $validator = Validator::make($input, $rules);

            /* $validator = Validator::make($input, [
                'title' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
                'password' => 'required|min:8|string',
                'email' => 'required|email:rfc,dns|unique:agents|unique:users',
            ]); */
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            //$input['img'] = null;
            if($img_file = $request->file('img')){
                $filenameWithExt = $img_file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $img_file->getClientOriginalExtension();
                $input['img'] = $filename.'_'.time().'.'.$extension;
                $img_file->move('storage/images/users', $input['img']);
                $input_2['img'] = $input['img'];
            }

            //$input['map_img'] = null;
            if($img_file_2 = $request->file('map_img')){
                $filenameWithExt_2 = $img_file_2->getClientOriginalName();
                $filename_2 = pathinfo($filenameWithExt_2, PATHINFO_FILENAME);
                $extension_2 = $img_file_2->getClientOriginalExtension();
                $input['map_img'] = $filename_2.'_'.time().'.'.$extension_2;
                $img_file_2->move('storage/images/map-images', $input['map_img']);
            }

            if(isset($request->password) && !empty($request->password)){
                $input['password'] = Hash::make($input['password']);
                $input_2['password'] = $input['password'];
            }
            
            //user table
            $input_2['email'] = $input['email'];
            $input_2['firstname'] = $input['firstname'];
            $input_2['lastname'] = $input['lastname'];
            $input_2['username'] = $input['username'];
            
            if($input['agent_level'] == '5') {
                $input_2['type'] = '5';
            }

            if($input['agent_level'] == '6') {
                $input_2['type'] = '6';
            }

            $agent_find = Agents::find($id);

            if(isset($agent_find)){
                $agent_user_id = $agent_find->user_id;
            } else {
                $agent_user_id = null;
            }
            
            $model_2 = new User();
            $prefix_2 = 'user';
            $delete_from_redis_2 = null;
            $select_column = null;

            $input_match_2 = ['id'   => $agent_user_id];
            $user = redisUpdateOrCreate($model_2, $input_match_2, $input_2, $prefix_2, $delete_from_redis_2);

            if($user->type == '5') {
                $user->assignRole(['Agent']);
            }

            if($user->type == '6') {
                $user->assignRole(['Agent Manager']);
            }
            //close user table

            $input['user_id'] = $user->id;

            $model = new Agents();
            $prefix = 'agent';
            $delete_from_redis = null;
            $input_match = ['id'   => $id];
            $agent = redisUpdateOrCreate($model, $input_match, $input, $prefix, $delete_from_redis);

            if($agent->isTypeAO == 'O'){
                Royal::where('office_id', $agent->id)->delete();
                foreach ($request->royal as $key => $value) {
                    $value['office_id'] = $agent->id;
                    $value['royality'] = $request->royality;
                    $value['marketing'] = $request->marketing;
                    Royal::create($value);
                }
            }

            return response()->json(['message'=>'success','code'=>'200','data'=>$agent]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $model = new Agents();
            $prefix = 'agent';
            $select_column = null;

            $agent = redisFind($model, $select_column, $id, $prefix);

            if($agent->isTypeAO == 'O'){
                $agent->office_royal = Royal::where('office_id', $agent->id)->get();
            }

            return response()->json(['message'=>'success','code'=>'200','data'=>$agent]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function update_status(Request $request, $id)
    {
        try {
            $input = $request->only(['status']);

            $validator = Validator::make($input, [
                'status' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            $model = new Agents();
            $prefix = 'agent';
            $delete_from_redis = ['office_agents', 'office_franchise'];
            $agent = redisUpdate($model, $input, $id, $prefix, $delete_from_redis);

            $model_2 = new User();
            $prefix_2 = 'user';
            $delete_from_redis_2 = null;
            $user = redisUpdate($model_2, $input, $agent->user_id, $prefix_2, $delete_from_redis_2);
            
            $type = 'Agent';

            $input_2 = [
                'agent_id' => $agent->id,
                'username' => $user->username,
                'status' => $user->status,
                'type' => $type 
            ];

            $model_3 = new ActivityLogs();
            $prefix_3 = 'activity_log_agent';
            $delete_from_redis_3 = null;
            $activity_log = redisCreate($model_3, $input_2, $prefix_3, $delete_from_redis_3);

            return response()->json(['message'=>'success','code'=>'200','data'=>$agent]);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }

    public function activity_logs(Request $request) {
        try {
            if(isset($request->per_page) && $request->per_page <= 25) {
                $per_page = $request->per_page;
            } else {
                $per_page = 10;
            }

            $query = ActivityLogs::select('id','agent_id', 'username', 'status', 'created_at')->whereNotNull('agent_id');

            if(isset($request->search) && !empty($request->search)){
                $searchFields = ['username', 'status'];
                $query->where(function($query) use($request, $searchFields){
                  $searchWildcard = '%' . $request->search . '%';
                  foreach($searchFields as $field){
                    $query->orWhere($field, 'LIKE', $searchWildcard);
                  }
                });
            }

            $activity_logs = $query->latest()->paginate($per_page);

            return response()->json(['message'=>'success','code'=>'200','data'=>$activity_logs]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function placement(Request $request, $id)
    {
        try {
                $validator = Validator::make($request->all(), [
                    'placement' => 'required',
                ]);
         
                if ($validator->fails()) {
                    return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
                }

                /* $checkSortOrder  = Agents::where('placement', $request->placement)->update([
                    'placement'=> null
                ]); */

                $agents  = Agents::where('id', $id)->update([
                    'placement' => $request->placement
                ]);

                return response()->json(['message'=>'success','code'=>'200','data'=>'Display Order Updated Successfully']);

            } catch (\Exception $e) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
            }
    }

    public function documents_upload(Request $request, $id)
    {
        try {
            $request->validate([
                'agent_document' => 'required',
                'agent_document.*' => 'mimes:pdf,xlsx,xls,csv,jpg,png,gif|max:10240',
            ]);
          
            $files = [];
            if ($request->file('agent_document')){
                foreach($request->file('agent_document') as $key => $file)
                {
                    $fileSize[] = $file->getSize();
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $new_filename = $filename.'_'.time();
                    $new_filenameWithExtension = $new_filename.'.'.$extension;
                    $file->move('storage/agent/docs', $new_filenameWithExtension);
                    $files[]['nameWithExtension'] = $new_filenameWithExtension;
                }
            }

            $input = $request->except(['agent_document']);

            foreach ($files as $key => $file) {
                $input['agent_document'] = $file['nameWithExtension'];
                $input['agentid'] = $id;
                $input['user_id'] = Auth::id();
                $input['user_type'] = Auth::user()->type;

                AgentsDocument::create($input);
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

            $docs = AgentsDocument::where('agentid', $id)->
            with(['user' => function($user){
                $user->select('id', 'username', 'firstname', 'lastname');
            }])->orderBy('id', 'DESC')->paginate($per_page);


            return response()->json(['message'=>'success','code'=>'200','data'=>$docs]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function delete_document($id)
    {
        try {

            AgentsDocument::findOrFail($id)->delete();
            
            return response()->json(['message'=>'success','code'=>'200','data'=>'Document deleted successfully']);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function all_agents_and_filter(Request $request){
        try {
            $query = Agents::select('id', 'firstname', 'lastname', 'username', 'email', 'agent_level', 'franchiseofficeid')->where('status', '1')->where('isTypeAO', 'A');

            if($request->filled('same_franchise_agent')) {

                $agent = Agents::select('franchiseofficeid')->find($request->same_franchise_agent);

                //dd($agent->franchiseofficeid);

                $franchises = explode(',', $agent->franchiseofficeid);

               // dd($franchise);

                $query->where(function($franchise_query) use($franchises) {
                    //dd($franchises);
                    foreach($franchises as $franchise) {
                        
                        //$franchise_query->orWhereIn('franchiseofficeid', $franchise);

                        $franchise_query->orWhereRaw('FIND_IN_SET("'.$franchise.'",franchiseofficeid)');
                    };
                });


                //$agent=Agents::select('id', 'firstname', 'lastname', 'username', 'email', 'agent_level')->find($request->same_franchise_agent);
                
                //$query->whereRaw('FIND_IN_SET("'.$request->same_franchise_agent.'",franchiseofficeid)');
            }

            // if($request->filled('manager_filter_for_agent')) {
            //     $query->whereIn('franchiseofficeid', '1');
            // }

            if($request->filled('agent_level')) {
                $query->where('agent_level', $request->agent_level);
            }

            $agents = $query->orderBy('id', 'DESC')->get();
            
            return response()->json(['message'=>'success','code'=>'200','data'=>$agents]);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    /* public function store(Request $request){
        try {
            $data = $request->all();
            $validator = $this->addValidations($data);
            if ($validator->fails()) {
                return response()->json(['message'=>'validation error','data'=>$validator->messages()]);
            }
            $password = Hash::make($data['password']);
            if ($file = $request->file('img')) {      
                $filename = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('storage/images/agent',$filename);           
                $data['img'] = $filename;
            }
            // $agents = Agents::create($data);
            $agents = new Agents();
            $agents->title = $data['title'];
            $agents->email = $data['email'];
            $agents->firstname = $data['firstname'];
            $agents->lastname = $data['lastname'];
            $agents->password = $password;
            $agents->img = $filename;
            $agents->username = $data['username'];
            $agents->wsr_pwd = isset($data['wsr_pwd']) ? $data['wsr_pwd'] : NULL;
            $agents->status = $data['status'];
            $agents->agent_level = $data['agent_level'];
            $agents->address = $data['address'];
            $agents->city = $data['city'];
            $agents->state = $data['state'];
            $agents->zipcode = $data['zipcode'];
            $agents->homephone = $data['homephone'];
            $agents->cellphone = $data['cellphone'];
            $agents->agentdes = $data['agentdes'];
            $agents->outlook_password = isset($data['outlook_password']) ? $data['outlook_password'] : NULL;
            $agents->OTP = isset($data['OTP']) ? $data['OTP'] : NULL;
            $agents->agentareas = $data['agentareas'];
            $agents->isTypeAO = isset($data['isTypeAO']) ? $data['isTypeAO']:NULL;
            $agents->save();
            $get_agentId = $agents->id;
            if($get_agentId){
                $agent_details = new AgentDetails();
                $agent_details->agent_id = $get_agentId;
                $agent_details->officephone = $data['officephone'];
                $agent_details->licenseno = $data['licenseno'];
                $agent_details->licensetype = $data['licensetype'];
                $agent_details->ssn = $data['ssn'];
                $agent_details->brokerpersent = $data['brokerpersent'];
                $agent_details->bonus = $data['bonus'];
                $agent_details->agreelevel = $data['agreelevel'];
                $agent_details->brokernotes = $data['brokernotes'];
                $agent_details->management = $data['management'];
                $agent_details->regionalmanager = $data['regionalmanager'];
                $agent_details->managedby = $data['managedby'];
                $agent_details->allzip = $data['allzip'];
                $agent_details->displayonsite = $data['displayonsite'];
                $agent_details->accmembermail = $data['accmembermail'];
                $agent_details->displayoffphone = $data['displayoffphone'];
                $agent_details->fullaccess = $data['fullaccess'];
                $agent_details->accesstostats = $data['accesstostats'];
                $agent_details->accessallcas = $data['accessallcas'];
                $agent_details->language = $data['language'];
                $agent_details->placement = $data['placement'];
                $agent_details->hotreportshow = isset($data['hotreportshow']) ? $data['hotreportshow']:NULL;
                // $agent_details->isTypeAO = isset($data['isTypeAO']) ? $data['isTypeAO']:NULL;
                $agent_details->ofclegalname = isset($data['ofclegalname']) ? $data['ofclegalname']:NULL;
                $agent_details->ofecounty = isset($data['ofecounty']) ? $data['ofecounty']:NULL;
                $agent_details->franchisename = isset($data['franchisename']) ? $data['franchisename']:NULL;
                $agent_details->fax =isset($data['fax']) ? $data['fax']:NULL;
                $agent_details->franchiseofficeid = isset($data['franchiseofficeid']) ? $data['franchiseofficeid']:NULL;
                $agent_details->pagetitle = isset($data['pagetitle']) ? $data['pagetitle']:NULL;
                $agent_details->officelatlong = isset($data['officelatlong']) ? $data['officelatlong']:NULL;
                $agent_details->extendphone = isset($data['extendphone']) ? $data['extendphone']:NULL;
                $agent_details->county = isset($data['county']) ? $data['county']:NULL;
                $agent_details->extendphone_two = isset($data['extendphone_two']) ? $data['extendphone_two']:NULL;
                $agent_details->save();
                // $model = new Agents();
                // $prefix = 'agents';
                // $delete_from_redis = 'agents';
                // $agent = redisUpdate($model, $data, $id, $prefix, $delete_from_redis);
                // return response()->json(['message'=>'success','code'=>'200','data'=>$agent]);
                return response()->json(['message'=>'success','code'=>'200','data'=>$data]);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        } 

    }
    
    public function show($id){
        try {
            $agent = Agents::select('*')->leftJoin('agent_details as ad', 'ad.agent_id', '=', 'agents.id')->where('agents.id','=',$id)->first();
            if(isset($agent)){
                return response()->json(['message'=>'success','code'=>'200','data'=>$agent]);
            } else {
                return response()->json(['message'=>'error','code'=>'500','data'=>'Agent not found.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    } 
    public function update($id, Request $request){
    try{
        $data = $request->all();
        $agents_data = Agents::find($id);
        $password = Hash::make($data['password']);
        $validator = $this->addValidations($data);
        if ($validator->fails()) {
            return response()->json(['message'=>'validation error','data'=>$validator->messages()]);
        }
        if(isset($agents_data)){
            if ($file = $request->file('img')) {      
                $filename = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('storage/images/agent', $filename);          
                $agents_data->img = $filename;
            }
            $agents_data->title = $data['title'];
            $agents_data->email = $data['email'];
            $agents_data->firstname = $data['firstname'];
            $agents_data->lastname = $data['lastname'];
            $agents_data->password = $password;
            $agents_data->username = $data['username'];
            $agents_data->wsr_pwd = isset($data['wsr_pwd']) ? $data['wsr_pwd'] : NULL;
            $agents_data->status = $data['status'];
            $agents_data->agent_level = $data['agent_level'];
            $agents_data->address = $data['address'];
            $agents_data->city = $data['city'];
            $agents_data->state = $data['state'];
            $agents_data->zipcode = $data['zipcode'];
            $agents_data->homephone = $data['homephone'];
            $agents_data->cellphone = $data['cellphone'];
            $agents_data->agentdes = $data['agentdes'];
            $agents_data->outlook_password = $data['outlook_password'];
            $agents_data->OTP = isset($data['OTP']) ? $data['OTP'] : NULL;
            $agents_data->agentareas = $data['agentareas'];
            $agents_data->isTypeAO = isset($data['isTypeAO']) ? $data['isTypeAO']:NULL;
            $agents_data->update();
            $agent_detail_id = $agents_data->id;
            if(isset($agent_detail_id)){
                $agent_detail_data = AgentDetails::where(['agent_id'=>$agent_detail_id])->first();
                $agent_detail_data->officephone = $data['officephone'];
                $agent_detail_data->licenseno = $data['licenseno'];
                $agent_detail_data->licensetype = $data['licensetype'];
                $agent_detail_data->ssn = $data['ssn'];
                $agent_detail_data->brokerpersent = $data['brokerpersent'];
                $agent_detail_data->bonus = $data['bonus'];
                $agent_detail_data->agreelevel = $data['agreelevel'];
                $agent_detail_data->brokernotes = $data['brokernotes'];
                $agent_detail_data->management = $data['management'];
                $agent_detail_data->regionalmanager = $data['regionalmanager'];
                $agent_detail_data->managedby = $data['managedby'];
                $agent_detail_data->allzip = $data['allzip'];
                $agent_detail_data->displayonsite = $data['displayonsite'];
                $agent_detail_data->accmembermail = $data['accmembermail'];
                $agent_detail_data->displayoffphone = $data['displayoffphone'];
                $agent_detail_data->fullaccess = $data['fullaccess'];
                $agent_detail_data->accesstostats = $data['accesstostats'];
                $agent_detail_data->accessallcas = $data['accessallcas'];
                $agent_detail_data->language = $data['language'];
                $agent_detail_data->placement = $data['placement'];
                $agent_detail_data->hotreportshow = isset($data['hotreportshow']) ? $data['hotreportshow']:NULL;
                $agent_detail_data->ofclegalname = isset($data['ofclegalname']) ? $data['ofclegalname']:NULL;
                $agent_detail_data->ofecounty = isset($data['ofecounty']) ? $data['ofecounty']:NULL;
                $agent_detail_data->franchisename = isset($data['franchisename']) ? $data['franchisename']:NULL;
                $agent_detail_data->fax =isset($data['fax']) ? $data['fax']:NULL;
                $agent_detail_data->franchiseofficeid = isset($data['franchiseofficeid']) ? $data['franchiseofficeid']:NULL;
                $agent_detail_data->pagetitle = isset($data['pagetitle']) ? $data['pagetitle']:NULL;
                $agent_detail_data->officelatlong = isset($data['officelatlong']) ? $data['officelatlong']:NULL;
                $agent_detail_data->extendphone = isset($data['extendphone']) ? $data['extendphone']:NULL;
                $agent_detail_data->county = isset($data['county']) ? $data['county']:NULL;
                $agent_detail_data->extendphone_two = isset($data['extendphone_two']) ? $data['extendphone_two']:NULL;
                
                $agent_detail_data->update();
            }
            return response()->json(['message'=>'success','code'=>'200','agents_data'=>$agents_data,'agent_detail_data'=>$agent_detail_data ]);
        } else {
            return response()->json(['message'=>'error','code'=>'302','data'=>'Agent not found.' ]);
        }
        
    } catch (\Exception $e) {
        return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
    }
    } 
    public function delete($id){
        try{
            $agent = Agents::findOrFail($id);
            if(isset($agent)){
                $agent_img = $agent->img;
                if (file_exists(('storage/images/agent/' . $agent_img))) {
                    unlink(('storage/images/agent/' . $agent_img));
                }
                if(isset($agent->id)){
                    $agent_detail = AgentDetails::where(['agent_id'=>$agent->id])->first();
                }
                $agent_detail->delete();
                $agent->delete();
                return response()->json(['message'=>'success', 'code'=> '200', 'data'=> 'Agent data deleted successfully.']);
            } else {
                return response()->json(['message'=>'error', 'data'=>'Agent not found.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }  
    public function addValidations(array $data){
        $rules = [
            'firstname'  => 'required',
            'lastname'  => 'required',
            'email' => 'required|email|unique:agents',
            'title' => 'required',
            'password' => 'required|min:3|max:7',
            // 'username'=> 'required|min:3|max:7',
        ];
        $messages = [
            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'Email already exists. Try another email.',
            'title.required' => 'Title is required',
            'password' => 'Password is required.',
            // 'username' => 'Username is required.'
        ];
        return validator($data, $rules, $messages);
    }    */                                                           
}
