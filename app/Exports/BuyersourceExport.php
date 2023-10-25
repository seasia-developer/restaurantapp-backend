<?php

namespace App\Exports;

use App\Models\Buyers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BuyersourceExport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($data)
    {
        $this->data = $data; 
    }
    public function headings(): array{
        return[
            'Source','Number of Buyers'

        ];
    }
    public function collection()
    {
        $arr = $this->data;
        return collect($arr);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:V1')->getFont()->setBold(true);
            },
        ];
    }
}
