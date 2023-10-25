<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSeoInterface implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($pdf_data)
    {
        
        $this->pdf_data = $pdf_data;  
          
    }
    public function headings(): array{
        return[
            'ID #','Page Title','Key Word','Site Url','Meta Description'
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
