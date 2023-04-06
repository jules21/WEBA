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

class StockMovementExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'TYPE',	'ITEM',	'OPENING QTY', 'QTY IN/OUT',	'CLOSING QTY',	'DESCRIPTION',	'CREATED AT',
        ];
    }

    public function collection()
    {
        $data = collect();
        foreach ($this->data as $key => $movement) {
            $arr = [];
            $arr[] = $movement->type ?? '-';
            $arr[] = $movement->item ? $movement->item->name : '-';
            $arr[] = $movement->opening_qty > 0 ? $movement->opening_qty : '0';
            $arr[] = ($movement->qty_in > 0 ?
                ("+ $movement->qty_in ".$movement->item->packagingUnit->name) :
                ("- $movement->qty_out ".$movement->item->packagingUnit->name));
            $arr[] = ($movement->qty_in > 0 ? ($movement->opening_qty + $movement->qty_in) : ($movement->opening_qty - $movement->qty_out));
            $arr[] = $movement->description ?? '-';
            $arr[] = $movement->created_at ?? '-';
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
        return 'Stock Movement List';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $last_column = Coordinate::stringFromColumnIndex(7);
                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->insertNewRowBefore(1);
                // merge cells for full-width
                $event->sheet->mergeCells(sprintf('A1:%s1', $last_column));
                // assign cell values
                $event->sheet->setCellValue('A1', 'Stock Movement List');
                // assign cell styles
                $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
                $cellRange = sprintf('A2:%s2', $last_column); // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle(sprintf('A1:%s1', $last_column))->getFont()->setSize(16);
            },
        ];
    }
}
