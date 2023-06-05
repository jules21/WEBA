<?php

namespace App\Models;

use App\Traits\GetClassName;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\MeterRequest
 *
 * @property int $id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $request_id
 * @property string $meter_number
 * @property string $subscription_number
 * @property string $last_index
 * @property string $balance
 * @method static Builder|MeterRequest newModelQuery()
 * @method static Builder|MeterRequest newQuery()
 * @method static Builder|MeterRequest query()
 * @method static Builder|MeterRequest whereBalance($value)
 * @method static Builder|MeterRequest whereCreatedAt($value)
 * @method static Builder|MeterRequest whereId($value)
 * @method static Builder|MeterRequest whereLastIndex($value)
 * @method static Builder|MeterRequest whereMeterNumber($value)
 * @method static Builder|MeterRequest whereRequestId($value)
 * @method static Builder|MeterRequest whereStatus($value)
 * @method static Builder|MeterRequest whereSubscriptionNumber($value)
 * @method static Builder|MeterRequest whereUpdatedAt($value)
 * @property int|null $item_category_id
 * @property int|null $item_id
 * @property-read \App\Models\Billing|null $billing
 * @property-read \App\Models\Request $request
 * @method static Builder|MeterRequest whereItemCategoryId($value)
 * @method static Builder|MeterRequest whereItemId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read int|null $delivery_items_count
 * @property-read \App\Models\Item|null $item
 * @property-read \App\Models\ItemCategory|null $itemCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $stockMovementDetails
 * @property-read int|null $stock_movement_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Billing> $billings
 * @property-read int|null $billings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $stockMovementDetails
 * @mixin Eloquent
 */
class MeterRequest extends Model
{
    use GetClassName;

    protected $guarded = [];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', '=', decryptId($value))->firstOrFail();
    }

    public function billing(): HasOne
    {
        return $this->hasOne(Billing::class, 'subscription_number', 'subscription_number');
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function itemCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function deliveryItems(): HasMany
    {
        return $this->hasMany(RequestDeliveryDetail::class, 'meter_request_id');
    }

    public function stockMovementDetails()
    {
        return $this->morphMany(StockMovementDetail::class, 'model');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'subscription_number', 'subscription_number');
    }
}
