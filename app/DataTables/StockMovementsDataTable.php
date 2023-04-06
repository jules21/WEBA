<?php

namespace App\DataTables;

use App\Models\StockMovement;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StockMovementsDataTable extends DataTable
{
    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Build DataTable class.
     *
     * @param  mixed  $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('type', function ($item) {
                if (in_array($item->type, ['AdjustmentController', StockMovement::Adjustment])) {
                    return '
                    <span class="label label-light-success label-inline"> Adjustment </span>';
                } elseif (in_array($item->type, ['Purchase', StockMovement::StockIn])) {
                    return '
                    <span class="label label-light-primary label-inline"> Stock In </span>';
                } elseif (in_array($item->type, ['Sale', 'Sales', StockMovement::StockOut])) {
                    return '
                    <span class="label label-light-danger label-inline"> Stock Out </span>';
                } else {
                    return '
                 <span class="label label-primary label-inline font-weight-lighter">'.$item->type.'</span>';
                }
            })
            ->editColumn('item_id', function ($item) {
                return $item->item ? $item->item->name : '-';
            })
            ->editColumn('quantity', function ($item) {
                return $item->quantity ?
                    $item->quantity.' '.$item->item->packagingUnit->name
                    : '-';
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-';
            })
            ->editColumn('description', function ($item) {

                return strlen($item->description) > 50 ?
                   '<a href="#" class="text-dark" data-toggle="tooltip" data-trigger="focus" data-html="true"title="'.$item->description.'">
                        '.substr($item->description, 0, 50).'... </a>'
                    : $item->description;

            })
            ->addColumn('closing_qty', function ($item) {
                if ($item->qty_in > 0) {
                    return $item->opening_qty + $item->qty_in;
                } else {
                    return $item->opening_qty - $item->qty_out;
                }
            })
            ->addColumn('qty_change', function ($item) {
                if ($item->qty_in > 0) {
                    return '<span class="text-success  font-weight-lighter">+'.$item->qty_in.' '.$item->item->packagingUnit->name.'</span>';
                } else {
                    return '<span class="text-danger font-weight-lighter">-'.$item->qty_out.' '.$item->item->packagingUnit->name.'</span>';
                }
            })
            ->rawColumns(['type', 'item_id', 'quantity', 'created_at', 'qty_change', 'description']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockMovement $model)
    {
        return $this->query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('stockmovements-table')
                    ->columns($this->getColumns())
                    ->addTableClass('table border table-head-custom table-hover  table-head-solid')
                    ->minifiedAjax()
                    ->addTableClass('table table-striped- table-hover table-checkable')
                    ->orderBy(7, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['title' => '#', 'searchable' => false, 'render' => function () {
                return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
            }],
            Column::make('type')
                ->title('Type'),
            Column::make('item_id')
                ->title('Item'),
            Column::make('opening_qty')
                ->title('Opening Qty'),
            Column::make('qty_change')
                ->title('Qty In/Out'),
            Column::make('closing_qty')
                ->title('Closing Qty'),
            Column::make('description')
                ->title('Description'),
            Column::make('created_at')
                ->title('Created At'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StockMovements_'.date('YmdHis');
    }
}
