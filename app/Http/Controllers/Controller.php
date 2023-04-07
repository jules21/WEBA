<?php

namespace App\Http\Controllers;

use App\Models\PaymentConfiguration;
use App\Models\PaymentMapping;
use App\Models\StockMovement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getPsp(PaymentConfiguration $configuration)
    {
        $mappings = PaymentMapping::query()
            ->with('account.paymentServiceProvider')
            ->where('payment_configuration_id', '=', $configuration->id)
            ->get();

        $pspNames = [];
        foreach ($mappings as $mapping) {
            $psp = $mapping->account->paymentServiceProvider;
            $pspNames[] = $psp->name;
        }

        return implode(', ', $pspNames);
    }

    /**
     * @param $item
     * @param $quantity
     * @return void
     */
    protected function updateMovementFromOldest($item, $quantity): void
    {
        $movements = StockMovement::query()
            ->where([
                ['qty_available', '>', 0],
                ['operation_area_id', '=', auth()->user()->operation_area],
                ['item_id', '=', $item->id],
            ])
            ->orderBy('created_at')
            ->get();

        foreach ($movements as $movement) {
            $qty = $movement->qty_in;

            $movement->update([
                'qty_available' => $qty > $quantity ? $qty - $quantity : 0,
            ]);

            $quantity = $qty > $quantity ? 0 : $quantity - $qty;
            if ($quantity <= 0) break;
        }
    }
}
