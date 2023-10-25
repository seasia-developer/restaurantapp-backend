<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\buyerMail;
use App\Mail\ResetPassword;
use App\Models\Buyers;
use App\Models\CaBuyers;
use App\Models\Listing;
use App\Models\password_reset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

use Mail;

class BuyeruserController extends Controller
{
    //
    public function register(Request $request)
    {
        try {

            // DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|',
                'password' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'staddress' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'postalcode' => 'required',
                'phoneno' => 'required',
                'cellno' => 'required',
                'islicestate' => 'required',
                'experince' => 'required',
                'isown' => 'required',
                'cashinhand' => 'required',
                'desiredrestaurant' => 'required',
                'lookingstates' => 'required',
                'sourcehear' => 'required',
                'helptxt' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => $validator->errors()]);
            }

            $email = User::where('email', $request->email)->first();
            if (empty($email)) {
                // DB::beginTransaction();
                // $success = [];

                $username = $request->firstname . $request->lastname;

                $users = new User();
                $users->username = $username;
                $users->email = $request->email;
                $users->password = Hash::make($request->password);
                $users->cellphone = $request->cellno;
                $users->type = '4';
                // Mail::to($request['email'])->send(new buyerMail($users, $request));

                $users->save();


                $users->assignRole(['Buyer']);
                // if ($users) {

                    $buyer = new Buyers;

                    $buyer->email = $request->email;
                    $buyer->user_id = $users->id;
                    $buyer->password = Hash::make($request->password);
                    $buyer->firstname = $request->firstname;
                    $buyer->lastname = $request->lastname;
                    $buyer->staddress = $request->staddress;
                    $buyer->city = $request->city;
                    $buyer->state = $request->state;
                    $buyer->country = $request->country;
                    $buyer->postalcode = $request->postalcode;
                    $buyer->phoneno = $request->phoneno;
                    $buyer->cellno = $request->cellno;
                    $buyer->islicestate = $request->islicestate;
                    $buyer->experince = $request->experince;
                    $buyer->isown = $request->isown;
                    $buyer->cashinhand = $request->cashinhand;
                    $buyer->desiredrestaurant = $request->desiredrestaurant;
                    $buyer->lookingstates = $request->lookingstates;
                    $buyer->sourcehear = $request->sourcehear;
                    $buyer->helptxt = $request->helptxt;

                    // Mail::to($request['email'])->send(new buyerMail($buyer, $request));

                    $buyer->save();
                // } else {
                //     DB::rollback();
                    // return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Something went wrong!']);}

                // if ($buyer) {
                    // DB::commit();
                    return response()->json(['message' => 'Register Successfull', 'code' => '200']);
                // } else {
                //     DB::rollback();
                //     return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Something went wrong!']);
                // }
            } else {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Email already exist !']);

            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);

        }

    }

    public function checkemail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Enter your email !']);
        }

        try {
            $email = User::where('email', $request->email)->first();
            if (empty($email)) {
                return response()->json(['status' => 'success', 'code' => '200', 'data' => []]);
            } else {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Email already exist !']);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);

        }

    }
    public function activate(Request $request, $email)
    {
        try {

            $activate = new Buyers();
            $activates = Buyers::where('email', $email)->first();

            $activate = Buyers::find($activates->id);
            $activate->activate = "Y";
            $activate->update();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => 'Your account verification has been completed successfully.', 'Activate' => $activates->activate]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);

        }
    }

    public function myAccount()
    {
        try {

            $bstatuslist = array('In Contract', 'LOI', 'Available', 'Coming Soon','Available Not Advertised');
            $user = Auth::user();
            $buyer = Buyers::where('user_id', $user->id)->where('activate', 'Y')->select('id','user_id','email','desiredrestaurant','lookingstates')->first();
            if (!empty($buyer)) {
                $listing_id = CaBuyers::Where('buyer_id', $buyer->id)->Where('is_hot', 'Y')->orderBy('id', 'desc')->take(5)->get();
                $listing = array_column($listing_id->toArray(), 'listing_id');
                $listings = Listing::whereIn('id', $listing)->whereIn('bstatuslist', $bstatuslist)->where('activate', 1)->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_category')->get();

                $account[] = array(
                    'account' => $user,
                    'buyer' => $buyer,
                    'listings' => $listings,

                );

                return response()->json(['status' => 'success', 'code' => '200', 'data' => $account]);
            } else {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Please wait for admin approval of your account !']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);

        }
    }



    public function updateProfile(Request $request ,$id){
        try{
          
            $Buyers =Auth::user();

            $Buyer = Buyers::find($id);

        
            $Buyer->desiredrestaurant = $request->desiredrestaurant;
            $Buyer->lookingstates = $request->lookingstates;


            $Buyer->update();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => 'update details successfully']);
        } 

        catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }
    public function change_password(Request $request, $utype = null, $id = null)
    {
        try {
            $input = $request->all();

            $user = Auth::user();

            if ($user->hasRole('Buyer') && isset($utype) && isset($id)) {
                if ($utype == '4') {
                    $agent = Agents::select('id', 'user_id')->firstWhere('id', $id);
                    $auth = User::find($agent->user_id);
                } else {
                    $auth = User::find($id);
                }
            } else {
                $auth = Auth::user();
            }

            $validator = Validator::make($input, [
                'current_password' => 'required|string',
                'new_password' => 'required|min:8|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => $validator->errors()]);
            }

            // The passwords matches
            if (!Hash::check($request->get('current_password'), $auth->password)) {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Current Password is Invalid']);

            }

            // Current password and new password same
            if (strcmp($request->get('current_password'), $request->new_password) == 0) {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'New Password cannot be same as your current password.']);
            }

            $user_update = User::find($auth->id);
            $user_update->password = Hash::make($request->new_password);
            $user_update->save();

            return response()->json(['message' => 'success', 'code' => '200', 'data' => 'Password Changed Successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 401);
        }
        try {

            $data = [];
            $verify = User::where('email', $request->email)->exists();
            if ($verify) {

                $token = random_int(100000, 999999);
                $email =$request->email;
                $password_reset = password_reset::updateOrCreate([
                    'email' => $request->email,
                ],
                    [
                        'email' => $email,
                        'token' => $token,
                    ]);

                if ($password_reset) {

                    $tokens =  Crypt::encrypt($token);
                    Mail::to($request->email)->send(new ResetPassword($tokens, $request));

                    return response()->json(['status' => 'success', 'code' => '200', 'data' => 'We have sent your account information to your email']);

                }

            } else {

                return response()->json(['message' => 'error', 'code' => '401', 'data' => 'This email does not exist']);

            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }

    public function verifyPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => ['required', 'string', 'email', 'max:255'],
            'token' => ['required'],
            'password' => ['required', 'string', 'min:8'],

        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 401);
        }

        try {
            $tokens =Crypt::decrypt($request->token);

            $check = password_reset::where([
                // 'email'=> $request->email,
                'token' => $tokens,
            ]);

            if ($check->exists()) {
                $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
                // dd($difference);
                $email = $check->first()->email;

                if ($difference > 10000) {

                    return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Token Expired! please regenerate again']);
                }

             
                $user = User::where('email', $email);
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                $delete = password_reset::where([
                    'token' => $tokens,
                ])->delete();
    
                
                return response()->json(['message' => 'ok', 'code' => '200', 'data' => 'Your password has been reset successfully']);

            } else {
                // return $this->sendError([], 'Invalid token', 401);
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Invalid token']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    // public function resetPassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         if ($validator->fails()) {
    //             return response($validator->errors(), 401);
    //         }
    //     }
    //     try {
    //         $data = [];
    //         $user = User::where('email', $request->email);
    //         $user->update([
    //             'password' => Hash::make($request->password),
    //         ]);

            
    //         return response()->json(['message' => 'ok', 'code' => '200', 'data' => 'Your password has been reset successfully']);
    //     } catch (Exception $e) {
    //         return $this->sendError('Server Error', $e->getMessage(), 500);
    //     }
    // }

    public function filpbook(Request $request, $id, $name)
    {

        $html = '


        <!DOCTYPE html>

        <html lang="en">
        <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>


        <style>
        #container {
        height: 500px;
        width: 95%;
        margin: 20px auto;
        }

        </style>
        </head>
        <body>
        <div id="container"></div>

        <script src= ' . asset("public/assets/js/flipbook/js/libs/jquery.min.js") . '></script>
        <script src= ' . asset("public/assets/js/flipbook/js/libs/html2canvas.min.js") . '></script>
        <script src= ' . asset("public/assets/js/flipbook/js/libs/three.min.js") . '></script>
        <script src= ' . asset("public/assets/js/flipbook/js/libs/pdf.min.js") . '></script>
        <script src= ' . asset("public/assets/js/flipbook/js/dist/3dflipbook.js") . '></script>

        <script type="text/javascript">
        var jQuery_con = $.noConflict(true);
        jQuery_con("#container").FlipBook({

        pdf: "https://stgps.appsndevs.com/wsrrebuild/backend/public/storage/listing/docs/' . $name . '_listing_' . $id . '_pdf.pdf",
        template: {

        html: "' . asset("public/assets/js/flipbook/templates/default-book-view.html") . '",
        styles: [" ' . asset("public/assets/js/flipbook/css/short-black-book-view.css") . ' "],
        links: [
        {
        rel: "stylesheet",
        href: "' . asset("public/assets/js/flipbook/css/font-awesome.min.css") . '",
        },

        ],

        script: "' . asset("public/assets/js/flipbook/js/default-book-view.js") . '",
        },
        });

        </script>

        </body>

        </html>';

        return $html;

    }

}
