<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class RoyaltyReportsExport implements FromCollection
{
    public function __construct($pdf_data)
    {
        $this->pdf_data = $pdf_data;  
    }
    
    public function collection()
    {
        $arr = $this->pdf_data;
        return collect($arr); 
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('signature');
        $drawing->setDescription('This is my signatuer');
        $drawing->setPath(public_path('/assets/images/print_pdf/logo.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('D1');
        return $drawing;
    }

    
}
