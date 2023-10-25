<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NonLookingStateBuyersExport;
use App\Models\Buyers;
class NonLookingStateBuyersController extends Controller
{
    public function index(){
        try { 
            $query = Buyers::select('id','firstname','lastname','email','city','state','country','postalcode','staddress','phoneno','cellno')->latest()->get();
            $name = 'Buyers_without_looking_state_report.xls';
            Excel::store( new NonLookingStateBuyersExport($query), $name, 'export_path' );
            $folder = "public/storage/bbs/export_files/";
            $path = url($folder.$name);
            $count = count($query);
            return response()->json([ 'message'=>'success', 'code'=>'200', 'data'=>$path, 'total'=>$count]);
        } catch(\Exception $e){
            return response()->json([ 'message'=>'error','code'=>'302','data'=>$e->getMessage() ]);
        }
    }
}
