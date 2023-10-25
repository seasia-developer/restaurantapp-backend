<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FranchiseExport implements FromCollection, WithHeadings, WithEvents
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
            'Invoice #','Note','Date','Office','Priority Email Fee','Phone Coverage','BizBuySell Upgrades','List Pull','Other'
        ];
    }
    public function collection()
    {
        $arr = $this->pdf_data;
        return collect($arr);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:I1')->getFont()->setBold(true);
            },
        ];
    }
}
