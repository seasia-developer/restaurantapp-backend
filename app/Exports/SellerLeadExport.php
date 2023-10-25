<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Agents;

class SellerLeadExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($pdf_data)
    {
        
        $this->pdf_data = $pdf_data;  
          
    }
    public function headings(): array{
        return[
            'Lead ID',
            'Business name',
            'Owner',
            'Agent Name',
            'Home Phone',
            'Work Phone',
            'Cell Phone',
            'Office',
            'Lead Status',
            'Address',
            'Market Area',
            'Original date',
            'Email',
            'City',
            'State',
            'Creator',
            'Zip',
            'Lead Source',
            'Converted Date',
            'Referral Agent Name',
            'Referral Agent Phone',
            'Referral Agent Email',
            'Referral Agent Company',
            'Latest Note',
        ];
    }
    public function collection()
    {
        foreach($this->pdf_data as $key=>$value){
            $arr[]= array(
            'Lead ID'=>$value->id, 
            'Business name'=>$value->restaurant_name, 
            'Owner'=>$value->owner,
            'Agent Name'=>'Bing',
            'Home Phone'=>$value->homephone,
            'Work Phone'=>$value->workphone,
            'Cell Phone'=>$value->cellphone,
            'Office'=>'dygUIDW',
            'Lead Status'=>$value->status,
            'Address'=>$value->address,
            'Market Area'=>'SSADSA',
            'Original date'=>$value->createddate,
            'Email'=>$value->email,
            'City'=>$value->city,
            'State'=>'state',
            'Creator'=>'cool',
            'Zip'=>$value->zip,
            'Lead Source'=>$value->market_area,
            'Converted Date'=>$value->dateconverted,
            'Referral Agent Name'=>$value->referralagentname,
            'Referral Agent Phone'=>$value->referralagentphone,
            'Referral Agent Email'=>$value->referralagentemail,
            'Referral Agent Company'=>$value->referralagentcompany,
            'Latest Note'=>'latest'
        );
        }
        return collect($arr);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:X1')->getFont()->setBold(true);
            },
        ];
    }
}
