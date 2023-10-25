<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BbsListingReportDownloadExport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($pdf_data)
    {
        $this->pdf_data = $pdf_data;  
    }
    public function headings(): array{
        return[
            'Office','Reference ID','Heading','Country','Street Address','State','County','City','Zip','Is State Confidential (Y/N)','Is County Confidential (Y/N)','Is City Confidential (Y/N)','Is Address Confidential (Y/N)','Is Home Based (Y/N)','Is Relocatable (Y/N)','Is Franchise (Y/N)','Is Asset Sale (Y/N)','Is Miscellaneous Listing (Y/N)','Asking Price','Gross Revenue','Cash Flow','EBITDA','Inventory','Is Inventory Included In Asking Price (Y/N)','FFE','Real Estate Type (Owned/Leased)','Building Square Feet','Real Estate Value','Is Real Estate Included In Asking Price (Y/N)','Seller Financing Notes','Is Seller Financing Available (Y/N)','Facilities',	'Support','Reasons for Selling','Competition','Growth','Year Established','Number of Employees','Web Address',	'Summary','Listing Tag Line','Real Estate Asking Price per Square Foot','Net Operating Income','Current Property Expenses','Location Description','Current and Prior Use','Year of Construction','Lease Rate per Square Foot',	'Lease is Per Yr or Mo','Lease Expiration Date','Expenses per Square Foot','Lease Terms Available','Lease is NNN','Minimum Available Space','Maximum Available Space','Number of Establishments'
        ];
    } 
    public function collection()
    {
        $arr = $this->pdf_data;
        return collect($arr);
        // return Listing::all();
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:BE1')->getFont()->setBold(true)->setSize(10);
            },
        ];
    }
}
