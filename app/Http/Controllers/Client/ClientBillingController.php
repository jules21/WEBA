<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ClientBillingController extends Controller
{
    public function index()
    {
        return view('client.billing');
    }
}
