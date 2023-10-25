<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\User;

class ComingSoonListingExport implements FromCollection, WithHeadings, WithEvents
{
    public function headings(): array{
        // Listing#, Business Name, City, State, Price, Agent,	Status,	Major, Minor, Coming Soon Date,	Days Pending
        return[
            'Listing#','Business Name','City','State','Price','Agent','Coming Soon Date','Days Pending'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $result = DB::select( DB::raw("select `listing`.`id`, `listing`.`bname`, `listing`.`bstate`, `listing`.`bcounty`, `listing`.`bcity`, `listing`.`bzip`, `listing_office`.`olagent`, `listing`.`bsaleprice`, `listing`.`comingsoon_date`, `listing`.`bstatuslist` from `listing` left join `listing_office` on `listing_office`.`listing_id` = `listing`.`id` where `listing`.`bstatuslist` = 'coming soon' group by `listing`.`id`"));
        $now = date('Y-m-d');
							
        foreach($result as $key=>$val){
            if(isset($val->comingsoon_date)){
                $newDate = date("m-d-Y", strtotime($val->comingsoon_date));
                $your_date = strtotime($val->comingsoon_date);
                $datediff = strtotime($now) - $your_date;
                $datediff = round($datediff / (60 * 60 * 24));
                if($datediff == 0){
                    $datediff= "0";
                }
            } else {
                $newDate = '';
                $datediff = '';
            }
            // $newDate = date("m-d-Y", strtotime($val->comingsoon_date));
            $user = User::where('id','=',$val->olagent)->get();
            if(count($user) > 0){
                foreach($user as $u_key=>$u_val){
                    $u_name = $u_val->username;
                }
            }
            else {
                $u_name = '';
            }
            $dataArr = array($val->id, $val->bname, $val->bcity, $val->bstate, $val->bsaleprice, $u_name, $newDate, $datediff);
            $object =  (object) $dataArr;
            $dataExcel[$key] = $object;
        }
        return collect($dataExcel); 
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H1')->getFont()->setBold(true);
            },
        ];
    }
}
