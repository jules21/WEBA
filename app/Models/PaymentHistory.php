<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PaymentHistory newModelQuery()
 * @method static Builder|PaymentHistory newQuery()
 * @method static Builder|PaymentHistory query()
 * @method static Builder|PaymentHistory whereAmount($value)
 * @method static Builder|PaymentHistory whereCreatedAt($value)
 * @method static Builder|PaymentHistory whereId($value)
 * @method static Builder|PaymentHistory whereNarration($value)
 * @method static Builder|PaymentHistory wherePaymentDate($value)
 * @method static Builder|PaymentHistory wherePaymentDeclarationId($value)
 * @method static Builder|PaymentHistory wherePaymentMappingId($value)
 * @method static Builder|PaymentHistory wherePspReferenceNumber($value)
 * @method static Builder|PaymentHistory whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PaymentHistory extends Model
{
    protected $dates = ['payment_date'];

    protected $guarded = [];

    public function paymentDeclaration(): BelongsTo
    {
        return $this->belongsTo(PaymentDeclaration::class);
    }

    public function mapping(): BelongsTo
    {
        return $this->belongsTo(PaymentMapping::class, 'payment_mapping_id');
    }
}
