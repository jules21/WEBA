<?php

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class StockCardExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Item',	'Item CATEGORY',	'OPENING QTY',	'QTY IN',	'QTY OUT',	'CLOSING QTY',	'UNIT PRICE',	'INITIATED BY', 'DONE AT',
        ];
    }

    public function collection()
    {
        $data = collect();
        foreach ($this->data as $key => $stock) {
            $arr = [];
            $arr[] = $stock->item->name ?? '';
            $arr[] = optional(optional($stock->item)->category)->name ?? '';
            $arr[] = $stock->opening_qty ? $stock->opening_qty : '0';
            $arr[] = $stock->qty_in ? " +$stock->qty_in" : '0';
            $arr[] = $stock->qty_out ? " -$stock->qty_out" : '0';
            $arr[] = ($stock->qty_in > 0 ? ($stock->opening_qty + $stock->qty_in - $stock->qty_out) : ($stock->opening_qty - $stock->qty_out));
            $arr[] = $stock->unit_price ?? '0';
            $arr[] = Helper::stockCardInitiator($stock->id);
            $arr[] = $stock->created_at;
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
        return 'Stock List';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $last_column = Coordinate::stringFromColumnIndex(9);
                $style_text_center = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->insertNewRowBefore(1);
                // merge cells for full-width
                $event->sheet->mergeCells(sprintf('A1:%s1', $last_column));
                // assign cell values
                $event->sheet->setCellValue('A1', 'Stock Card');
                // assign cell styles
                $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
                $cellRange = sprintf('A2:%s2', $last_column); // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle(sprintf('A1:%s1', $last_column))->getFont()->setSize(16);
            },
        ];
    }
}
