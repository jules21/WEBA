<?php

namespace App\DataTables;

use App\Models\Item;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ItemsDataTable extends DataTable
{
    private $query;

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
            ->editColumn('item_category_id', function($item) {
                return $item->category->name ?? '-';
            })
            ->editColumn('packaging_unit_id', function($item) {
                return $item->packagingUnit->name  ?? '-';
            })
            ->editColumn('vatable', function($item) {
                return '<span class="badge badge-' . ($item->vatable ? 'info' : 'warning') . '">' . ($item->vatable ? 'Yes' : 'No') . '</span>';
            })
            ->editColumn('is_active', function($item) {
                return '<span class="label label-inline label-light-' . ($item->is_active ? 'success' : 'danger') . '">' . ($item->is_active ? 'Active' : 'Inactive') . '</span>';
            })
            ->addColumn('action', function($item){
               return '<div class="btn-group">
                       <button type="button" class="btn btn-light-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Actions
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item btn-edit" href="#"
                            data-toggle="modal"
                            data-target="#edit-item-modal"
                            data-id="' . $item->id . '"
                            data-name="' . $item->name . '"
                            data-description="' . $item->description . '"
                            data-item_category_id="' . $item->item_category_id . '"
                            data-packaging_unit_id="' . $item->packaging_unit_id . '"
                            data-vatable="' . $item->vatable . '"
                            data-is_active="' . $item->is_active . '"
                            data-selling_price="' . $item->selling_price . '"
                            data-vat_rate="' . $item->vat_rate . '"
                            data-url="' . route('admin.stock.items.update', $item->id) . '"
                            >Edit</a>
                        <a class="dropdown-item btn-delete" href="#" data-url="' . route('admin.stock.items.destroy', $item->id) . '">Delete</a>
';
            })
            ->rawColumns(['action', 'item_category_id', 'packaging_unit_id', 'vatable', 'is_active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Item $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Item $model)
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
                    ->setTableId('items-table')
                    ->addTableClass('table border table-hover table-head-custom table-vertical-center table-head-solid')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('name'),
            Column::make('description'),
            Column::make('item_category_id')
                ->title('Category'),
            Column::make('packaging_unit_id')
                ->title('Packaging Unit'),
            Column::make('selling_price'),
//            Column::make('vatable'),
//            Column::make('vat_rate'),
            Column::make('is_active')
                ->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Items_' . date('YmdHis');
    }
}
