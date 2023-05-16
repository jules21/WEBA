<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RequestsExport implements WithHeadings, FromCollection, WithColumnFormatting, ShouldAutoSize, WithStyles, WithTitle, WithEvents
{
    use Exportable;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function ShouldAutoSize(): bool
    {
        return true;
    }

    public function title(): string
    {
        return 'Requests';
    }
    public function headings(): array
    {
        return [
            'Customer',
            'Request Type',
            'Operator',
            'Operation Area',
            'Meter Qty',
            'Water Usage',
            'UPI',
            'Status',
        ];
    }
    public function collection()
    {
        $data = collect();
        foreach ($this->data as $key => $row) {
            $arr = [];
            $arr[] = $row->customer->name ?? '-';
            $arr[] = $row->requestType->name ?? '-';
            $arr[] = $row->operator->name ?? '-';
            $arr[] = $row->operationArea->name ?? '-';
            $arr[] = $row->meter_qty ?? '-';
            $arr[] = $row->waterUsage->name ?? '-';
            $arr[] = $row->upi ?? '-';
            $arr[] = $row->status ?? '-';
            $data->push($arr);
        }

        return $data;
    }

    public function columnFormats(): array
    {

        return [];

    }

    public function styles(Worksheet $sheet): array
    {

        return [];

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $last_column = Coordinate::stringFromColumnIndex(8);
                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->insertNewRowBefore(1);
                // merge cells for full-width
                $event->sheet->mergeCells(sprintf('A1:%s1', $last_column));
                // assign cell values
                $event->sheet->setCellValue('A1', 'Requests List');
                // assign cell styles
                $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
                $cellRange = sprintf('A2:%s2', $last_column); // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle(sprintf('A1:%s1', $last_column))->getFont()->setSize(16);
            },
        ];
    }
}
