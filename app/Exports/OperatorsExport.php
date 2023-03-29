<?php

namespace App\Exports;

use App\Models\Operator;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OperatorsExport implements FromQuery, ShouldAutoSize, WithMapping, WithTitle, WithHeadings,WithStyles
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
        return 'Operators';
    }


    public function query()
    {
        return Operator::query()
            ->with(['legalType','province','district','sector','cell'])
            ->whereDate('created_at', '>=', $this->startDate)
            ->whereDate('created_at', '<=', $this->endDate);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Legal Type',
            'ID Type',
            'ID Number',
            'Address',
            'Province',
            'District',
            'Sector',
            'Cell',
            'Created At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->legalType->name,
            $row->id_type,
            $row->id_number,
            $row->address,
            $row->province->name ?? '',
            $row->district->name ?? '',
            $row->sector->name ?? '',
            $row->cell->name ?? '',
            $row->created_at,
        ];
    }


    public function styles(Worksheet $sheet): array
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }



}
