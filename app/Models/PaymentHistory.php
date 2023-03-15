<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentHistory
 *
 * @property int $id
 * @property int $payment_declaration_id
 * @property int $payment_mapping_id
 * @property string $amount
 * @property string|null $psp_reference_number
 * @property string $payment_date
 * @property string|null $narration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereNarration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePaymentDeclarationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePaymentMappingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePspReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentHistory extends Model
{
    use HasFactory;
}
