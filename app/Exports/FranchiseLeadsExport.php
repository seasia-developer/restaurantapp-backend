<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Agents;

class FranchiseLeadsExport implements FromCollection, WithHeadings, WithEvents
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
            'Franchise Territory',
            'Franchisee',
            'Agent Name',
            'Home Phone',
            'Work Phone',
            'Cell Phone',
            'Office',
            'Lead Status',
            'Lead Source',
            'Lead Type',
            'Address',
            'Market Area',
            'Original date',
            'Email',
            'City',
            'State',
            'Zip',
            'Latest Note',
            'Detail Lead Status',
            'Disposition',
            'LinkedIn Profile'
        ];
    }
    public function collection()
    {
        $arr= [];
        foreach($this->pdf_data as $key=>$row){
            $arr[]= array(
            'Franchise Territory'=>$row->businessname,
            'Franchisee'=>$row->owner,
            'Agent Name'=>'cool',
            'Home Phone'=>$row->homephone,
            'Work Phone'=>$row->workphone,
            'Cell Phone'=>$row->cellphone,
            'Office'=>'$franchisename',
            'Lead Status'=>$row->status,
            'Lead Source'=>'$leadsource',
            'Lead Type'=>$row->leadtype,
            'Address'=>$row->address,
            'Market Area'=>'cool',
            'Original date'=>$row->createddate,
            'Email'=>$row->email,
            'City'=>$row->city,
            'State'=>$row->state,
            'Zip'=>$row->zip,
            'Latest Note'=>'cool',
            'Detail Lead Status'=>$row->detail_lead_status,
            'Disposition'=>$row->disposition,
            'LinkedIn Profile'=>$row->linkin_profile
        );
        }
        return collect($arr);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:U1')->getFont()->setBold(true);
            },
        ];
    }
}
