<?php

namespace App\Exports;

use App\Models\BbsListingReportdwnld;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBbsListingReportdwnld implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($data)
    {
        $this->data = $data; 
    }
    public function headings(): array{
        return[
            'Reference ID','Heading','State','County','City','Zip','Is City Confidential (Y/N)','Is Franchise (Y/N)','Is Asset Sale (Y/N)','Asking Price','Gross Revenue','Cash Flow','Real Estate Type (Owned/Leased)','Is Seller Financing Available (Y/N)','Facilities','Support','Reasons for Selling','Competition','Growth','Year Established','Number of Employees','Summary'

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
