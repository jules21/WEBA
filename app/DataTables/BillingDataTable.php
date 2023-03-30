<?php

namespace App\DataTables;

use App\Models\Billing;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BillingDataTable extends DataTable
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
            ->addColumn('operator_name', function ($model) {
                return $model->meterRequest->request->operator->name ?? '-';
            })
            ->editColumn('user_id', function ($model) {
                return $model->user->name;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('amount', function ($model) {
                return $model->amount . ' ' . 'RWF';
            })
            ->editColumn('balance', function ($model) {
                return $model->balance . ' ' . 'RWF';
            })
            ->editColumn('unit_price', function ($model) {
                return $model->unit_price . ' ' . 'RWF';
            })
            ->addColumn('customer_name', function ($model) {
                return $model->meterRequest->request->customer->name ?? '-';
            })
            ->editColumn('starting_index', function ($model) {
                return '<span class="label label-sm label-light-primary label-inline">' . $model->starting_index . '</span>' . ' ' . 'to' . ' ' . '<span class="label label-sm label-light-primary label-inline py-0">' . $model->last_index . '</span>';
            })
            ->addColumn('action', function ($model) {
//                return '<a href="' . route('admin.billings.show', encryptId($model->id)) . '" class="btn btn-sm btn-clean btn-icon btn-details" title="View details">
//                            <i class="la la-eye"></i>
//                        </a>';
                return '<div class="dropdown">
                             <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Options
                            </button>
                            <div class="dropdown-menu border">
                                <a class="dropdown-item btn-details"" href="' . route('admin.billings.show', encryptId($model->id)) . '">
                                    <i class="fas fa-info"></i>
                                    <span class="ml-2">Details</span>
                                </a>
                                <a class="dropdown-item" href="' . route('admin.billings.history', encryptId($model->id)) . '">
                                    <i class="fas fa-history"></i>
                                    <span class="ml-2">History</span>
                                </a>
                            </div>
                        </div>';
            })
            ->rawColumns(['starting_index', 'action', 'unit_price', 'amount', 'balance'])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Billing $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Billing $model)
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
                    ->setTableId('billing-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(10, 'desc');

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
            Column::make('operator_name')
                ->name('meterRequest.request.operator.name')
                ->title("Operator Name")
                ->addClass('text-center'),
            Column::make('customer_name')
                ->name('meterRequest.request.customer.name')
                ->title("Customer Name")
                ->addClass('text-center'),
            Column::make('meter_number')
                ->title("Meter Number")
                ->addClass('text-center'),
            Column::make('subscription_number')
                ->title("Subscription Number")
                ->addClass('text-center'),
        Column::make('starting_index')
            ->title("Indexes")
            ->addClass('text-center'),
        Column::make('unit_price')
            ->title("Unit Price")
            ->addClass('text-center'),
        Column::make('amount')
            ->title("Amount")
            ->addClass('text-center'),
        Column::make('balance')
            ->title("Balance")
            ->addClass('text-center'),
            Column::make('user_id')
                ->title("Officer")
                ->addClass('text-center'),
        Column::make('created_at')
            ->title("Creation Date")
            ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title(''),

        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Billing_' . date('YmdHis');
    }
}
