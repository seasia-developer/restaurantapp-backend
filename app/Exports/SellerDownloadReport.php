<?php

namespace App\Exports;

use App\Models\SellerData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellerDownloadReport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($data)
    {
        $this->data = $data; 
    }
    public function headings(): array{
        return[
            'Owner','Restaurant Name','Address','City','County','State','Zip','Phone','Email','Website','Status'

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
