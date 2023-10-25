<?php

namespace App\Exports;

use App\Models\Buyers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
class NonLookingStateBuyersExport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($pdf_data)
    {
        
        $this->pdf_data = $pdf_data;  
          
    }
    public function headings(): array{
        return[
            'Buyer ID',	'First Name', 'Last Name', 'Email', 'City',	'State', 'Country',	'Postal Code', 'Street Address', 'Phone', 'Mobile'
        ];
    }
    public function collection()
    {
        $arr = $this->pdf_data;
        return collect($arr);
        // return Buyers::all();
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:K1')->getFont()->setBold(true);
            },
        ];
    }
}
