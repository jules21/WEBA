<?php

namespace App\Exports;

use App\Models\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RequestsExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize, WithStyles, WithTitle, WithEvents
{
    use Exportable;

    private ?string $startDate = null;

    private ?string $endDate;

    private ?int $districtId;

    private ?string $operatorId;

    private ?string $operationAreaId;

    private ?string $requestType;

    private ?string $status;

    private ?string $upi;

    public function __construct(?string $startDate, ?string $endDate, ?int $districtId, ?string $operatorId, ?string $operationAreaId,
                                ?string $requestType, ?string $status, ?string $upi)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->districtId = $districtId;
        $this->operatorId = $operatorId;
        $this->operationAreaId = $operationAreaId;
        $this->requestType = $requestType;
        $this->status = $status;
        $this->upi = $upi;
    }

    public function ShouldAutoSize(): bool
    {
        return true;
    }

    public function title(): string
    {
        return 'Requests';
    }

    public function query()
    {
        return Request::query()
            ->with('customer', 'requestType', 'operator', 'operationArea', 'waterUsage')
            ->when($this->startDate, function ($query) {
                return $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                return $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->when($this->districtId, function ($query) {
                return $query->where('district_id', $this->districtId);
            })
            ->when($this->operatorId, function ($query) {
                return $query->where('operator_id', $this->operatorId);
            })
            ->when($this->operationAreaId, function ($query) {
                return $query->where('operation_area_id', $this->operationAreaId);
            })
            ->when($this->requestType, function ($query) {
                return $query->where('request_type_id', $this->requestType);
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->upi, function ($query) {
                return $query->where('upi', $this->upi);
            });


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

    public function map($row): array
    {
        return [
            optional($row->customer)->name,
            optional($row->requestType)->name,
            optional($row->operator)->name,
            optional($row->operationArea)->name,
            $row->meter_qty,
            optional($row->waterUsage)->name,
            $row->upi,
            $row->status,
        ];
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
