<?php

namespace App\Models;

use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PaymentDeclaration
 *
 * @property int $id
 * @property int|null $request_id
 * @property int $payment_configuration_id
 * @property string $amount
 * @property string|null $payment_reference
 * @property string $type
 * @property string $balance
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $status_color
 *
 * @method static Builder|PaymentDeclaration newModelQuery()
 * @method static Builder|PaymentDeclaration newQuery()
 * @method static Builder|PaymentDeclaration query()
 * @method static Builder|PaymentDeclaration whereAmount($value)
 * @method static Builder|PaymentDeclaration whereBalance($value)
 * @method static Builder|PaymentDeclaration whereCreatedAt($value)
 * @method static Builder|PaymentDeclaration whereId($value)
 * @method static Builder|PaymentDeclaration wherePaymentConfigurationId($value)
 * @method static Builder|PaymentDeclaration wherePaymentReference($value)
 * @method static Builder|PaymentDeclaration whereRequestId($value)
 * @method static Builder|PaymentDeclaration whereStatus($value)
 * @method static Builder|PaymentDeclaration whereType($value)
 * @method static Builder|PaymentDeclaration whereUpdatedAt($value)
 *
 * @property-read \App\Models\PaymentConfiguration $paymentConfig
 * @property-read \App\Models\Request|null $request
 *
 * @mixin Eloquent
 */
class PaymentDeclaration extends Model implements Auditable
{
    use HasStatusColor, \OwenIt\Auditing\Auditable;

    const ACTIVE = 'active';

    const PAID = 'paid';

    const PARTIALLY_PAID = 'partially paid';

    public function generateReferenceNumber($prefix = 'CMS', $length = 8): string
    {
        $number = str_pad($this->id, $length, '0', STR_PAD_LEFT);
        $ref = $prefix.$number;
        $this->payment_reference = $ref;
        $this->save();

        return $ref;
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function paymentConfig(): BelongsTo
    {
        return $this->belongsTo(PaymentConfiguration::class, 'payment_configuration_id');
    }

    public function paymentHistories(): HasMany
    {
        return $this->hasMany(PaymentHistory::class, 'payment_declaration_id');
    }
}
