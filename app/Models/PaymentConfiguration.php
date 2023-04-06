<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PaymentConfiguration
 *
 * @property int $id
 * @property int $payment_type_id
 * @property int $request_type_id
 * @property int $operator_id
 * @property int $operation_area
 * @property float $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PaymentConfiguration newModelQuery()
 * @method static Builder|PaymentConfiguration newQuery()
 * @method static Builder|PaymentConfiguration query()
 * @method static Builder|PaymentConfiguration whereAmount($value)
 * @method static Builder|PaymentConfiguration whereCreatedAt($value)
 * @method static Builder|PaymentConfiguration whereId($value)
 * @method static Builder|PaymentConfiguration whereOperationArea($value)
 * @method static Builder|PaymentConfiguration whereOperatorId($value)
 * @method static Builder|PaymentConfiguration wherePaymentTypeId($value)
 * @method static Builder|PaymentConfiguration whereRequestTypeId($value)
 * @method static Builder|PaymentConfiguration whereUpdatedAt($value)
 *
 * @property int $operation_area_id
 * @property bool $is_active
 * @property-read OperationArea $operationArea
 * @property-read Operator $operator
 * @property-read PaymentType $paymentType
 * @property-read RequestType $requestType
 *
 * @method static Builder|PaymentConfiguration whereIsActive($value)
 * @method static Builder|PaymentConfiguration whereOperationAreaId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentMapping> $mappings
 * @property-read int|null $mappings_count
 *
 * @mixin Eloquent
 */
class PaymentConfiguration extends Model
{
    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function requestType(): BelongsTo
    {
        return $this->belongsTo(RequestType::class, 'request_type_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function operationArea(): BelongsTo
    {
        return $this->belongsTo(OperationArea::class, 'operation_area_id');
    }

    public function mappings(): HasMany
    {
        return $this->hasMany(PaymentMapping::class, 'payment_configuration_id');
    }
}
