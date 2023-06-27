<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOperatorRequest;
use App\Models\Operator;
use Illuminate\Http\Request;
use JsValidator;

class OperatorProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load('operator');
        $validator = JsValidator::make(
            (new UpdateOperatorRequest())
                ->rules()
        );

        return view('operator.profile', compact('user', 'validator'));
    }
}
