<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\ItemSellingPrice;
use App\Models\ItemSellPrice;
use App\Models\PaymentConfiguration;
use App\Models\PaymentMapping;
use App\Models\Province;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use App\Models\RoadCrossType;
use App\Models\RoadType;
use App\Models\Sector;
use App\Models\StockMovement;
use App\Models\WaterUsage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use LaravelIdea\Helper\App\Models\_IH_RequestType_C;
use LaravelIdea\Helper\App\Models\_IH_RequestType_QB;
use LaravelIdea\Helper\App\Models\_IH_Sector_C;
use LaravelIdea\Helper\App\Models\_IH_Sector_QB;
use LaravelIdea\Helper\App\Models\_IH_WaterUsage_C;
use LaravelIdea\Helper\App\Models\_IH_WaterUsage_QB;

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
     * @return WaterUsage[]|Builder[]|\Illuminate\Database\Eloquent\Collection|_IH_WaterUsage_C|_IH_WaterUsage_QB[]
     */
    public function getWaterUsages()
    {
        return WaterUsage::query()->get();
    }

    public function getRoadTypes(): Collection
    {
        return RoadType::query()
            ->pluck('name');
    }

    /**
     * @return RequestType[]|Builder[]|\Illuminate\Database\Eloquent\Collection|_IH_RequestType_C|_IH_RequestType_QB[]
     */
    public function getRequestsTypes()
    {
        return RequestType::query()->where('is_active', '=', true)->get();
    }

    /**
     * @return RoadCrossType[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_RoadCrossType_C|\LaravelIdea\Helper\App\Models\_IH_RoadCrossType_QB[]
     */
    public function getRoadCrossTypes()
    {
        return RoadCrossType::query()->get();
    }

    /**
     * @return Sector[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection|_IH_Sector_C|_IH_Sector_QB[]
     */
    public function getSectors($operationArea)
    {
        return Sector::query()
            ->where('district_id', '=', $operationArea->district_id)
            ->orderBy('name')
            ->get();
    }

    public function saveFlowHistory($req, $message, $status = Status::SUBMITTED, bool $isComment = false, string $fileName = null): void
    {
        $req->flowHistories()
            ->create([
                'type' => $req->getClassName(),
                'status' => $status,
                'user_id' => auth('web')->id() ?? null,
                'comment' => $message,
                'attachment' => $fileName,
                'is_comment' => $isComment,
            ]);
    }

    protected function updateMovementFromOldest($item, $quantity, $parent_movement = null): void
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
            $qty = $movement->qty_in;//20 30

            $movement->update([
                'qty_available' => $qty > $quantity ? $qty - $quantity : 0,
            ]);

            //save item selling price for each movement
            ItemSellingPrice::query()->create([
                'item_id' => $item->id,
                'operation_area_id' => auth()->user()->operation_area,
                'stock_movement_id' => $movement->id,
                'price' => $movement->unit_price,
                'quantity' => $qty > $quantity ? $quantity : $qty,
                'currency_id' => $item->currency_id,
                'parent_movement_id' => $parent_movement->id,
            ]);

            $quantity = $qty > $quantity ? 0 : $quantity - $qty;

            if ($quantity <= 0) break;
        }


    }

    protected function getItemLastUnitPrice($item)
    {
        $movement = StockMovement::query()
            ->where('item_id', '=', $item->id)
            ->where('operation_area_id', '=', auth()->user()->operation_area)
            ->orderBy('created_at', 'desc')
            ->first();

        return $movement ? $movement->unit_price : 0;
    }

    public function getProvinces()
    {
        return Province::query()->get();
    }


}
