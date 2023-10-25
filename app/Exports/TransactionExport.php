<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings, WithEvents
{
    public function __construct($pdf_data)
    {
        
        $this->pdf_data = $pdf_data;  
          
    }
    public function headings(): array{
        return[
           'Transaction #', 'Business Name', 'Transaction Date', 'Loan Amount', 'Loan Referral Fee', '401K', 'Insurance', 'Consulting', 'Valuation', 'Payroll Vault', 'Other', 'Lease', 'Referral Fee'

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
                $event->sheet->getDelegate()->getStyle('A1:M1')->getFont()->setBold(true);
            },
        ];
    }
}
