<?php

namespace App\Exports;

use App\Models\ChecklistDetails;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Illuminate\Support\Arr;
use App\Http\Controllers\Api\Listing\ListingChecklistDetailsController;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ChecklistDetailsExport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($pdf_data)
    {
        
        $this->pdf_data = $pdf_data;  
          
    }
    public function headings(): array{
        return[
            'Listing Number#','Date Due','Due By','Status','Task to complete','Latest Note/Email'
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
                $event->sheet->getDelegate()->getStyle('A1:F1')->getFont()->setBold(true);
            },
        ];
    }
}
