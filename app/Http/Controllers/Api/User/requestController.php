<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\clickMail;
use App\Mail\BrokerMail;
use App\Mail\registerContacMail;
use App\Models\RequestInfo;
use App\Models\Listing;
use Illuminate\Support\Facades\Validator;
use Mail;
class requestController extends Controller
{
    public function formSave(Request $request)
    {

        $email = $request['email'];
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'phone' => 'required|string',
            'state' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        try {
            Mail::to($request['email'])->send(new clickMail($email, $request));

            return response()->json( [ 'status' => 'success', 'code' => '200', 'data' => 'send Mail suucessfully' ] );


        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }


    public function storeInfo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'state' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        try {
            $info = new RequestInfo();
            $info->firstname = $request->firstname;
            $info->lastname = $request->lastname;
            $info->phone = $request->phone;
            $info->email = $request->email;
            $info->state = $request->state;

            // Mail::to( $request[ 'email' ] )->send( new infomail( $info, $request ) );

            $info->save();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => 'send request suucessfully']);
        } catch (\Exception $e) {
            return $this->sendError('Server Error', $e->getMessage(), 500);
        }
    }


    public function RestaurantEmail(Request $request, $agentemail)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
         
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        try {
            $broker = new RequestInfo();
            $broker->name = $request->name;
            $broker->phone = $request->phone;
            $broker->email = $request->email;

            // Mail::to( $agentemail )->send( new BrokerMail($infos ,$request) );

            Mail::to($request['email'])->send(new BrokerMail($broker, $request));



            return response()->json(['status' => 'success', 'code' => '200', 'data' => 'send request suucessfully']);
        } catch (\Exception $e) {
            return $this->sendError('Server Error', $e->getMessage(), 500);
        }
    }


    public function contactUs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        try {
            // Mail::to($request['email'])->send(new clickMail( $request));

            return response()->json( [ 'status' => 'success', 'code' => '200', 'data' => 'send Mail suucessfully' ] );


        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }
    public function registrationForm(Request $request, $lid)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        try {

            $listing = Listing::where('id',$lid)->first();

            $contact = new RequestInfo();
            $contact->listingId = $lid;
            $contact->ListingName = $listing->bname?$listing->bname:null;
            $contact->ListingAgent = $listing->olagent?$listing->olagent:null;
            $contact->name = $request->name;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->message = $request->message;


            // Mail::to($request['email'])->send(new registerContacMail($contact, $request));

            return response()->json( [ 'status' => 'success', 'code' => '200', 'data' => 'Thank you for contacting us' ] );


        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }


    

}
