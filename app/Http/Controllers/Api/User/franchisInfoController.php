<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Franchise;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\infomail;
use App\Mail\franchiseMail;

class franchisInfoController extends Controller
{
    

    public function storeFranchaies(Request $request)
    {

  
        $validator = Validator::make( $request->all(), [
            'firstname' => 'required|string',
            'lastname' =>'required|string',
            'phone' => 'required|string',
            'email' =>'required|string',
            'franchise_territory' =>'required|string',
        ] );
        if ( $validator->fails() ) {
            return response($validator->errors(), 400);
        }

            try {
                $info = new Franchise();
                $info->firstname = $request->firstname;
                $info->lastname = $request->lastname;
                $info->phone = $request->phone;
                $info->email = $request->email;
                $info->state = $request->state;
                $info->franchise_territory = $request->franchise_territory;
                $info->tell_us_a_little_about_yourself = $request->tell_us_a_little_about_yourself;

                Mail::to($request['email'])->send(new infomail($info, $request));
             
                $info->save();

    
                return response()->json( [ 'status' => 'success', 'code' => '200', 'data' => 'Email sent successfully' ] );
            } catch (\Exception $e ) {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
            }
    }

    public function nextFranchaies(Request $request)
    {

  
        $validator = Validator::make( $request->all(), [
            'firstname' => 'required|string',
            'lastname' =>'required|string',
            'phone' => 'required|string',
            'email' =>'required|string',
            'state' =>'required|string',
           
        ] );
        if ( $validator->fails() ) {
            return response($validator->errors(), 400);
        }

            try {
                $Franchise = new Franchise();
                $Franchise->firstname = $request->firstname;
                $Franchise->lastname = $request->lastname;
                $Franchise->phone = $request->phone;
                $Franchise->email = $request->email;
                $Franchise->state = $request->state;
              
                // $info->save();
                Mail::to($request['email'])->send(new franchiseMail($Franchise, $request));

    
                return response()->json( [ 'status' => 'success', 'code' => '200', 'data' => 'send request suucessfully' ] );
            } catch (\Exception $e ) {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
            }
    }
}
