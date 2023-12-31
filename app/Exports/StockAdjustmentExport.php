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

class StockAdjustmentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithEvents
{
        protected $data;

        public function __construct($data)
    {
        $this->data = $data;
    }

        public function headings(): array
    {
        return [
            'INITIATOR',	'DESCRIPTION',	'ITEMS', 'DONE AT',	'STATUS',	'APPROVED BY',
        ];
    }

        public function collection()
    {
        $data = collect();
        foreach ($this->data as $key => $adjustment) {
            $arr = [];
            $adjustment->created_by ? $arr[] = $adjustment->createdBy->name : $arr[] = '-';
            $arr[] = $adjustment->description ?? '-';
            $items = '';
            foreach ($adjustment->items as $key => $item) {

                if ($item->adjustment_type == 'increase')
                    $items .= $item->item->name.' (+'.$item->quantity.')';
                else
                    $items .= $item->item->name.' (-'.$item->quantity.')';

                if ($key < count($adjustment->items) - 1) {
                    $items .= ', ';
                }
            }
            $arr[] = $items;
            $arr[] = $adjustment->created_at ?? '-';
            $arr[] = $adjustment->status ?? '-';
            $adjustment->approved_by ? $arr[] = $adjustment->approvedBy->name : $arr[] = '-';
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
        return 'Stock Adjustment List';
    }

        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $last_column = Coordinate::stringFromColumnIndex(count($this->headings()));
                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->insertNewRowBefore(1);
                // merge cells for full-width
                $event->sheet->mergeCells(sprintf('A1:%s1', $last_column));
                // assign cell values
                $event->sheet->setCellValue('A1', 'Stock Adjustment List');
                // assign cell styles
                $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
                $cellRange = sprintf('A2:%s2', $last_column); // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle(sprintf('A1:%s1', $last_column))->getFont()->setSize(16);
            },
        ];
    }
}
