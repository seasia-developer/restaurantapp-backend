<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class MyAccountController extends Controller
{
    public function show(Request $request)
    {
        try{
            // $user = User::select('id','email', 'firstname', 'lastname', 'type', 'des', 'img')->where('id', Auth::id())
            // ->with(['agent' => function($agent) {
            //     $agent->select('id', 'user_id', 'firstname', 'lastname');
            // }])
            // ->first();

            $user = Auth::user();

            if($user->hasRole('Super User') && isset($request->agent) && !empty($request->agent)) {
                $agent = Agents::select('id', 'user_id')->firstWhere('id', $request->agent);
                $uid = $agent->user_id;
            }
            elseif($user->hasRole('Super User') && isset($request->admin) && !empty($request->admin)){
                $admin =  User::find($request->admin);
                $uid = $admin->id;
            }
            else {
                $uid = Auth::id();
            }

            //$uid = Auth::id();

            $user = User::select('id','email', 'firstname', 'lastname', 'type', 'des', 'img')->where('id', $uid)->first();

            return response()->json(['message'=>'success','code'=>'200','data'=>$user]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    /* public function update(Request $request)
    {
        try {
            if(isset($request->type)) {
                return response()->json(['message'=>'error','code'=>'302','data'=>'You cannot change user type.']);
            }

            if (isset($request->password) && empty($request->password) || trim($request->password) == '') {
                $input = $request->except(['password']);
            }
            else {
                $input = $request->all();
            }

            $user = Auth::user();

            if($user->hasRole('Super User') && isset($request->agent) && !empty($request->agent)) {
                $agent = Agents::select('id', 'user_id')->firstWhere('id', $request->agent);
                $uid = $agent->user_id;
            } else {
                $uid = Auth::id();
            }

            //$uid = Auth::id();


            if(isset($input['firstname']) || isset($input['lastname']) || isset($input['email'])) {
                $validator = Validator::make($input, [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => [
                        'required', 'email:rfc,dns',
                        Rule::unique('users')->ignore($uid),
                    ]
                ]);

                if ($validator->fails()) {
                    return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
                }
            }

            if(isset($request->img)) {
                $request->validate([
                    'img' => 'image|nullable|max:5120'
                ]);    
                if($img_file = $request->file('img')){  
                    $filenameWithExt = $img_file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $img_file->getClientOriginalExtension();
                    $input['img'] = $filename.'_'.time().'.'.$extension;
                    $img_file->move('storage/images/users', $input['img']);
                } 
            }

            if (isset($input['password']) && !empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            }

            $model = new User();
            $prefix = 'user';
            $delete_from_redis = null;
            $user = redisUpdate($model, $input, $uid, $prefix, $delete_from_redis);

            $agent_update = Agents::where('user_id', $user->id)->update([
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
            ]);

            return response()->json(['message'=>'success','code'=>'200','data'=>$user]);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    } */

    public function update(Request $request, $utype=null, $id=null)
    {
        try {
            if(isset($request->type)) {
                return response()->json(['message'=>'error','code'=>'302','data'=>'You cannot change user type.']);
            }

            if (isset($request->password)) {
                return response()->json(['message'=>'error','code'=>'302','data'=>'You cannot change password here.']);
            }
            
            $input = $request->all();

            $user = Auth::user();

            if($user->hasRole('Super User') && isset($utype) && isset($id)) {
                if($utype=='5' || $utype=='6') {
                    $agent = Agents::select('id', 'user_id')->firstWhere('id', $id);
                    $uid = $agent->user_id;
                } else {
                    $uid = $id;
                }
            }
            else {
                $uid = Auth::id();
            }

            //$uid = Auth::id();


            if(isset($input['firstname']) || isset($input['lastname']) || isset($input['email'])) {
                $validator = Validator::make($input, [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => [
                        'required', 'email:rfc,dns',
                        Rule::unique('users')->ignore($uid),
                    ]
                ]);

                if ($validator->fails()) {
                    return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
                }
            }

            if(isset($request->img)) {
                $request->validate([
                    'img' => 'image|nullable|max:5120'
                ]);    
                if($img_file = $request->file('img')){  
                    $filenameWithExt = $img_file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $img_file->getClientOriginalExtension();
                    $input['img'] = $filename.'_'.time().'.'.$extension;
                    $img_file->move('storage/images/users', $input['img']);
                } 
            }

            $model = new User();
            $prefix = 'user';
            $delete_from_redis = null;
            $user = redisUpdate($model, $input, $uid, $prefix, $delete_from_redis);

            $agent_update = Agents::where('user_id', $user->id)->update([
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
            ]);

            return response()->json(['message'=>'success','code'=>'200','data'=>$user]);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }


    public function update_password(Request $request, $utype=null, $id=null)
    {
        try {
            $input = $request->all();

            $user = Auth::user();

            if($user->hasRole('Super User') && isset($utype) && isset($id)) {
                if($utype=='5' || $utype=='6') {
                    $agent = Agents::select('id', 'user_id')->firstWhere('id', $id);
                    $auth = User::find($agent->user_id);
                } else {
                    $auth =  User::find($id);
                }
            }
            else {
                $auth = Auth::user();
            }

            $validator = Validator::make($input, [
                'current_password' => 'required|string',
                'new_password' => 'required|confirmed|min:8|string'
            ]);

            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }
    
            // The passwords matches
            if (!Hash::check($request->get('current_password'), $auth->password)) 
            {
                return response()->json(['message'=>'error','code'=>'302','data'=>'Current Password is Invalid']);

            }
    
            // Current password and new password same
            if (strcmp($request->get('current_password'), $request->new_password) == 0) 
            {
                return response()->json(['message'=>'error','code'=>'302','data'=>'New Password cannot be same as your current password.']);
            }
    
            $user_update =  User::find($auth->id);
            $user_update->password =  Hash::make($request->new_password);
            $user_update->save();
            
            return response()->json(['message'=>'success','code'=>'200','data'=>'Password Changed Successfully']);
        
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }

    }

}
