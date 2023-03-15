<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OperatorUserDataTable extends DataTable
{

    public $query;
    public function __construct($query)
    {
        $this->query = $query;
    }
    /**
     * Build DataTables class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('operation_area', function ($item) {
                return $item->operationArea ? $item->operationArea->name : "-";
            })
            ->editColumn('phone', function ($item) {
                return $item->phone ? $item->phone : "-";
            })
            ->editColumn('roles', function ($item) {
                if(count($item->roles)>0){
                    $roles="";
                    foreach($item->roles as $role){
                        $roles .='<span class="badge badge-info mr-2" style="margin-bottom: 5px">'.$role->name.'</span>';
                    }
                    return $roles ;
                }else{
                    return "-";
                }

            })
            ->editColumn('status', function ($item) {
                if($item->status == 'active'){
                    return '
                    <span class="badge badge-success">Active</span>';
                }else{
                    return '
                 <span class="badge badge-danger">Inactive</span>
                    ';

                }
            })
            ->addColumn('action', function ($item) {
                return '<div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Actions
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="'.route("admin.user.add.roles",$item->id).'">Manage Roles</a>
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
                                       data-status="'.$item->status.'"
                                       data-operation_area="'.$item->operation_area.'"
                                       data-url="'.route("admin.users.update",$item->id).'"> Edit</a>

                                    <a href="#" class="dropdown-item delete-btn" data-toggle="modal"
                                       data-target="#delete-user-model"
                                       data-id="'.$item->id.'"
                                       data-url="'.route("admin.users.delete",encryptId($item->id)).'"> Delete</a>';
                                '</div>
                            </div>';
            })
            ->rawColumns(['action','roles','status','phone','operator']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param user $model
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
            'id' => ['title' => '#', 'searchable' => false, 'render' => function() {
                return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
            }],
            Column::make('operation_area')
                ->title("Operation Area")
                ->addClass('text-center'),
            Column::make('name'),
            Column::make('email')
                ->addClass('text-center'),
            Column::make('phone')
            ->addClass('text-center'),
            Column::make('status')
                ->name('status')
                ->title("Status")
                ->addClass('text-center'),
            Column::make('roles')
                ->title("Roles")
                ->name("roles.name")
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
