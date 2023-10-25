<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingPrice;
use App\Models\TrackOnListingStatus;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PriceChangeReport;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PriceChangeReportController extends Controller
{
    public function index(Request $request){
        try {
            if(isset($request->per_page) && $request->per_page <= 24) {
                $per_page = $request->per_page;
                $page = $request->page;
            } else {
                $per_page = 10;
                $page = 0;
            }

            $page = isset($request->page) ? $request->page : 1; // Get the page=1 from the url
            $perPage = isset($request->per_page) ? $request->per_page : 10; // Number of items per page
            $offset = ($page * $perPage) - $perPage;

            $total_rec = 0;

            // $result = DB::select("SELECT l.id as list_id,l.bname as bname,lp.* FROM listing_prices as lp left join listing as l on(lp.listing_id=l.id) order by current_date desc ");
            
            $result = ListingPrice::select('listing_prices.*','l.id as list_id','l.bname as bname')
            ->leftJoin('listing as l', 'l.id', '=', 'listing_prices.listing_id')->paginate(10);
            // return $result;
            // dd(count($result));
		    // $l_status = DB::select("SELECT MAX(lst.id),lst.*,l.bname,l.id as list_id,l.bsaleprice,lst.bstatus,lst.fromstatus FROM track_on_listingstatus as lst left join listing as l on (lst.listing_id=l.id) group by lst.id  order by lst.id  NOT IN (SELECT pri.id FROM listing_prices as pri WHERE pri.listing_id = l.id)" );
            
            $l_status = TrackOnListingStatus::select('track_on_listingstatus.*', 'listing_prices.*', 'l.bname','l.id as list_id','l.bsaleprice')
            ->leftJoin('listing as l', 'l.id', '=', 'track_on_listingstatus.listing_id')
            ->leftJoin('listing_prices', 'listing_prices.listing_id','=','track_on_listingstatus.listing_id')->paginate(10);

$collected = $result->union($l_status);

$items = (collect($collected))->paginate(15);
return $items;
//print_r($collected);die('3');
      
            $dataArr = [];
            $dataArr = [
                'result' => $result,
                'l_status' => $l_status
            ];
            return $dataArr;

            $abc = [];
            $orders_collection = array_merge($abc,$dataArr);
            return $orders_collection;
            // $orders_collection = new Collection($dataArr); // needs a use statement
            // return $orders_collection;
            // $orders_collection = collect($dataArr); // alternative. You can use helper function
            // return $orders_collection;
            // $current_page_orders = $orders_collection->slice(($page - 1) * $perPage, $perPage)->all(); // slice($offset, $number_of_item)
            // return $current_page_orders;
            // $entries =  new LengthAwarePaginator(
            //     array_slice($dataArr, $offset, $perPage, true),
            //     count($dataArr), // Total items
            //     $perPage, // Items per page
            //     $page, // Current page
            //     ['path' => $request->url(), 'query' => $request->query()] 
            //     // We need this so we can keep all old query parameters from the url
            // );
            // return $entries;
            // $data_page = $this->paginate_arr($dataArr);
            // return $data_page;
            // return $data2;
            // $menuItems = array_slice( $data2, 1, 3 );
            // return $menuItems;

            if(isset($request->search) && !empty($request->search)){
                $date_filter = $request->search;
                $resDate= explode('/', $date_filter);   
                $from = $resDate[0];
                $to = $resDate[1];
                $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname from listing l left join listing_prices as lp on lp.listing_id=l.id left join track_on_listingstatus as ts on ts.listing_id=l.id left join agents as a on a.id=ts.agent_id where (ts.from_date BETWEEN '".$from."' and '".$to."')  LIMIT ".$per_page." OFFSET ".$page ) );

                // $result = DB::select("SELECT l.*,lp.* FROM listing_prices as lp left join listing as l on(lp.listing_id=l.id) WHERE  (lp.current_date > '".$from."' && lp.current_date < '".$to."')order by current_date desc LIMIT ".$per_page." OFFSET ".$page );

		        // $l_status = DB::select("SELECT MAX(lst.id),lst.*,l.bname,l.id,l.bsaleprice,lst.bstatus,lst.fromstatus FROM track_on_listingstatus as lst left join listing as l on (lst.listing_id=l.id) where  (lst.bstatus ='Expired' || lst.bstatus='Cancelled' ) AND   (lst.to_date > '".$from."' && lst.to_date < '".$to."')  group by lst.listing_id order by lst.id NOT IN (SELECT pri.id FROM listing_prices as pri WHERE pri.listing_id = l.id) LIMIT ".$per_page." OFFSET ".$page );

                // $data = [
                //     'result' => $result,
                //     'l_status' => $l_status
                // ];
                // return $data;

                $count_rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname from listing l left join listing_prices as lp on lp.listing_id=l.id left join track_on_listingstatus as ts on ts.listing_id=l.id left join agents as a on a.id=ts.agent_id where (ts.from_date BETWEEN '".$from."' and '".$to."')  "));
                $total_rec = count($count_rawQry);
            } 
            elseif(isset($request->agent) && !empty($request->agent)){
                $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname from listing l  join listing_prices as lp on lp.listing_id=l.id  join track_on_listingstatus as ts on ts.listing_id=l.id  join agents as a on a.id=ts.agent_id where ts.agent_id=".$request->agent." LIMIT ".$per_page." OFFSET ".$page ) );

                // $result = DB::select("SELECT l.*,lp.* FROM listing_prices as lp left join listing as l on(lp.listing_id=l.id) order by current_date desc LIMIT ".$per_page." OFFSET ".$page );

		        // $l_status = DB::select("SELECT MAX(lst.id),lst.*,l.bname,l.id,l.bsaleprice,lst.bstatus,lst.fromstatus FROM track_on_listingstatus as lst left join listing as l on (lst.listing_id=l.id) where lst.agent_id = ".$request->agent." group by lst.id  order by lst.id  NOT IN (SELECT pri.id FROM listing_prices as pri WHERE pri.listing_id = l.id) LIMIT ".$per_page." OFFSET ".$page );

                // $data = [
                //     'result' => $result,
                //     'l_status' => $l_status
                // ];

                $count_rawQry = $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname from listing l  join listing_prices as lp on lp.listing_id=l.id  join track_on_listingstatus as ts on ts.listing_id=l.id  join agents as a on a.id=ts.agent_id where ts.agent_id=".$request->agent ));
                $total_rec = count($count_rawQry);
            } 
            elseif( (isset($request->agent) && !empty($request->agent)) && (isset($request->search) && !empty($request->search) )){
                $date_filter = $request->search;
                $resDate= explode('/', $date_filter);   
                $from = $resDate[0];
                $to = $resDate[1];

                // $result = DB::select("SELECT l.*,lp.* FROM listing_prices as lp left join listing as l on(lp.listing_id=l.id) WHERE  (lp.current_date > '".$from."' && lp.current_date < '".$to."')order by current_date desc LIMIT ".$per_page." OFFSET ".$page );

		        // $l_status = DB::select("SELECT MAX(lst.id),lst.*,l.bname,l.id,l.bsaleprice,lst.bstatus,lst.fromstatus FROM track_on_listingstatus as lst left join listing as l on (lst.listing_id=l.id) where lst.agent_id=".$request->agent." where  (lst.bstatus ='Expired' || lst.bstatus='Cancelled' ) AND   (lst.to_date > '".$from."' && lst.to_date < '".$to."')  group by lst.listing_id order by lst.id NOT IN (SELECT pri.id FROM listing_prices as pri WHERE pri.listing_id = l.id) LIMIT ".$per_page." OFFSET ".$page );

                // $data = [
                //     'result' => $result,
                //     'l_status' => $l_status
                // ];

                
                $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname from listing l  join listing_prices as lp on lp.listing_id=l.id  join agents as a on a.id=ts.agent_id  join track_on_listingstatus as ts on ts.listing_id=l.id where ts.agent_id=".$request->agent." AND (ts.from_date BETWEEN '".$from."' and '".$to."')  LIMIT ".$per_page." OFFSET ".$page ) );

                $count_rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname from listing l  join listing_prices as lp on lp.listing_id=l.id  join agents as a on a.id=ts.agent_id  join track_on_listingstatus as ts on ts.listing_id=l.id where ts.agent_id=".$request->agent." AND (ts.from_date BETWEEN '".$from."' and '".$to."')" ));
                $total_rec = count($count_rawQry);
            }
            else {
                $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname  from listing l  join listing_prices as lp on lp.listing_id=l.id  join track_on_listingstatus as ts on ts.listing_id=l.id  join agents as a on a.id=ts.agent_id  LIMIT ".$per_page." OFFSET ".$page ) );
                // return $rawQry;

                // $today = date("Y-m-d");
                // $date = date('Y-m-d', strtotime($today . ' -31 day'));

                // $result = DB::select(((("SELECT l.*,lp.* FROM listing_prices as lp left join listing as l on(lp.listing_id=l.id) order by current_date desc"))));
                  

                // $l_status = DB::select(("SELECT MAX(lst.id),lst.*,l.bname,l.id,l.bsaleprice,lst.bstatus,lst.fromstatus FROM track_on_listingstatus as lst left join listing as l on (lst.listing_id=l.id) group by lst.id order by lst.id NOT IN (SELECT pri.id FROM listing_prices as pri WHERE pri.listing_id = l.id)"));

                // $data = [
                //     'result' => $result,
                //     'l_status' =>$l_status
                // ];
                // return ($data);

                $count_rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,ts.agent_id,a.id as agent,a.firstname,a.lastname  from listing l  join listing_prices as lp on lp.listing_id=l.id  join track_on_listingstatus as ts on ts.listing_id=l.id  join agents as a on a.id=ts.agent_id"));
                $total_rec = count($count_rawQry);
            }
            return response()->json([ 'message'=>'success','code'=>'200','data'=>$rawQry,'total'=>$total_rec ]);
        } catch(\Exception $e){
            return response()->json([ 'message'=>'error','code'=>'302','data'=>$e->getMessage() ]);
        }
    }
    public function download(Request $request){
        try{
            $dataArr = array();
            if(isset($request->track_status_id) || $request->track_status_id != ''){
                foreach($request->track_status_id as $key=>$val){
                    $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,a.firstname,a.lastname from listing l join listing_prices as lp on lp.listing_id=l.id join track_on_listingstatus as ts on ts.listing_id=l.id  join agents as a on a.id=ts.agent_id where ts.id=".$val." ") );
                    if(count($rawQry) > 0){
                        foreach($rawQry as $key=>$val){
                            $data = array($val->listing_id, $val->firstname .' ' . $val->lastname, $val->bname, $val->fromstatus, $val->bstatus, $val->price, $val->new_price, $val->from_date);
                            array_push($dataArr, $data);
                        }
                    }
                }
            } else {
                $rawQry = DB::select(DB::raw("Select l.id as listing_id,l.bname,l.created_at,lp.id as list_price_id,lp.listing_id,lp.price,lp.new_price,lp.current_date,ts.id as track_status_id,ts.listing_id,ts.bstatus,ts.fromstatus,ts.from_date,ts.to_date,a.firstname,a.lastname from listing l join listing_prices as lp on lp.listing_id=l.id join track_on_listingstatus as ts on ts.listing_id=l.id join agents as a on a.id=ts.agent_id ") );
                if(count($rawQry) > 0){
                    foreach($rawQry as $key=>$val){
                        $data = array($val->listing_id, $val->firstname .' ' . $val->lastname, $val->bname, $val->fromstatus, $val->bstatus, $val->price, $val->new_price, $val->from_date);
                        array_push($dataArr, $data);
                    }
                }
            }
            $now = date('m-d-Y');
            $name = 'Price_Chnange_Report_Download.xls';
            Excel::store( new PriceChangeReport($dataArr), $name, 'export_path' );
            $folder = "public/storage/bbs/export_files/";
            $path = url($folder.$name);
            return response()->json([ 'message'=>'success', 'code'=>'200', 'data'=>$path]);
            // return Excel::download(new PriceChangeReport($dataArr), $name);
        } catch(\Exception $e){
            return response()->json([ 'message'=>'error', 'code'=>'302', 'data'=>$e->getMessage() ]);
        }
    }

    public function paginate_arr($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
