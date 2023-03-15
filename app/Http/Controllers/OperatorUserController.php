<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorUserDataTable;
use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorUserController extends Controller
{
    // get operator users
    public function index($operatorId)
    {
        $operator = Operator::findOrFail(decryptId($operatorId));
        $operator->load(['operationAreas']);
        $users = $operator->users()->with(['roles','operationArea'])->select('users.*');
        $datatable = new OperatorUserDatatable($users);
        return $datatable->render('admin.operator.users', compact('operator'));
    }
}
