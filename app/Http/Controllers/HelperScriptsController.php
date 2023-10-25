<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class HelperScriptsController extends Controller
{
    public function index(Request $request){
        try{

            /* $user_1 = [
                'id' => 1, 
                'username' => 'admin', 
                'firstname' => 'SuperAdmin',
                'lastname' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('mind@123'),
                'type' => '1',
                'status' => '1',
                'img' => 'garvit-3IyjBegTXLA-unsplash_1690635688.jpg',
            ];
            
            $user_1_save = User::create($user_1);
            $user_1_save->assignRole(['Super User']);
            
            $user_2 = [
                    'id' => 2, 
                    'username' => 'Miniadmin', 
                    'firstname' => 'Mini',
                    'lastname' => 'Admin',
                    'email' => 'miniadmin_seasia@yopmail.com',
                    'password' => Hash::make('12345678'),
                    'type' => '2',
                    'status' => '1',
                    'img' => 'garvit-3IyjBegTXLA-unsplash_1690635688.jpg',
            ];

            $user_2_save = User::create($user_2);
            $user_2_save->assignRole(['Mini Admin']);

            $user_3 = [
                    'id' => 3, 
                    'username' => 'Miniadmin2', 
                    'firstname' => 'Mini2',
                    'lastname' => 'Admin',
                    'email' => 'miniadmin_seasia2@yopmail.com',
                    'password' => Hash::make('12345678'),
                    'type' => '2',
                    'status' => '1',
                    'img' => 'garvit-3IyjBegTXLA-unsplash_1690635688.jpg',
            ];

            $user_3_save = User::create($user_3);
            $user_3_save->assignRole(['Mini Admin']); */
            // fake admin and mini admin


/* 
$agents = DB::table('agents_new')->groupBy('email')->get();

foreach($agents as $agent){
$data = [
"id" => $agent->id,
"user_id" => $agent->id,
"title" => $agent->title,
"firstname"=> $agent->firstname,
"lastname"=> $agent->lastname,
"username"=> $agent->username,
"password"=> $agent->password,
"email"=> $agent->email,
"address"=> $agent->address,
"city"=> $agent->city,
"state"=> $agent->state,
"zipcode"=> $agent->zipcode,
"officephone"=> $agent->officephone,
"cellphone"=> $agent->cellphone,
"homephone"=> $agent->homephone,
"licenseno"=> $agent->licenseno,
"licensetype"=> $agent->licensetype,
"ssn"=> $agent->ssn,
"brokerpersent"=> $agent->brokerpersent,
"bonus"=> $agent->bonus,
"agreelevel"=> $agent->agreelevel,
"brokernotes"=> $agent->brokernotes,
"agentdes"=> $agent->brokernotes,
"agentareas"=> $agent->agentareas,
"img"=> $agent->img,
"management"=> $agent->management,
"regionalmanager"=> $agent->regionalmanager,
"managedby"=> $agent->managedby,
"allzip"=> $agent->allzip,
"displayonsite"=> $agent->displayonsite,
"accmembermail"=> $agent->accmembermail,
"displayoffphone"=> $agent->displayoffphone,
"fullaccess"=> $agent->fullaccess,
"accesstostats"=> $agent->accesstostats,
"accessallcas"=> $agent->accessallcas,
"language"=> $agent->language,
"placement"=> $agent->placement,
"status"=> $agent->status,
"agent_level"=> $agent->agent_level,
"hotreportshow"=> $agent->hotreportshow,
"isTypeAO"=> $agent->isTypeAO,
"ofclegalname"=> $agent->ofclegalname,
"ofecounty"=> $agent->ofecounty,
"franchisename"=> $agent->franchisename,
"fax"=> $agent->fax,
"franchiseofficeid"=> $agent->franchiseofficeid,
"pagetitle"=> $agent->pagetitle,
"officelatlong"=> $agent->officelatlong,
"wsr_pwd"=> $agent->wsr_pwd,
"outlook_password"=> $agent->outlook_password,
"OTP"=> $agent->OTP,
"extendphone"=> $agent->extendphone,
"county"=> $agent->county,
"extendphone_two"=> $agent->extendphone_two,
"map_img"=> $agent->map_img,
"mapzipcode"=> $agent->mapzipcode,
"permission"=> $agent->permission,
//"account_id"=> $agent->account_id,
//"client_id"=> $agent->client_id,
//"secret_id"=> $agent->secret_id
];

Agents::insert($data);

$user = new User();
if($data['agent_level'] == '3'){
    $type = '6';
} else { 
    $type = '5';
}
$user['firstname'] = $data['firstname'];
$user['lastname'] = $data['lastname'];
$user['email'] = $data['email'];
$user['password'] = Hash::make('mind@123');
$user['type'] = $type;
$user['status'] = $data['status'];
$user->save();

Agents::where('email', $user->email)->update([
    'user_id' => $user->id
]);

if($type == '6') {
    $user->assignRole(['Agent Manager']);
}

if($type == '5') {
    $user->assignRole(['Agent']);
}

} */
//live db agents migrate

// $users = DB::table('users_remove_uemail')->select('id', 'email', DB::raw('COUNT(email) as followers'))->groupBy('email')->get();
// //$users = DB::table('users_remove_uemail')->get();
// dd($users);

            
//$users = DB::table('users_new')->select('id', 'email', DB::raw('COUNT(email) as followers'))->groupBy('email')->get();

// dd(count($users));





/* 
$users = DB::table('users_new')->get();



foreach($users as $user){
    if($user->type == '1'){
        $type = '1';
    }
    if($user->type == '4'){
        $type = '2';
    } 
    $data = [
    "username"=> $user->username,
    "firstname"=> $user->username,
    "lastname" => $user->username,
    "password"=> Hash::make('mind@123'),
    "type"=> $type,
    "email"=> $user->email,
    "des"=> $user->des,
    "status"=> $user->status,
    "img"=> $user->img,
    "wsr_pwd"=> $user->wsr_pwd,
    "outlook_password"=> $user->outlook_password,
    "OTP"=> $user->OTP,
    "cellphone"=> $user->cellphone
    ];

    $user_new = User::create($data);

    if($user_new->type == '1') {
        $user_new->assignRole(['Super User']);
    }
    
    if($user_new->type == '2') {
        $user_new->assignRole(['Mini Admin']);
    }
}  */

//  return $users;
            
            
// Agent managers
// -------------------------
// robin@wesellrestaurants.com
// rickmoorebiz@yopmail.com
// agentmanager_seasia@yopmail.com

// Agent
// ----------
// carolyn@yopmail.com
// jk@yopmail.com
// agent_seasia@yopmail.com


// Mini Admin
// ------------------
// miniadmin_seasia@yopmail.com
// miniadmin_seasia2@yopmail.com

// Super Admin
// ----------------------
// admin@admin.com
// mind@123

// Password for all: 
// New Password: 12345678

$agents = DB::table('agents_old')->groupBy('email')->get();

 

foreach($agents as $agent){

$data = [

"id" => $agent->id,

"user_id" => $agent->id,

"title" => $agent->title,

"firstname"=> $agent->firstname,

"lastname"=> $agent->lastname,

"username"=> $agent->username,

"password"=> $agent->password,

"email"=> $agent->email,

"address"=> $agent->address,

"city"=> $agent->city,

"state"=> $agent->state,

"zipcode"=> $agent->zipcode,

"officephone"=> $agent->officephone,

"cellphone"=> $agent->cellphone,

"homephone"=> $agent->homephone,

"licenseno"=> $agent->licenseno,

"licensetype"=> $agent->licensetype,

"ssn"=> $agent->ssn,

"brokerpersent"=> $agent->brokerpersent,

"bonus"=> $agent->bonus,

"agreelevel"=> $agent->agreelevel,

"brokernotes"=> $agent->brokernotes,

"agentdes"=> $agent->brokernotes,

"agentareas"=> $agent->agentareas,

"img"=> $agent->img,

"management"=> $agent->management,

"regionalmanager"=> $agent->regionalmanager,

"managedby"=> $agent->managedby,

"allzip"=> $agent->allzip,

"displayonsite"=> $agent->displayonsite,

"accmembermail"=> $agent->accmembermail,

"displayoffphone"=> $agent->displayoffphone,

"fullaccess"=> $agent->fullaccess,

"accesstostats"=> $agent->accesstostats,

"accessallcas"=> $agent->accessallcas,

"language"=> $agent->language,

"placement"=> $agent->placement,

"status"=> $agent->status,

"agent_level"=> $agent->agent_level,

"hotreportshow"=> $agent->hotreportshow,

"isTypeAO"=> $agent->isTypeAO,

"ofclegalname"=> $agent->ofclegalname,

"ofecounty"=> $agent->ofecounty,

"franchisename"=> $agent->franchisename,

"fax"=> $agent->fax,

"franchiseofficeid"=> $agent->franchiseofficeid,

"pagetitle"=> $agent->pagetitle,

"officelatlong"=> $agent->officelatlong,

"wsr_pwd"=> $agent->wsr_pwd,

"outlook_password"=> $agent->outlook_password,

"OTP"=> $agent->OTP,

"extendphone"=> $agent->extendphone,

"county"=> $agent->county,

"extendphone_two"=> $agent->extendphone_two,

"map_img"=> $agent->map_img,

"mapzipcode"=> $agent->mapzipcode,

"permission"=> $agent->permission,

//"account_id"=> $agent->account_id,

//"client_id"=> $agent->client_id,

//"secret_id"=> $agent->secret_id

];

 

Agents::insert($data);

 

$user = new User();

if($data['agent_level'] == '3'){

    $type = '6';

} else {

    $type = '5';

}

$user['firstname'] = $data['firstname'];

$user['lastname'] = $data['lastname'];

$user['email'] = $data['email'];

$user['password'] = Hash::make('mind@123');

$user['type'] = $type;

$user['status'] = $data['status'];

$user->save();

 

Agents::where('email', $user->email)->update([

    'user_id' => $user->id

]);

Agents::where('user_id', $user->id)->update([

        'agent_level' => $user->type

    ]);

 

if($type == '6') {

    $user->assignRole(['Agent Manager']);

}

 

if($type == '5') {

    $user->assignRole(['Agent']);

}

 

} 

// $users = DB::table('users_old')->get();


// foreach($users as $user){

//     if($user->type == '1'){

//         $type = '1';

//     }

//     if($user->type == '4'){

//         $type = '2';

//     }

//     $data = [

//     "username"=> $user->username,

//     "firstname"=> $user->username,

//     "lastname" => $user->username,

//     "password"=> Hash::make('mind@123'),

//     "type"=> $type,

//     "email"=> $user->email,

//     "des"=> $user->des,

//     "status"=> $user->status,

//     "img"=> $user->img,

//     "wsr_pwd"=> $user->wsr_pwd,

//     "outlook_password"=> $user->outlook_password,

//     "OTP"=> $user->OTP,

//     "cellphone"=> $user->cellphone

//     ];

 

//     $user_new = User::create($data);

 

//     if($user_new->type == '1') {

//         $user_new->assignRole(['Super User']);

//     }

    

//     if($user_new->type == '2') {

//         $user_new->assignRole(['Mini Admin']);

//     }

   
// }  


    




//18-08-2023

 /* $users = DB::table('users')->where('type', '6')->orWhere('type', '5')->get();

$agents = DB::table('agents')->get();


foreach($agents as $agent){

    $user = User::find($agent->user_id);

    // if($agent->status != $user->status) {
    //     $test['id'] = $agent->id;
    //     $test['user_id'] = $agent->user_id;
    // }

    // Agents::where('user_id', $user->id)->update([
    //     'agent_level' => $user->type
    // ]);

}  */


// $agents = DB::table('agents')->select('id')->where('isTypeAO', 'O')->get();
// dd($agents);
//18-08-2023


            return response()->json(['message'=>'success','code'=>'200','data'=>'done']);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
}
