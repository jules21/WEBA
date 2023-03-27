<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BillingExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Phone',
            'Meter Number',
            'Subscription Number',
            'Starting Index',
            'Last Index',
            'Unit Price',
            'Amount',
            'Balance',
            'Officer',
            'Date',
            'Comment',

        ];
    }
    public function collection()
    {
        $data = collect();
        foreach ($this->data as $key => $bill) {
            $arr = array();
            $arr[] = $bill->meterRequest->request->customer->name ?? '-';
            $arr[] = $bill->meterRequest->request->customer->phone ?? '-';
            $arr[] = $bill->meter_number ?? '-';
            $arr[] = $bill->subscription_number ?? '-';
            $arr[] = $bill->starting_index ?? '-';
            $arr[] = $bill->last_index ?? '-';
            $arr[] = $bill->unit_price ?? '-';
            $arr[] = $bill->amount ?? '-';
            $arr[] = $bill->balance ?? '-';
            $arr[] = $bill->user->name ?? '-';
            $arr[] = $bill->created_at ?? '-';
            $arr[] = $bill->comment ?? '-';
            $data->push($arr);
        }
        return $data;
    }

    public function ShouldAutoSize(): bool
    {
        return true;
    }

    public function title(): string
    {
        return 'Billing List';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $last_column = Coordinate::stringFromColumnIndex(12);
                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ];
                $event->sheet->insertNewRowBefore(1);
                // merge cells for full-width
                $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                // assign cell values
                $event->sheet->setCellValue('A1','Billing List');
                // assign cell styles
                $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
                $cellRange = sprintf('A2:%s2',$last_column); // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle(sprintf('A1:%s1',$last_column))->getFont()->setSize(16);
            },
        ];
    }
}
