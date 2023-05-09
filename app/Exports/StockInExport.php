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
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class StockInExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithEvents, WithCustomCsvSettings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            "SUPPLIER",	"TOTAL ITEMS ", "ITEMS WITH QTY AND UNIT PRICE",	"TAX",	"TOTAL AMOUNT",	"STATUS","CREATED AT"
        ];
    }

    public function collection()
    {
        $data = collect();
        foreach ($this->data as $key => $stockin) {
            $arr = [];
            $arr[] = $stockin->supplier ? $stockin->supplier->name : '-';
            $arr[] = $stockin->movement_details_count ?? '-';
            //ITEMS WITH QTY
            $items_with_qty = '';
            foreach ($stockin->movementDetails as $index => $movement_detail) {
                $items_with_qty .= $movement_detail->item->name . ' (' . $movement_detail->quantity . ' ' . $movement_detail->item->packagingUnit->name . ') on ' . $movement_detail->unit_price . 'RWF';
                $items_with_qty .= "\r\n";
            }
            $arr[] = $items_with_qty;
            $arr[] = $stockin->tax_amount . 'RWF' ?? '-';
            $arr[] = $stockin->total . 'RWF' ?? '-';
            $arr[] = $stockin->status ?? '-';
            $arr[] = $stockin->created_at ?? '-';
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
                $event->sheet->setCellValue('A1', 'Stock In List');
                // assign cell styles
                $event->sheet->getStyle('A1:A2')->applyFromArray($style_text_center);
                $cellRange = sprintf('A2:%s2', $last_column); // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle(sprintf('A1:%s1', $last_column))->getFont()->setSize(16);
            },
        ];
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
            'line_ending' => "\r\n", // Set the line ending to \r\n
            'use_bom' => true,
            'input_encoding' => 'UTF-8',
            'output_encoding' => 'UTF-8',
        ];
    }
}
