<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Build DataTables class.
     *
     * @param  mixed  $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('district', function ($item) {
                return $item->district ? $item->district->name : '-';
            })
            ->editColumn('name', function ($item) {
                return '<div>
                            <div class="font-weight-bold">'.$item->name.'</div>
                            <div class="text-muted mt-1">'.
                                    ($item->institution ? optional($item->institution)->name :
                                    (! $item->operator ? '-' : (optional($item->operator)->name.
                                        ($item->operationArea ? '/ '.optional($item->operationArea)->name : ''))))
                                    .'</div>
                        </div>';
            })
            ->editColumn('phone', function ($item) {
                return $item->phone ? $item->phone : '-';
            })
            ->editColumn('roles', function ($item) {
                if (count($item->roles) > 0) {
                    $roles = '';
                    foreach ($item->roles as $key => $role) {
                        if ($key == 0) {
                            $roles .= \Str::slug($role->name);
                        } else {
                        $roles .= ','.\Str::slug($role->name);
                        }
                    }

                    return '<a href="#" class="label label-info label-inline" data-toggle="tooltip" data-trigger="focus" data-html="true" title='.$roles.'>
                                    '.count($item->roles).'
                                </a>';
                } else {
                    return '-';
                }

            })
            ->editColumn('status', function ($item) {
                if ($item->status == 'active') {
                    return '
                    <span class="badge badge-success">Active</span>';
                } else {
                    return '
                 <span class="badge badge-danger">Inactive</span>
                    ';

                }
            })
            ->addColumn('action', function ($item) {
                return '<div class="btn-group">
                                <button type="button" class="btn btn-light-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Actions
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="'.route('admin.user.add.roles', $item->id).'">Manage Roles</a>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="edit-btn dropdown-item "
                                       data-toggle="modal"
                                       data-target="#edit-user-model"
                                       data-name="'.$item->name.'"
                                       data-email="'.$item->email.'"
                                       data-phone="'.$item->phone.'"
                                       data-gender="'.$item->gender.'"
                                       data-id="'.$item->id.'"
                                       data-operator="'.$item->operator_id.'"
                                       data-national_id="'.$item->national_id.'"
                                       data-institution="'.$item->institution_id.'"
                                       data-status="'.$item->status.'"
                                        data-district="'.$item->district_id.'"
                                       data-url="'.route('admin.users.update', $item->id).'"> Edit</a>';

            })
            ->rawColumns(['action', 'roles', 'status', 'phone', 'operator', 'name', 'district']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            ->setTableId('datadatatable-table')
            ->addTableClass('table table-striped- table-hover table-checkable')
            ->columns($this->getColumns())
            ->minifiedAjax();
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
            //            Column::make('institution_id')//must be column name in database
            //                ->title("Institution")
            //                ->name("institution.name") //must be relation name in model
            //                ->addClass('text-center'),
            //            Column::make('operator')
            //                ->title("Operator")
            //                ->addClass('text-center'),
            Column::make('name'),
            Column::make('email')
                ->addClass('text-center'),
            Column::make('phone')
            ->addClass('text-center'),
            Column::make('status')
                ->name('status')
                ->title('Status')
                ->addClass('text-center'),
            Column::make('roles')
                ->title('Roles')
                ->name('roles.name')
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
