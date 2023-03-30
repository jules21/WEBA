<?php

namespace App\DataTables;

use App\Models\PaymentDeclaration;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentDeclarationDataTable extends DataTable
{
    protected $query;

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
            ->addColumn('customer', function ($query) {
                return $query->request->customer->name ?? '-';
            })
            ->addColumn('request_type', function ($query) {
                return $query->request->requestType->name ?? '-';
            })
            ->addColumn('payment_type', function ($query) {
                return $query->paymentConfig->paymentType->name ?? '-';
            })
            ->editColumn('payment_reference', function ($query) {
                return $query->payment_reference ?? '-';
            })
            ->editColumn('amount', function ($query) {
                return $query->amount ?? '-';
            })
            ->editColumn('status', function ($query) {
                if (!(strtolower($query->status) == 'active')) {
                    return '<span class="label  label-success label-inline">Paid</span>';
                } else {
                    return '<span class="label label-light-primary label-inline">Pending</span>';
                }
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y H:m:s') ?? '-';
            })
            ->addColumn('action',function($query){
                return '
                       <div class="dropdown">
                                 <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu border">
                                    <a class="dropdown-item" href="'.route('admin.payments.history', $query->id).'">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="ml-2">History</span>
                                    </a>
                                </div>
                            </div>
                ';
            })
            ->rawColumns(['status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PaymentDeclaration $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PaymentDeclaration $model)
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
                    ->setTableId('paymentdeclaration-table')
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
            Column::make('customer')
            ->title('Customer')
            ->addClass('text-center'),
            Column::make('request_type')
                ->title('Request Type')
                ->addClass('text-center'),
            Column::make('payment_type')
                ->title('Payment Type')
                ->addClass('text-center'),
            Column::make('payment_reference')
                ->title('Ref Number')
                ->addClass('text-center'),
            Column::make('amount')
                ->title('Amount')
                ->addClass('text-center'),
            Column::make('status')
                ->title('Status')
                ->addClass('text-center'),
            Column::make('created_at')
                ->title('Creation Date')
                ->addClass('text-center'),
            Column::Computed('action')
                ->title('Action')
                ->addClass('text-center')
                ->exportable(false)
                ->printable(false)
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
        return 'PaymentDeclaration_' . date('YmdHis');
    }
}
