<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentConfiguration
 *
 * @property int $id
 * @property int $payment_type_id
 * @property int $request_type_id
 * @property int $operator_id
 * @property int $operation_area
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereOperationArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration wherePaymentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereRequestTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentConfiguration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentConfiguration extends Model
{
    use HasFactory;
}
