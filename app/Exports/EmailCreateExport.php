<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\CampaignList;
use App\Models\Listing;
use App\Models\CaBuyers;

class EmailCreateExport implements FromCollection, WithHeadings, WithEvents
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
            'Email Name',
            'Listing Number',
            'From Name',
            'From Address',
            'Subject',
            'Template',
            'Campaign',
            'List(s)',           
            'Meta Description',
            'Send Date',
            'Created Date',
            'Created By',
            'Headline Ad 1',
            'Headline Ad 2',
            'Headline Ad 3',
            'Cancel Date',
            'Number of CAs signed'
            
        ];
    }
    public function collection()
    {
        foreach($this->pdf_data as $key=>$value){
            $arr[]= array(
            'Email Name' => $value->emailname,
            'Listing Number' => $value->listings,
            'From Name' =>$value->getAgentData ? $value->getAgentData->firstname.' '.$value->getAgentData->lastname:"",
            'From Address' =>$value->getAgentData ? $value->getAgentData->email:"",
            'Subject' => $value->subject,
            'Template' => $value->emlformat ? $this->getOptionType($value->emlformat): "",
            'Campaign' => $value->cname,
            'List(s)' => $value->getCampaignData ? $this->getCampaignListname($value->getCampaignData->campainglist): "",
            'Meta Description' => $value->listings ? $this->getlistingmeta($value->listings): "",
            'Send Date' => $value->senddate,
            'Created Date' => $value->date_time,
            'Created By' => $value->user_type,      
            'Headline Ad 1' => $value->headlinead1, 
            'Headline Ad 2' => $value->headlinead2,     
            'Headline Ad 3' => $value->headlinead3,     
            'Cancel date' => $value->cancel_date,   
            'Number of CAs signed' => $value->listings ? $this->getNoOfCAs($value->listings): "",   
        );
        }
        return collect($arr);
    }

    public function getCampaignListname($Listid){
        $result = CampaignList::whereIn('id', explode(',', $Listid))->get();
        $camplist = '';
        foreach ($result as $val){
            $camplist .= $val ? $val['campaignlist']:'' .',';
        }
        return $camplist;
    }

    public function getlistingmeta($Listid){
        $result = Listing::whereIn('id', explode(',', $Listid))->get();
        $bmetadescription = '';
        foreach ($result as $val){
            $bmetadescription .= $val ? $val['bmetadescription']:'' .',';
        }
        return $bmetadescription;
    }
    public function getOptionType($typeId){
            $optiontype = "";
            if($typeId == 1){
                $optiontype = "New Buyer Interest";
            }
            if($typeId == 4){
                $optiontype = "Christmas Responsive";
            }
            if($typeId == 5){
                $optiontype = "BAT Responsive";
            }
            if($typeId == 6){
                $optiontype = "ART Responsive";
            }
        return $optiontype;
    }

    public function getNoOfCAs($listingId)
        {
        $caCount = 0;
        $rsVar = CaBuyers::whereIn('listing_id', explode(',', $listingId));
        $totalRecords = $rsVar->count('nosigned');
        if ($totalRecords > 0) {
            $scoreArray = array();
            foreach($rsVar->get() as $v) {
                $scoreArray[] = $v->nosigned;
            }
            $caCount = array_sum($scoreArray);
        }
        return $caCount;
      }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:R1')->getFont()->setBold(true);
            },
        ];
    }
}
