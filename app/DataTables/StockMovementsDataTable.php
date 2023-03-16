<?php

namespace App\DataTables;

use App\Models\StockMovement;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
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
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('type', function ($item) {
                if($item->type == 'Adjustment'){
                    return '
                    <span class="badge badge-success">'.$item->type.'</span>';
                }else if($item->type == 'Purchase') {
                    return '
                    <span class="label label-light-primary label-inline">'.$item->type.'</span>';
                }else{
                    return '
                 <span class="label label-primary label-inline font-weight-lighter">'.$item->type.'</span>';
                }
            })

            ->editColumn('operator', function ($item) {
                return $item->operationArea ? optional(optional($item->operationArea)->operator)->name : "-";
            })
            ->editColumn('operation_area_id', function ($item) {
                return $item->operationArea ? $item->operationArea->name : "-";
            })
            ->editColumn('item_id', function ($item) {
                return $item->item ? $item->item->name : "-";
            })
            ->editColumn('quantity', function ($item) {
                return $item->quantity ?
                    $item->quantity . ' ' . $item->item->packagingUnit->name
                    : "-";
            })
            ->editColumn('qty_in', function ($item) {
                return $item->qty_in ?
                    '<span class="text-success  font-weight-lighter">+'.$item->qty_in . ' ' . $item->item->packagingUnit->name.'</span>' : "0";
            })
            ->editColumn('qty_out', function ($item) {
                return $item->qty_out ?
                    '<span class="text-danger font-weight-lighter">-'.$item->qty_out . ' ' . $item->item->packagingUnit->name.'</span>' : "0";
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at ? $item->created_at->format('d-m-Y H:i') : "-";
            })
            ->editColumn("description", function ($item) {

                return strlen($item->description) > 50 ?
                   '<a href="#" class="text-dark" data-toggle="tooltip" data-trigger="focus" data-html="true"title="'.$item->description.'">
                        '.substr($item->description, 0, 50).'... </a>'
                    : $item->description;

            })

            ->rawColumns(['type', 'item_id', 'operator_id', 'quantity', 'created_at', 'qty_in', 'qty_out', 'description']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockMovement $model
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
                    ->orderBy(9, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['title' => '#', 'searchable' => false, 'render' => function() {
                return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
            }],
            Column::make('type')
                ->title("Type")
                ->addClass('text-center'),
            Column::make('item_id')
                ->title("Item")
                ->addClass('text-center'),
            Column::make('operator')
                ->title("operator")
                ->addClass('text-center'),
            Column::make('operation_area_id')
                ->title("Operation Area")
                ->addClass('text-center'),
            Column::make('opening_qty')
                ->title("Opening Qty")
                ->addClass('text-center'),
            Column::make('qty_in')
                ->title("Qty In")
                ->addClass('text-center'),
            Column::make('qty_out')
                ->title("Qty Out")
                ->addClass('text-center'),
            Column::make('description')
                ->title("Description")
                ->addClass('text-center '),
            Column::make('created_at')
                ->title("Created At")
                ->addClass('text-center'),
//            Column::computed('action')
//                ->title("Action")
//                ->addClass('text-center')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StockMovements_' . date('YmdHis');
    }
}
