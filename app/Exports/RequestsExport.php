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
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RequestsExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private string $startDate;
    private string $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
            ->whereDate('created_at', '>=', $this->startDate)
            ->whereDate('created_at', '<=', $this->endDate);

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
            'Status'
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
            $row->status
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
