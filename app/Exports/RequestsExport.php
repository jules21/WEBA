<?php

namespace App\Exports;

use App\Models\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RequestsExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private ?string $startDate = null;

    private ?string $endDate;

    private ?int $districtId;

    private ?string $operatorId;

    private ?string $operationAreaId;

    public function __construct(?string $startDate, ?string $endDate, ?int $districtId, ?string $operatorId, ?string $operationAreaId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->districtId = $districtId;
        $this->operatorId = $operatorId;
        $this->operationAreaId = $operationAreaId;
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
            $row->customer->name,
            $row->requestType->name,
            $row->operator->name,
            $row->operationArea->name,
            $row->meter_qty,
            $row->waterUsage->name,
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
}
