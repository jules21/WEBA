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
            ->editColumn('item_id', function ($item) {
                return $item->item ? $item->item->name : "-";
            })
            ->editColumn('operator_id', function ($item) {
                return $item->operator ? $item->operator->name : "-";
            })
            ->editColumn('quantity', function ($item) {
                return $item->quantity ? $item->quantity : "-";
            })
            ->editColumn('type', function ($item) {
                if($item->type == 'adjustment'){
                    return '
                    <span class="badge badge-success">'.$item->type.'</span>';
                }else if($item->type == 'purchase') {
                    return '
                    <span class="badge badge-warning">'.$item->type.'</span>';
                }else{
                    return '
                 <span class="badge badge-danger">'.$item->type.'</span>';
                }
            })
            ->addColumn('action', function ($item) {
                return '<div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.route('admin.stock.item-categories.show', $item->id).'">View</a>
                                    <a class="dropdown-item" href="'.route('admin.stock.item-categories.edit.edit', $item->id).'">Edit</a>
                                    <form action="'.route('admin.stock.item-categories.destroy.destroy', $item->id).'" method="POST">
                                        '.csrf_field().'
                                        '.method_field('DELETE').'
                                        <button type="submit" class="dropdown-item">Delete</button>
                                    </form>
                                </div>
                            </div>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockMovement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockMovement $model)
    {
        return $model->newQuery();
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
                    ->minifiedAjax()
                    ->addTableClass('table table-striped- table-hover table-checkable')
                    ->orderBy(1);
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
            Column::make('item_id')
                ->title("Item")
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
                ->addClass('text-center'),
            Column::make('type')
                ->title("Type")
                ->addClass('text-center'),
            Column::make('created_at')
                ->title("Created At")
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center')
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
