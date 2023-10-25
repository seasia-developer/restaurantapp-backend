<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\BlogCategory;
use App\Models\Buyers;
use App\Models\CaBuyers;
use App\Models\Country;
use App\Models\Listing;
use App\Models\ListingCategory;
use App\Models\ListingFilterType;
use App\Models\ListingMediaSubImages;
use App\Models\ListingState;
use App\Models\SearchCategory;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userDashboardController extends Controller
{
    public function search(Request $request)
    {
        try {
            $bstatus = array('Available', 'In Contract', 'LOI','Available Not Advertised');
            $limit = $request->limit ? $request->limit : 50;

            $listing = Listing::query();
            $listings = Listing::where('id', $request->search)->with('listing_media')->count();

            if ($listings > 0) {
                $listing = $listing->where('id', $request->search)->with('listing_media', 'listingState');

            }
            if ($request->state) {
                $listing = $listing->where('bstate', 'LIKE', '%' . $request->state . '%')->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_Category','listing_bat');
            }

            if ($request->btype) {
                $listing = $listing->where('btype', 'LIKE', '%' . $request->btype . '%')->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_Category','listing_bat');
            }

            //sq.ft

            if ($request->type == 'linsidesqt') {

                $min = intval($request->min);
                $max = intval($request->max);

                $listing = Listing::with('listing_occupancy_lease', 'listing_media', 'listingState', 'Listing_Category','listing_bat')
                    ->Where('bstate', 'like', "%{$request->state}%")
                // ->orWhere('btype', 'like', "%{$request->btype}%")

                    ->whereHas('listing_occupancy_lease', function ($q)
                         use ($min, $max) {
                            $q->WhereBetween('linsidesqt', [$min, $max]);
                        })
                ;

            }

            //bsaleprice   price point
            if ($request->type == 'bsaleprice') {
                $min = intval($request->min);
                $max = intval($request->max);

                $listing = $listing
                    ->WhereBetween('bsaleprice', [$min, $max])
                    ->orWhere('bsaleprice', $min)
                    ->Where('bstate', 'like', "%{$request->state}%")
                    ->Where('btype', 'like', "%{$request->btype}%")

                    ->with('listing_occupancy_lease', 'listing_media', 'listingState', 'Listing_Category','listing_bat');

            }

            //grosssale

            if ($request->type == 'grossSales') {
                $min = intval($request->min);
                $max = intval($request->max);

                $listing =Listing::
                    with('listing_bat','listing_occupancy_lease', 'listing_media', 'listingState',  'Listing_Category')

                    ->whereHas('listing_bat', function ($q)
                         use ($min, $max) {
                            $q->WhereBetween('grossSales', [$min, $max]);
                        })

                 
                        ->Where('bstate', 'like', "%{$request->state}%")
                        // ->Where('btype', 'like', "%{$request->btype}%")
                ;
            }

            if ($request->type == 'owner_benefit') {
                $min = intval($request->min);
                $max = intval($request->max);

                $listing = Listing::
                with('listing_occupancy_lease', 'listing_media', 'listingState', 'listing_bat', 'Listing_Category')
                    ->WhereHas('listing_bat', function ($q)
                         use ($min, $max) {
                            $q->whereBetween('benefits', [$min, $max]);
                        });

            } else {
                $listing = $listing->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_category');

            }
            

            if ($listing->get()->isEmpty()) {
                return response()->json(['data' => 'No Listing Found']);
            } else {

                $listing = $listing->WhereIn('bstatuslist', $bstatus)->where('activate', '1');

                if($request->filled('orderByCol')&& $request->filled('orderBy')){

                    $listing = $listing->orderBy($request->orderByCol ,$request->orderBy);
                    
                }  
            }
            $listing = $listing->paginate($limit);
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $listing]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function blogListing(Request $request, $blogurl)
    {

        try {
            $bstatus = array('Available', 'In Contract', 'LOI','Available Not Advertised');


            $listings = Listing::WhereIn('bstatuslist', $bstatus)->where('activate', '1')->get();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $listings]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function listingView(Request $request, $slug, $id)
    {

        try {
            $slug = str_replace('-', ' ', $slug);
            $listings = Listing::where('bheadlinead', $slug)->where('id', $id)->with('listing_ops', 'listing_headlines', 'listing_occupancy_lease', 'listing_media', 'listingState')->first();

            $agent = 0;
            $agent_img = 0;
            if (!empty($listings->olagent)) {
                $agent = Agents::where('id', $listings->olagent)->select('id', 'user_id', 'title', 'firstname', 'email', 'cellphone','state')->with('agentState')->first();

            }
            if(!empty($agent)){
                $agent_img = User::where('id', $agent->user_id)->select('img')->first();


            }

            
            $listingView = Listing::where('bheadlinead', $slug)->where('id', $id)->with('listing_bat')->first();
            $grossSales = 0;
            $ownerBenefit = 0;

            if (!empty($listingView->listing_bat)) {

                $grossSales = $listingView->listing_bat->grossSales;

                $totalCOGS = $listingView->listing_bat->foodCosts + $listingView->listing_bat->alcohalCosts + $listingView->listing_bat->otherCogs;

                $grossMargin = $grossSales - $totalCOGS;

                $totalExpenses = $listingView->listing_bat->advertising + $listingView->listing_bat->auto + $listingView->listing_bat->bankCharges + $listingView->listing_bat->creditCardFees + $listingView->listing_bat->depreciation + $listingView->listing_bat->duesSubscriptions + $listingView->listing_bat->insurance + $listingView->listing_bat->interestExpense + $listingView->listing_bat->legal + $listingView->listing_bat->licensesFees + $listingView->listing_bat->miscellaneous + $listingView->listing_bat->payrollTaxes + $listingView->listing_bat->postageDelivery + $listingView->listing_bat->ownerPersonalExpenses + $listingView->listing_bat->rent + $listingView->listing_bat->repairsMaintenance + $listingView->listing_bat->restaurantSupplies + $listingView->listing_bat->royalties + $listingView->listing_bat->salariesWages + $listingView->listing_bat->telephone + $listingView->listing_bat->utilities + $listingView->listing_bat->uniforms + $listingView->listing_bat->otherUncategorized + $listingView->listing_bat->officeSupplies + $listingView->listing_bat->janitorial + $listingView->listing_bat->equipmentlease + $listingView->listing_bat->donations + $listingView->listing_bat->filledfieldvalue;

                $netIncome = $grossMargin - $totalExpenses;

                $totalAddBacks = $listingView->listing_bat->ownerSalary + $listingView->listing_bat->benefits + $listingView->listing_bat->interestExpense1 + $listingView->listing_bat->depreciation1 + $listingView->listing_bat->ownerPersonalExpenses1 + $listingView->listing_bat->other;

                $ownerBenefit = $netIncome + $totalAddBacks;

            }

            $listing[] = array(
                'listing' => $listings,
                'grossSales' => $grossSales,
                'ownerBenefit' => $ownerBenefit,
                'agents' => $agent,
                'agent_img' => $agent_img,

            );

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $listing]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function agentlist(Request $request, $agentId)
    {
        try {
            $bstatuslist = array('In Contract', 'LOI', 'Available', 'Coming Soon','Available Not Advertised');
            $limit = $request->limit ? $request->limit : 50;

            $agent = Listing::where('olagent', $agentId)->
            WhereIn('bstatuslist', $bstatuslist)->where('activate', '1')->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_Category')->paginate($limit);
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $agent]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }

    public function brokerDetails(Request $request, $agentId)
    {
        try {
            $limit = $request->limit ? $request->limit : 50;


            $agent = Agents::where('id', $agentId)->select('id','user_id','firstname','lastname','email','title','img','officephone','fax','agentdes','state')->with('agentState')
            ->with(['users' => function ($user) {$user->select('id', 'img');}])
            ->paginate($limit);

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $agent]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }
  
    public function Recommended(Request $request)
    {
        try {
            $bstatuslist = array('In Contract', 'LOI', 'Available', 'Coming Soon','Available Not Advertised');

            $listing = Listing::where('bstate', $request->state)->whereIn('bstatuslist', $bstatuslist)->where('activate', 1)->take(3)->with('listing_media', 'listing_occupancy_lease')->with(['listingState' => function ($state) {$state->select('id', 'name', 'short_code');}])->get();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $listing]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function state()
    {
        try {
            $state = ListingState::select('short_code', 'name')->get();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $state]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }
    public function Country()
    {
        try {
            $Country = Country::select('name')->get();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $Country]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function ListingCategory()
    {
        try {
            $btype = ListingCategory::select('id', 'name')->get();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $btype]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function listingFilter()
    {
        try {
            $stype = ListingFilterType::select('id', 'name')->get();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $stype]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }

    public function filterDetails(Request $request)
    {
        try {
            $bstatuslist = array('In Contract', 'LOI', 'Available', 'Coming Soon','Available Not Advertised');
            $limit = $request->limit ? $request->limit : 50;

            if ($request->sfilter == !null) {

                $filterlist = Listing::where('filtertype', 'LIKE', '%' . $request->sfilter . '%')->whereIn('bstatuslist', $bstatuslist)->where('activate', 1)->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_category')->paginate($limit);
                return response()->json(['status' => 'success', 'code' => '200', 'data' => $filterlist]);
            } else {
          
                $filterlist = Listing::whereIn('bstatuslist', $bstatuslist)->where('activate', 1)->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_category')->paginate($limit);
                return response()->json(['status' => 'success', 'code' => '200', 'data' => $filterlist]);

            }

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }

    public function recentySold()
    {
        try {
            $title = Listing::select('id', 'bheadlinead')->where('bstatuslist', 'sold')->orderBy('bsolddate', 'desc')->take(5)->latest()->with('listing_media')->get();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $title]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function listingSold()
    {
        try {
            $finished = Listing::where('bstatuslist', 'sold')->orderBy('bsolddate', 'desc')->with('listing_media')->get();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $finished]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function latest()
    {
        try {
            // $url = 'https://blog.wesellrestaurants.com/rss.xml';

            // $ch = curl_init();
            // // Disable SSL verification
            // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
            // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            // curl_setopt( $ch, CURLOPT_URL, $url );

            // $result = curl_exec( $ch );
            // curl_close( $ch );
            // // $json = json_encode( $result );
            // // print_r( json_decode( $json, true ) );

            // return  $result;
            $url = 'https://blog.wesellrestaurants.com/rss.xml';

            $cURL = curl_init();

            curl_setopt($cURL, CURLOPT_URL, $url);
            curl_setopt($cURL, CURLOPT_HTTPGET, true);
            curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
            ));

            $result = curl_exec($cURL);
            curl_close($cURL);
            // return $result;
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $result]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }

    //menu list api

    public function companyMenu($stitle)
    {
        $stitle = str_replace('-', ' ', $stitle);

        try {
            $companys = SearchCategory::where('page_seo_title', $stitle)->count();

            if ($companys > 0) {
                $companylist = SearchCategory::where('page_seo_title', $stitle)->get();
                foreach ($companylist as $company) {
                    $cid = $company->id;
                    $seo_title = $company->page_seo_title;
                    $seo_content = $company->page_seo_content;
                    $quick_info = $company->quick_info;
                }

                $blogs = BlogCategory::where('cat_id', $cid)->get();

                $category[] = array(
                    'cat_id' => $cid,
                    'seo_title' => $seo_title,
                    'seo_content' => $seo_content,
                    'quick_info' => $quick_info,
                    'blog' => $blogs,

                );

                return response()->json(['status' => 'success', 'code' => '200', 'data' => $category]);
            } else {
                return response()->json(['status' => 'ok', 'code' => '404', 'data' => 'no record found']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function testimonials(Request $request)
    {
        try {
            $limit = $request->limit ? $request->limit : 10;

            $testimonial = Testimonial::orderBy('id', 'desc')->paginate($limit);

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $testimonial]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function mapfilter()
    {
        try {
            $state = Agents::where('isTypeAO', 'O')->where('status', '1')->pluck('state')->toArray();

            $states = ListingState::whereIn('short_code', $state)->get();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $states]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function confirmAgreement($listingid)
    {

        try {

            $user = Auth::user();

            $date = Carbon::now()->format('F' . ' d ,Y , H:i');
            $clientIP = request()->getClientIp();
            $listing = $listingid;

            $description = Listing::where('id', $listing)->first();

            $agreement[] = array(
                'Date & Time' => $date,
                'Name' => $user->username ? $user->username : null,
                'email' => $user->email ? $user->email : null,
                'Computer Id' => $clientIP,
                'listing' => $listing,
                'Description' => $description->burldes ? $description->burldes : null,
                'sold_status' => $description->bstatuslist ? $description->bstatuslist : null,

            );

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $agreement]);

        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function insertBuyerCA(Request $request, $listingId)
    {

        try {
            $users = Auth::user();

            $status = Buyers::where('user_id', $users->id)->where('activate', 'Y')->first();

            $listings = Listing::where('id', $listingId)->with(['agent' => function ($agent) {$agent->select('id', 'user_id', 'title', 'firstname', 'lastname', 'lastname', 'email', 'address', 'city', 'cellphone', 'img');}])->first();
            $media = ListingMediaSubImages::where('listing_id', $listingId)->select('id', 'sub_img_file')->get();

            $user = null;
            $agent_id = null;
            if (!empty($listings->agent)) {
                $user = User::where('id', $listings->agent->user_id)->select('id', 'username', 'img')->first();
                $agent_id =$listings->agent->id ;
            }

            $listing[] = array(
                'listing' => $listings,
                'agent_img' => $user,
                'listing_Submedia' => $media ? $media : null,
                'user_name' => $users->username ? $users->username : null,
                'user_email' => $users->email ? $users->email : null,
            );

            if (!empty($status)) {
                $Buyer = new CaBuyers();
                $date = Carbon::now()->format('Y-m-d H:i');

                $ca_buyer = CaBuyers::where('buyer_id', $status->id)->where('listing_id', $listingId)->first();

                
                if (empty($ca_buyer)) {

                    $Buyer->listing_id = $listingId;
                    $Buyer->buyer_id = $status->id;
                    $Buyer->agentid = $agent_id;
                    $Buyer->lastviewdate = $date;
                    $Buyer->firstviewdate = $date;
                    $Buyer->nosigned = '1';
                    $Buyer->save();
                    return response()->json(['status' => 'success', 'code' => '200', 'data' => $listing]);
                }
                $Buyer = CaBuyers::find($ca_buyer->id);
                $nosigned_Val =$Buyer->nosigned;

                $Buyer->firstviewdate = $date;
                $Buyer->lastviewdate = $date;
                $Buyer->nosigned = ($nosigned_Val + 1);

                $Buyer->update();
                return response()->json(['status' => 'success', 'code' => '200', 'data' => $listing]);
            } else {
                return response()->json(['message' => 'error', 'code' => '302', 'data' => 'Please wait for admin approval of your account !']);

            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }

    }

    public function RestaurantSale(Request $request, $sale)
    {
        try {
            $limit = $request->limit ? $request->limit : 50;
            $slug = str_replace('-', ' ', $request->sale);

            $Cat_id = ListingCategory::Where('name', $slug)->first();

            $bstatus = array('Available', 'In Contract', 'LOI','Available Not Advertised');

            if (!empty($Cat_id->id)) {
                $listing = Listing::Where('cat_tag', 'LIKE', '%' . $Cat_id->id . '%')->whereIn('bstatuslist', $bstatus)->where('activate', 1)->with('Listing_Category')->with(['listing_occupancy_lease' => function ($lease) {$lease->select('id', 'listing_id', 'lterm', 'linsidesqt', 'loutsidesqt', 'ltotalmonthrent');}])->with(['listingState' => function ($state) {$state->select('id', 'name', 'short_code');}])->with(['listing_media' => function ($media) {$media->select('id', 'listing_id', 'img_file', 'video');}]);

            } else {
                $limit = $request->limit ? $request->limit : 50;
                $listing = Listing::whereIn('bstatuslist', $bstatus)->where('activate', 1)->with('Listing_Category')->with(['listing_occupancy_lease' => function ($lease) {$lease->select('id', 'listing_id', 'lterm', 'linsidesqt', 'loutsidesqt', 'ltotalmonthrent');}])->with(['listingState' => function ($state) {$state->select('id', 'name', 'short_code');}])->with(['listing_media' => function ($media) {$media->select('id', 'listing_id', 'img_file', 'video');}]);

            }
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $listing->paginate($limit)]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);
        }
    }

    public function certified()
    {
        try {

            $bstatus = array('Available', 'In Contract', 'LOI','Available Not Advertised');


            $certified = Listing::where('bgradelist', 'Certified Pre-Owned')->WhereIn('bstatuslist', $bstatus)->where('activate', '1')->with('listing_media', 'listing_occupancy_lease', 'listingState', 'Listing_Category')->get();
            return response()->json(['status' => 'success', 'code' => '200', 'data' => $certified]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);        }
    }

    public function agentOffice(){
        try {

            $agentOffice =Agents::where('isTypeAO','O')->where('status','1')->select('id','Franchisename')->get();

            return response()->json(['status' => 'success', 'code' => '200', 'data' => $agentOffice]);


        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'code' => '302', 'data' => $e->getMessage()]);        }
    }
  

    

   

}
