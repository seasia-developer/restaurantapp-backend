<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Agents;

class MarketingReportExport implements FromCollection, WithHeadings, WithEvents
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
            'Listing#',
            'Listing Agent',
            'State',
            'Status',
            'Business name',
            'BAT Y/N',
            'Office',
            'Email Blast #1',
            'Email Blast #2',
            'Email Blast #3',
            'Email Blast #4',
            'Email Blast #5',
            'Email Blast #6',
            'Email Blast #7',
            'Email Blast #8',
            'Email Blast #9',
            'Email Blast #10',
            'Count of Email Blasts',
            'Other #1',
            'Other #2',
            'Other #3',
            'Other #4',
            'Other #5',
            'Other #6',
            'Other #7',
            'Other #8',
            'Other #9',
            'Count - Other Marketing',
            'BizBuySell',
            'BizBuySellLevel',
            'BizQuest',
            'BizQuestLevel',
            'BusinessBroker.net',
            'BusinessBroker.netLevel',
            'WSR Views',
            'WSR Featured',
            'Days on Market',
            'Signed CA',
            'Expiration',
            'Price Change #1',
            'Count Price Change'
        ];
    }
    public function collection()
    {
        foreach($this->pdf_data as $key=>$value){
            $arr[]= array(
            'Listing#' => $value->id,
            'Listing Agent' =>  $value->olagent ? $this->getAgentNameByAgentId($value->olagent): "",
            'State' => '',
            'Status' => '',
            'Business name' => '',
            'BAT Y/N' => '',
            'Office' => '',
            'Email Blast #1' => '',
            'Email Blast #2' => '',
            'Email Blast #3' => '',
            'Email Blast #4' => '',
            'Email Blast #5' => '',
            'Email Blast #6' => '',
            'Email Blast #7' => '',
            'Email Blast #8' => '',
            'Email Blast #9' => '',
            'Email Blast #10' => '',
            'Count of Email Blasts' => '',
            'Other #1' => '',
            'Other #2' => '',
            'Other #3' => '',
            'Other #4' => '',
            'Other #5' => '',
            'Other #6' => '',
            'Other #7' => '',
            'Other #8' => '',
            'Other #9' => '',
            'Count - Other Marketing' => '',
            'BizBuySell' => '',
            'BizBuySellLevel' => '',
            'BizQuest' => '',
            'BizQuestLevel' => '',
            'BusinessBroker.net' => '',
            'BusinessBroker.netLevel' => '',
            'WSR Views' => '',
            'WSR Featured' => '',
            'Days on Market' => '',
            'Signed CA' => '',
            'Expiration' => '',
            'Price Change #1' => '',
            'Count Price Change' => ''
        );
        }
        return collect($arr);
    }
    public function getAgentNameByAgentId($agentid){
        $result = Agents::select('firstname', 'lastname',)->where('id', $agentid)->first();
        $return = $result->firstname." ".$result->lastname;
        return $return;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:AT1')->getFont()->setBold(true);
            },
        ];
    }
}
