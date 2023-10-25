<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SignedCaDbExport implements FromCollection, WithHeadings, WithEvents
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
            'Id#', 'Act Name', 'Act Broker', 'Email', 'Listing #', 'Listing Name', 'Listing Broker', 'Last Viewed', 'Viewed'
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
