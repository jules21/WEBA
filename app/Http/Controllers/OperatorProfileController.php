<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load('operator');
        return view('operator.profile', compact('user'));
    }
}
