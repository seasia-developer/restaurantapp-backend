<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\BuildAdemail;
use App\Models\Agents;
use App\Models\Listing;
use App\Models\CampaignList;
use App\Models\ListingBat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmailCreateExport;

class CalendarController extends Controller
{
    public function index(Request $request){
        try{
            $user = Auth::guard('api')->user();

            $list = BuildAdemail::query();

            if($request->filled('agent')){
               $list->where('agentid', $request->agent);
            }

            if($request->filled('type') && $request->type != 'All'){
               $list->where('type', $request->type);
            }

            if($request->filled('campaign_id')){
                $list->where('campaignname', $request->campaign_id);
            }

            if($request->type == 'All' || $request->type == "Requested"){
                if($request->filled('non_campaign_id')){
                    $list->orWhere('non_standard', $request->non_campaign_id);
                }
            }else{
                if($request->filled('non_campaign_id')){
                    $list->where('non_standard', $request->non_campaign_id);
                }
            }

            if($request->filled('startdate') && $request->filled('enddate')){
                $list->whereBetween('senddate', [
                    $request->startdate,
                    $request->enddate
                ]);
            }
            if(!$request->filled('startdate') && !$request->filled('enddate')){
                if ($request->filled('month') && $request->filled('year')) {
                    $month = Carbon::createFromDate($request->year, $request->month);
                    $start = $month->startOfMonth()->toDateString();
                    // $start = $month->startOfMonth()->format('m-d-Y');
                    $end = $month->endOfMonth()->toDateString();
                    // $end = $month->endOfMonth()->format('m-d-Y');
                    $list = $list->whereBetween('senddate', [
                        $start,
                        $end
                    ]);
                }
            }

            $list = $list->with('getCampaignData', 'getAgentData')->where('savereport', 'Yes')->where('type', '!=', 'Cancel')->get();
            if($request->filled('Excel') && $request->Excel == true){
                $name = 'Email_create_report.xls';
                return Excel::download(new EmailCreateExport($list), $name);
            }

            return response()->json(['message'=>'success','code'=>'200','data'=>$list]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function todayEvent(Request $request){
        try{

            $limit = $request->limit;
            $limit = ($limit) ? $limit : 5;
            $user = Auth::guard('api')->user();

            $list = BuildAdemail::query();

            if($request->filled('agent')){
               $list->where('agentid', $request->agent);
            }

            $now = Carbon::now()->format('Y-m-d');

            $list->where('senddate', $now);
            

            $list = $list->with('getCampaignData', 'getAgentData')->where('savereport', 'Yes')->where('type', '!=', 'Cancel');

            $list = $list->get();

            return response()->json(['message'=>'success','code'=>'200','data'=>$list]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try{
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'listing_id' => 'required',
                'send_date' => 'required',
                'campaign_id' => 'required',
                'subject' => 'required',
                'email_name' => 'required',
                'email_format_id' => 'required',
                'type' => 'required',
                'save_report'=> 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            if($request->filled('check_build_email') && $request->check_build_email == true){
                $SameCampaignCheck = BuildAdemail::where('listings', $request->listing_id)->where(['campaignname'=>$request->campaign_id, 'senddate' => $request->send_date])->get();
                    if($SameCampaignCheck->isEmpty()){
                        $templateData = $this->getEmailTemplate($request->email_format_id, $request->listing_id);
                        return response()->json(['message'=>'success','code'=>'200','data'=>$templateData]);
                    }else{
                        $listingids = "";
                        foreach($SameCampaignCheck as $key=>$value){
                            $listingids .=$value->listings.','; 
                        }
                        $listingids = trim($listingids, ','); 
                        return response()->json(['message'=>'error','code'=>'302','data'=>'Same campaign has already been created for listing(s) '.$listingids.' for the selected date. Please confirm.']);
                    }  
            }

            $data = BuildAdemail::create([
                'agentid' => $user->id,
                'listings' => $request->listing_id,
                'senddate' => $request->send_date,
                'campaignname' => $request->campaign_id,
                'subject' => $request->subject,
                'emailname' => $request->email_name,
                'emlformat' => $request->email_format_id,
                'user_type' => $user->type,
                'date_time' => Carbon::now()->format('Y-m-d'),
                'savereport'=> $request->save_report,
                'type' => $request->type
            ]);
            
            return response()->json(['message'=>'success','code'=>'200','data'=>$data]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function getEmailTemplate($emlFormat, $listings){
        $listingid = explode(',',$listings);
        // return $listinghtml= $this->newdrawListingBox($listingid, $emlFormat);
        // return $this->drawNews("emailtemplate");
        return  $headerhtml='<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
        <meta charset="utf-8">
        <!-- utf-8 works for most cases -->
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <!-- Forcing initial-scale shouldnt be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting">
        <!-- Disable auto-scale in iOS 10 Mail entirely -->
        <title></title>
        <!-- The title tag shows in email notifications, like Android 4.4. -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Web Font / @font-face : BEGIN -->
        <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->
        <!-- utf-8 works for most cases --><!-- Forcing initial-scale shouldnt be necessary --><!-- Use the latest (edge) version of IE rendering engine --><!-- Disable auto-scale in iOS 10 Mail entirely --><!-- The title tag shows in email notifications, like Android 4.4. --><!-- Web Font / @font-face : BEGIN --><!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. --><!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. --><!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
        <![endif]--><!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ --><!--[if !mso]><!--><!-- insert web font reference, eg: <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css"> --><!--<![endif]--><!-- Web Font / @font-face : END --><!-- CSS Reset -->
        <style type="text/css">/* What it does: Remove spaces around the email design added by some email clients. */
    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
    html,
    body {
        margin: 0 auto !important;
        padding: 0 !important;
        height: 100% !important;
        width: 100% !important;
        font-family:Montserrat, sans-serif !important;
    }
    /* What it does: Stops email clients resizing small text. */
    * {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }
    /* What it does: Centers email on Android 4.4 */
    div[style*="margin: 16px 0"] {
                                    margin: 0 !important;
    }
    /* What it does: Stops Outlook from adding extra spacing to tables. */
    table,
    td {
        mso-table-lspace: 0pt !important;
        mso-table-rspace: 0pt !important;
    }
    /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
    table table table {
        table-layout: auto;
    }
    /* What it does: Uses a better rendering method when resizing images in IE. */
    img {
        -ms-interpolation-mode: bicubic;
    }
    /* What it does: A work-around for email clients meddling in triggered links. */

    *[x-apple-data-detectors],
    /* iOS */
    
    .x-gmail-data-detectors,
    /* Gmail */
    .x-gmail-data-detectors *,
    .aBn {
        border-bottom: 0 !important;
        cursor: default !important;
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
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
    display: none !important;
    }
    /* What it does: Prevents underlining the button text in Windows 10 */
    .button-link {
        text-decoration: none !important;
    }
    /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
    /* Create one of these media queries for each additional viewport size youd like to fix */
    /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */
    @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
     /* iPhone 6 and 6+ */
     .email-container {
        min-width: 375px !important;
    }
    }
    </style>
    <!-- Progressive Enhancements -->
    <style>
    /* Media Queries */
    @media screen and (max-width: 767px) {
       .wr-products-new-templates {
          display: block !important;
       }
       .wr-products-new-templatesleft1 {
            width: 100% !important;
        }
        .wr-products-new-templates td {
            display: inline-block !important;
            width: 100% !important;
                           
        }
        .wr-products-new-templatesleft1 img {
            max-height: 150px !important;
            height: auto !important;
        }
        .wr-products-new-templates td {
            display: inline-block !important;
            width: 100% !important;
            text-align: left !important;
        }
        .wr-products-new-templates td.wr-products-new-templatessection1 {
            width: 60% !important;
        }
        .wr-products-new-templates td.wr-products-new-templatessection2 {
            width: 40% !important;
        }
        .wr-products-new-templates td.wr-products-new-templatessection2 {
            width: 32% !important;
                     
            text-align: center !important;
                             
            vertical-align: top !important;
        }
        .wr-products-new-templatesleft2 {
            padding: 8px 0px 0px !important;
            width: 100% !important;
        }
        .wr-products-new-templates td.wr-products-new-templatessection3 div {
            float: left !important;
            width: 62%;
        }
        .wr-products-new-templates td.wr-products-new-templatessection3 p {
            text-align: left !important;
        }
        .wr-products-new-templates td.wr-products-new-templatessection3 span {
            float: left !important;
        }
        .wr-products-new-templates td.wr-products-new-templatessection3 div {
            float: left !important;
            width: 51%;
            padding-left: 15px;
        }
        .wr-products-new-templates2 img {
            max-width: 50% !important;
            width: 30% !important;
            margin-right: 20px;
        }
        .wr-products-new-templates2 span {
            font-size: 16px !important;
            line-height: 20px !important;
            padding-left: 20px !important;
            text-align: left !important;
            width: 53% !important;
            float: right;
            margin: 0 !important;
        }
        .wr-products-new-templates2 td {
                          
            vertical-align: middle !important;
            padding: 20px 0px !important;
                      
               
        }
        .wr-pthead {
                          
            font-size: 14px !important;
                  
        }
        .wr-products-new-templates td p {
            font-size: 14px !important;
            line-height: 20px !important;
        }
        }

        .full-body {
            margin: 0 auto;
        }
            body {
              height: 100% !important;
              width: 100% !important; font-family: "Montserrat", sans-serif;
            }
            a {
              text-decoration: none;
            }
            table,
            td {
              mso-table-lspace: 0pt;
              mso-table-rspace: 0pt;
            }

             table, tr, td {
              border: 0 !important;
            }
            body {
              height: 100% !important;
              margin: 0 !important;
              padding: 0 !important;
              width: 100% !important;
            }
            img {
              -ms-interpolation-mode: bicubic;
            }
            img {
              border: 0;
              line-height: 100%;
              outline: none;
              text-decoration: none;
            }
         @media only screen and (max-width: 600px) {
         table {
            width: 100%;
        }
        img {
            max-width: 100% !important;
            height: auto !important;
            width: 100% !important;
        }
        td {
            width: 100%;
            display: block;
            padding-left: 0 !important;
            padding-right: 0 !important;

        }
         .product-content {
          padding: 10px;
          text-align: center;
        }
        .product-content td {
          text-align: center;
        }
        .product-image td {
          text-align: center;
        }
        td {
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
        }
         }
            @media only screen and (max-width: 481px) {

            
             
              img {
                max-width: 100% !important;
                height: auto !important;
              }
              
        img.listing-img {
            max-width: 100% !important;
            height: 210px !important;
            width: 215px !important;
        }

        img.listing-img-two{
            max-width: 100% !important;
            height:210px !important;
            width: 300px !important;
            
            }

              
        table {
            width: 100%;
        }
        .table td {
            font-size: 15px !important;
            padding: 0 5px;
        }

            }

        </style>
        <![endif]-->

        </head>

        <body>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
        <td>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="900">

        <tr>
        <td>
        <table class="logo-top" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr><td>

          <!--[if gte mso 9]>
          <a href="https://www.wesellrestaurants.com"><img width="1000" src="https://www.wesellrestaurants.com/public/images/email-header.png" alt=""/></a>
          <![endif]-->
          <!--[if !mso]> <!---->
         <a href="https://www.wesellrestaurants.com"><img width="900" src="https://www.wesellrestaurants.com/public/images/email-header.png" alt=""/></a>
         <!-- <![endif]-->
         </td></tr>
        </table>
        </td>
        </tr>
            '.$listinghtml= $this->newdrawListingBox($listingid, $emlFormat).'
            <tr>
                <td>
                <table class="logo-bottom" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr><td>
        <!--[if gte mso 9]>
        <a href="https://www.wesellrestaurants.com/franchise"><img alt="" src="https://www.wesellrestaurants.com/public/images/sell-bottom.png" width="1000" /></a>
        <![endif]--><!--[if !mso]> <!----><a href="https://www.wesellrestaurants.com/franchise"><img alt="" src="https://www.wesellrestaurants.com/public/images/sell-bottom.png" width="900" /></a> <!-- <![endif]-->
        </table>
        </td>
        </tr>
        <tr>
        <td>
        <table class="how-to-sell" align="center" border="0" cellpadding="0" cellspacing="0" width="850">

        <tr><td height="15"></td></tr>
        <tr>
        <td>
        <table class="icon" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr><td><img style="width:8px !important;" src="http://127.0.0.1:8000/images/knife.png" alt=""/></td></tr>
        </table>
        </td>
        <td>
        '.$this->drawNews("emailtemplate").'
        </td>
        </tr>
        <tr><td height="15"></td></tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!-- Email Body : END -->
        </center>
        </body></html>';
        $cabuyer = '';
        if($emlFormat  == 7){
        $cabuyer = '<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">     
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
                                            margin: 0 !important;
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
                                            -ms-interpolation-mode: bicubic;
            }
                                        /* What it does: A work-around for email clients meddling in triggered links. */

                                        *[x-apple-data-detectors],
                                        /* iOS */
                                        
                                        .x-gmail-data-detectors,
                                        /* Gmail */
                                        
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
                                            display: none !important;
                }
                                        /* What it does: Prevents underlining the button text in Windows 10 */

            .button-link {
                text-decoration: none !important;
            }
            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size youd like to fix */
            /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */
                                        
                                        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                                            /* iPhone 6 and 6+ */
                                            
                .email-container {
                    min-width: 375px !important;
                }
            }
            @media screen and (max-width: 700px) {
               td {
                   width: 100% !important;
                   display: inline-block;
                   padding: 0px !important;
                   text-align: center !important;
               }
               .header-column p {
                    text-align: center !important;
                }
                .header-column {
                    margin-bottom: 20px;
                }
                .header-logo {
                    margin: 0 auto;
                }
            }
        </style>
        <!-- Progressive Enhancements -->
        <!--[endif]----><!-- Email Body : BEGIN -->
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="c-width email-container" role="presentation" style="margin: auto; width:100% !important; max-width:700px; background: #fff; border: 1px solid #ddd; font-family: arial;" width="700"><!-- Hero Image, Flush : BEGIN -->
            <tbody>
                <tr>
                   <td><img style="width:100%;" src="http://dev.demo-swapithub.com/Email-resturant/images/header-top-image.png" alt="logo"/></td>
                </tr>
                <tr>
                   <td>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;">Hi,</p>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;">You recently acknowledged interest in my '.$listDetail->getBheadLineAd().' in  '.$listDetail->getBcity().', '.StaticData::$statesArr[$listDetail->getBstate()].', and I have some exciting news! The seller is READY and MOTIVATED to get a deal on the table! They even dropped the price to ONLY '.$listDetail->getBsalePrice().'! This amazing opportunity is one you won’t want to miss!</p>
                     <ul>
                        <li  style="font-size: 16px; color: #000; line-height: 24px;">'.$builddetails->getHeadlinead1().'</li>
                        <li  style="font-size: 16px; color: #000; line-height: 24px;">'.$builddetails->getHeadlinead2().'</li>
                        <li  style="font-size: 16px; color: #000; line-height: 24px;">'.$builddetails->getHeadlinead3().'</li>
                     </ul>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;"><a target="_blank" href="'.$URL_7.'">Here’s a link to the listing.</a> Let’s make a deal today</p>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;">Thank You</p>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;"><img src="'.$listingImg.'" width="130px"/></p>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;">'.$agentdetail['firstname'].' ' .$agentdetail['lastname'].'</p>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;">'.$agentdetail['officephone'].'</p>
                     <p style="font-size: 16px; color: #000; margin: 0 15px 15px; line-height: 24px;">'.$agentdetail['email'].'</p>
                   </td>
                </tr>
                <!-- Hero Image, Flush : END --><!-- Hero Image, Flush : END -->
            </tbody>
        </table>
        <!-- Email Body : END -->';
            }
            $opt1EmailTextArray = array(
                1 => "<p>Thank you for your interest in our restaurant for sale. It’s quick and easy to get the full details including the photos, address and more! Just click the red \"View Complete Listing button\" below or visit <a href='http://wesellrestaurants.com'>wesellrestaurants.com</a>. </p>
        <p>If you are an existing customer, log in. If you are a new customer, register by setting up a password, confirming your account through an email sent to you (please check your spam folder or call
        if it doesn’t arrive) and then electronically sign our confidentiality agreement.</p>
        <p>That’s it!  For most listings, you get instant access to the name, address, photos and more!  For some, additional qualification may be required.</p>
        <p>If you have any questions, contact the Restaurant Brokers at 1-888-814-8226.</p>",
        2 => "<p>Thank you for your interest in this listing.  Due to the highly profitable nature of the restaurant and/or the franchise requirements, we must pre-qualify your ability to purchase before providing the name and address.  We will also need a signed confidentiality agreement.  You may register as a buyer on our website and electronically sign the confidentiality agreement.</p>
        <p>For prequalification we will need one of the following:  1)  Copy of a bank statement showing sufficient liquidity to purchase OR 2) Copy of brokerage account showing sufficient liquidity to purchase OR 3)  Letter from your banker or brokerage firm direct to us stating you have sufficient funds on hand to qualify. </p>
        <p>The financial requirements are specified in the listing.  Please black out your account number before sending to our secure fax at 1-888-668-8625.</p>
        <!--p><a href=\"https://www.wesellrestaurants.com/sign-up.php\">Need help with registration? Click our video to watch the easy process</a> .</p-->
        <p>If you have any questions, contact We Sell Restaurants at 1-888-814-8226</p>",
        3 => "<p>Thank you for your interest in this listing for lease.  There is no key money on the transaction but the landlord will require a business plan, menu, security deposit and credit check.  To view the location, log onto our website as a buyer and electronically sign the confidentiality agreement for the location and photos.  If you like the location contact us to set up a showing.</p>
        <!--p><a href=\"https://www.wesellrestaurants.com/sign-up.php\">Need help with registration? Click our video to watch the easy process</a> .</p-->
        <p>If you have any questions, contact We Sell Restaurants at 1-888-814-8226</p>",
        4 => $headerhtml,
        5 => $headerhtml,
        6 => $headerhtml,
        7 => $cabuyer);
        return $optEmailText = array_key_exists( $emlFormat, $opt1EmailTextArray) ? $opt1EmailTextArray[$emlFormat] : '';
    }

    public function newdrawListingBox( $listingid, $emlFormat ){
        $html = '';
        foreach($listingid as $listingId){
            $obj = Listing::where('id', $listingId)->with(['agent' => function($agent){ $agent->select('id', 'firstname', 'lastname', 'email', 'cellphone', 'img');}])->with('listing_media')->first();
            $listingAgent = $obj->agent->firstname.' '.$obj->agent->lastname; 
            $ag_phone = preg_replace('/\s+/', '-', $obj->agent->cellphone);
            $agentimg = $obj->agent->img;
            $city = ''; 
            $state = '';

            $listData = ListingBat::where('listing_id', $listingId)->first();

            $grossSales = $listData->grossSales;

            $totalCOGS = $listData->foodCosts+$listData->alcohalCosts+$listData->otherCogs;

            $grossMargin = $grossSales-$totalCOGS;

            $totalExpenses = $listData->advertising + $listData->auto + $listData->bankCharges + $listData->creditCardFees + $listData->depreciation + $listData->duesSubscriptions + $listData->insurance + $listData->interestExpense + $listData->legal +$listData->licensesFees + $listData->miscellaneous + $listData->payrollTaxes + $listData->postageDelivery + $listData->ownerPersonalExpenses + $listData->rent + $listData->repairsMaintenance + $listData->restaurantSupplies + $listData->royalties + $listData->salariesWages + $listData->telephone + $listData->utilities + $listData->uniforms + $listData->otherUncategorized + $listData->officeSupplies + $listData->janitorial + $listData->equipmentlease + $listData->donations + $listData->filledfieldvalue;

            $netIncome = $grossMargin - $totalExpenses;

            $totalAddBacks = $listData->ownerSalary + $listData->benefits + $listData->interestExpense1 + $listData->depreciation1 + $listData->ownerPersonalExpenses1 + $listData->other;

            $ownerBenefit = $netIncome + $totalAddBacks;

            if($obj->bstate != '' && (int)$obj->bstate === 0){
                $state = $obj->bstate;
            }
            if($obj->showcity != 1 ){
                $city = $obj->bcity.",".$state;
            }else{
                $city = $state;
            }
            if($emlFormat == 6){
                $earning ='';
                $detailcount= '219';
            }else{
                    $earning ='<tr><td style="font-size: 17px;font-weight: bold;font-family: Montserrat, sans-serif;color: #000;">Earnings: <span style="color:#e70033;">$'.number_format(round($ownerBenefit)).'</span></td></tr>';
                        $detailcount= '165';
            }
            $string=strip_tags($obj->bdetailedad);
            $bdetailedad =  substr($string,0,$detailcount);

            $resized_image = url('uploads/images/'.$obj->listing_media->img_file);

            // if($resized_image == '500_'){
            //     $resized_image =$resObj->getPublic().'resizeimg/default-img.jpg';
            // }
            // $agentimg = agentimageResize($agentimg);
            $heading_id = $listingid;
            $html .='<tr>
            <td>
            <table style="background-color:#ddd;" class="bagel-shop" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr><td height="15"></td></tr><tr>
            <td>
            <table style="background-color:#fff;" class="bagel-shop-white" align="center" border="0" cellpadding="0" cellspacing="0" width="870">
            <tr>
            <td>
            <table class="product-main" align="center" border="0" cellpadding="0" cellspacing="0" width="840">
            <tr><td height="15"></td></tr>
            <tr>
            <td>
            <table class="logo-top-cont" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr><td align="center" style="font-size: 19px;
            font-weight: 700;
            font-family: Montserrat, sans-serif;
            line-height: normal;">'.$obj->bheadlinead.'</td></tr>
            </table>
            </td>
            </tr>
            <tr><td height="15"></td></tr>
            <tr>
            <td>
            <table class="product-mainhg" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <!---->
            <td>
            <table class="fgdfg" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td>
            <table class="product-image" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr><td><a href="http://127.0.0.1:8000/restaurant-for-sale/'.$obj->bheadlinead.'/'.$listingId.'"><img class="listing-img-two" height="152" width="226" src="'.$resized_image.'" alt=""/></a></td></tr>
            </table>
            </td>
            <td>
            <table class="product-content" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr><td style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #000;">Price: <span style="color:#e70033;">$'.number_format(round($obj->bsaleprice)).'</span></td>
            </tr>
            <tr><td style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #000;">Sales: <span style="color:#e70033;">$'.number_format(round($obj->grossSales)).'</span></td>
            </tr>
            '.$earning.'
            <tr><td style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #e70033;">'.$city.'</td>
            </tr>
            </table>
            </td>
            </tr>

            </table>
            </td>
            <!---->

            <!---->
            <td>
            <table class="fgdfg" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td>
            <table class="product-image middle" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td align="center"><a href="http://127.0.0.1:8000/restaurant-for-sale/'.$obj->bheadlinead.'/'.$listingId.'"><img style="width:80px !important;" src="http://dev.demo-swapithub.com/Email-resturant/images/more-info.jpg" alt=""/></a>
            <p style="font-size: 13px;
            font-weight: 800;
            margin: 0;
            text-align:center;font-family: Montserrat, sans-serif;">Listing # '.$listingId.'</p>
            </td></tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            <td>
            <table class="fgdfg" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td>
            <table class="product-content" align="right" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr><td align="right" style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #000;">Contact</td>
            </tr>
            <tr><td align="right" style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #000;">'.$listingAgent.'</td>
            </tr>
            <tr><td align="right" style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #000;">Call-Text</td>
            </tr>
            <tr><td align="right" style="font-size: 17px;
            font-weight: bold;
            font-family: Montserrat, sans-serif;
            color: #000;"><a style="text-decoration:none;color:#000;" href="tel:'.$ag_phone.'">'.$ag_phone.'</a></td>
            </tr>
            </table>
            </td>
            <td>
            <table class="product-image last" align="right" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr><td align="right">
              <!--[if gte mso 9]>
               <v:roundrect                     
              xmlns:v="urn:schemas-microsoft-com:vml"   
              xmlns:w="urn:schemas-microsoft-com:office:word"       
              arcsize="50%"   
              href="http://127.0.0.1:8000/office.php?id='.$obj->olagent.'"                          
              style="height:110px;width:110px;" 
              >
              <v:fill type="frame"      
                style="height:110px;width:110px;"
                src="http://127.0.0.1:8000/resizeimg/'.$agentimg.'" />                          
                </v:roundrect>
              <![endif]-->
              <!--[if !mso]> <!---->
             <a href="http://127.0.0.1:8000/office.php?id='.$obj->olagent.'" ><img class="listing-img" align="center" src="http://127.0.0.1:8000/resizeimg/'.$agentimg.'" style="border-radius:50%;" height="110" width="110" /></a>
             <!-- <![endif]--></td></tr></table></td></tr></table></td><!---->
            </tr>
            </table>
            </td>
            </tr>
            <tr><td height="15"></td></tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>';
            return $html;
        }

    }

    public function drawNews($template=''){
        $html = '';
        $html .= '<ul>';
        $curlBlog= base64_decode('aHR0cDovL2Jsb2cud2VzZWxscmVzdGF1cmFudHMuY29tL3Jzcy54bWw=');
        $curlBlog = "https://blog.wesellrestaurants.com/rss.xml";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlBlog);    // get the url contents
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch); // execute curl request
        $xml = simplexml_load_string($data);
        curl_close($ch);
        $c = 0;
        if($template !=''){
            $d=1;
        }else{
            $d=2;
        }
        foreach($xml->channel->item as $key => $indItemArray ){
            if($c < $d){
                $link = $indItemArray->link;
                $title = $indItemArray->title;
                $description = $indItemArray->description;
                preg_match_all('/<img[^>]+>/i',$description, $result);
                $imgtag = $result[0][0];
                $des = strip_tags($description);
                $des = substr($des,0,45).'..';
                preg_match_all('/(src)=("[^"]*")/i',$imgtag, $img);
                $src = $img[2][0];
                $src=str_replace('"','',$src);
                $aDate = date('M d, Y', strtotime($indItemArray->pubDate));   
                $html .= '<li>';
                if($template ==''){
                    $html .= '<div class="ftr-txt">'.$title.'</div>
                                 <span class="meta-data">'.$aDate.'</span>';
                    if(strlen(trim($des)) != 0){
                        $html .= ' <div class="ftr-read-more">'.$des.' <a target="_blank" href="'.$link.'"> read More</a> </div>'; 
                        $html .= ' </li>';
                        $html .= '</ul>';
                    }
                }else{
                
                        $des = strip_tags($description);
                        $des = substr($des,0,1).'..';
                        if(strlen(trim($des)) != 0){
                         $html = '<span style="font-size: 14px; color: #333; vertical-align: top; font-family: sans-serif">'.$title.' '.$des.'<a target="_blank" href="'.$link.'"> READ MORE</a></span>'; 
                        }
                }
                    
            }
                     $c++;
        }
    
        return $html;
    }

    public function getListingDetail(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            $list = Listing::whereIn('id', explode(',', $request->id))->with(['agent' => function($agent){ $agent->select('id', 'firstname as agent_firstname', 'lastname as agent_lastname', 'email as agent_email');}])->with(['listing_headlines' => function($agent){ $agent->select('id','listing_id','adline1 as subject');}])->select('id', 'olagent', 'bname as email_name', 'bstatuslist')->get();
            if($list->isEmpty()){
                return response()->json(['message'=>'error','code'=>'302','data'=>'Listing not found.']);
            }
            foreach($list as $key=>$value){
                if($value->bstatuslist == 'Coming Soon' || $value->bstatuslist == 'Cancelled' || $value->bstatuslist == 'Sold' || $value->bstatuslist == 'Expired'){
                    return response()->json(['message'=>'error','code'=>'302','data'=>'Make sure the listing is not in the Status of Coming Soon, Cancelled, Sold or Expired.']);
                }
            }
            return response()->json(['message'=>'success','code'=>'200','data'=>$list]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

     public function getTemplateResponsive(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'emlformat' => 'required',
                'listing_ids' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

           $listingIds = explode(',', $request->listing_ids);
           $listData = ListingBat::where('listing_id', $listingIds[0])->first();
           if(empty($listData)){
            return response()->json(['message'=>'error','code'=>'302','data'=>'data not found!']);
           }

           $grossSales = $listData->grossSales;

           $totalCOGS = $listData->foodCosts+$listData->alcohalCosts+$listData->otherCogs;

           $grossMargin = $grossSales-$totalCOGS;

           $totalExpenses = $listData->advertising + $listData->auto + $listData->bankCharges + $listData->creditCardFees + $listData->depreciation + $listData->duesSubscriptions + $listData->insurance + $listData->interestExpense + $listData->legal +$listData->licensesFees + $listData->miscellaneous + $listData->payrollTaxes + $listData->postageDelivery + $listData->ownerPersonalExpenses + $listData->rent + $listData->repairsMaintenance + $listData->restaurantSupplies + $listData->royalties + $listData->salariesWages + $listData->telephone + $listData->utilities + $listData->uniforms + $listData->otherUncategorized + $listData->officeSupplies + $listData->janitorial + $listData->equipmentlease + $listData->donations + $listData->filledfieldvalue;

           $netIncome = $grossMargin - $totalExpenses;

           $totalAddBacks = $listData->ownerSalary + $listData->benefits + $listData->interestExpense1 + $listData->depreciation1 + $listData->ownerPersonalExpenses1 + $listData->other;

           $ownerBenefit = $netIncome + $totalAddBacks;
           $ownerBenefit = 0;
           if($ownerBenefit !=''){
                if($ownerBenefit == 0){
                    if($request->emlformat == 5){
                        return response()->json(['message'=>'error','code'=>'302','data'=>"You must select ART responsive because Owner Benefits is Zero."]);
                    }
                }
                if($ownerBenefit > 0){
                    if($request->emlformat == 6){
                        return response()->json(['message'=>'error','code'=>'302','data'=>"You must select BAT responsive because Owner Benefits greater than Zero."]);
                    }
                }
            }
        return response()->json(['message'=>'success','code'=>'200','data'=>[]]);
        }catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
     }

    public function getCampaignDetail(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'listing_id'=> 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }

            $data = Campaign::where('id',$request->id)->first();


            $check = Listing::whereIn('id',explode(',',$request->listing_id))->get();

            $listing ='';

            foreach($check as $key=>$value){
                if(in_array($value->bstate, explode(',',$data->cstate))){
                }else{
                    $listing .=$value->id.','; 
                }
            }
            $listing = trim($listing, ',');
            if($listing != ''){
                 return response()->json(['message'=>'error','code'=>'302','data'=>'Listing '. $listing .' does not match to Campaign '.$data->cstate.'. Please correct.']);
            }
            if(!empty($data)){
                $CampaignList = CampaignList::whereIn('id',explode(',',$data->campainglist))->get();

                $lists='';
                foreach($CampaignList as $key=>$value){
                    $lists .=$value->campaignlist.','; 
                }
                $lists = trim($lists, ',');

                $data->lists = $lists;
            }else{
                return response()->json(['message'=>'error','code'=>'302','data'=>'Campaign not found.']);
            }

            return response()->json(['message'=>'success','code'=>'200','data'=>$data]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function requestAdvertisingEmail(Request $request){
        try{
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'agent' => 'required',
                'listing_id' => 'required',
                'campaign_id' => 'required',
                'send_date' => 'required',
                'agent_name' => 'required',
                'agent_email' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }
            
            $data = $data = BuildAdemail::create([
                'agentid' => $request->agent,
                'listings' => $request->listing_id,
                'senddate' => $request->send_date,
                'campaignname' => $request->campaign_id,
                'user_type' => $user->type,
                'date_time' => Carbon::now()->format('Y-m-d')
            ]);
            return response()->json(['message'=>'success','code'=>'200','data'=>$data]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }

    public function requestNonStandardEmail(Request $request){
        try{
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'agent' => 'required',
                'listing_id' => 'required',
                'non_standard' => 'required',
                'send_date' => 'required',
                // 'head_line_ad_1' => 'required',
                // 'head_line_ad_2' => 'required',
                // 'head_line_ad_3' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(['message'=>'error','code'=>'302','data'=>$validator->errors()]);
            }
            $check = BuildAdemail::where('listings', $request->listing_id)->first();

            if(!empty($check)){
                return response()->json(['message'=>'error','code'=>'302','data'=>'Listing Already Exist.']);
            }

            $data = $data = BuildAdemail::create([
                'agentid' => $request->agent,
                'listings' => $request->listing_id,
                'senddate' => $request->send_date,
                'non_standard' => $request->non_standard,
                'headlinead1' => isset($request->head_line_ad_1)?$request->head_line_ad_1:null,
                'headlinead2' => isset($request->head_line_ad_2)?$request->head_line_ad_2:null,
                'headlinead3' => isset($request->head_line_ad_3)?$request->head_line_ad_3:null,
                'user_type' => $user->type,
                'date_time' => Carbon::now()->format('Y-m-d')
            ]);

            return response()->json(['message'=>'success','code'=>'200','data'=>$data]);

        } catch (\Exception $e) {
            return response()->json(['message'=>'error','code'=>'302','data'=>$e->getMessage()]);
        }
    }
}
