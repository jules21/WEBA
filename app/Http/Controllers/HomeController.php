<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Operator;
use App\Models\Request;
use App\Models\WaterNetwork;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Contracts\Support\Renderable;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class HomeController extends Controller
{


    public function welcome()
    {
        $operators = Operator::query()->inRandomOrder()->get();
        $totalCustomers = Customer::query()
            ->whereHas('requests', function ($query) {
                $query->whereNotIn('status', [Request::REJECTED, Request::ASSIGNED, Request::PENDING]);
            })->count();
        $totalWaterConnections = Request::query()->whereHas('meterNumbers')->count();
        $totalWaterNetworks = WaterNetwork::query()->count();
        return view('welcome', [
            'operators' => $operators,
            'totalCustomers' => $totalCustomers,
            'totalWaterConnections' => $totalWaterConnections,
            'totalWaterNetworks' => $totalWaterNetworks,
        ]);
    }

}
