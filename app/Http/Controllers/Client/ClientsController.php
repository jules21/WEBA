<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function newConnection()
    {
        return view('clients.new_connections');
    }
}
