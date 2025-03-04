<?php

namespace App\Exports;

use App\Models\ApplicantRating;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class ApplicantRatingsExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ApplicantRating::select('application_code', 'education_details', 'education_inc', 'education_points')->get();
    }

    public function headings(): array
    {
        return [
            'Application Code',
            'Education Details',
            'Education Increment',
            'Education Points',
        ];
    }

    // Styling the sheet
    public function styles(Worksheet $sheet)
    {
        // Making the header bold
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Aligning the data to the left
        $sheet->getStyle('A:D')->getAlignment()->setHorizontal('left');
    }

    // Adjusting the column widths
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                foreach (range('A', 'D') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    
}
