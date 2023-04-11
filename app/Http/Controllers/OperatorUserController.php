<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorUserDataTable;
use App\Models\OperationArea;
use App\Models\Operator;

class OperatorUserController extends Controller
{
    // get operator users
    public function index($operatorId)
    {
        $operator = Operator::findOrFail(decryptId($operatorId));
        $operator->load(['operationAreas']);
        $users = $operator->users()->with(['roles', 'operationArea'])->select('users.*');
        $datatable = new OperatorUserDatatable($users);

        return $datatable->render('admin.operator.users', compact('operator'));
    }

    public function operatorAreaUsers($operationAreaId)
    {
        $operationArea = OperationArea::findOrFail(decryptId($operationAreaId));
        $users = $operationArea->users()->with(['roles', 'operationArea'])->select('users.*');
        $datatable = new OperatorUserDatatable($users);
        $operator = $operationArea->operator;

        return $datatable->render('admin.operator.users', compact('operationArea', 'operator'));
    }
}
