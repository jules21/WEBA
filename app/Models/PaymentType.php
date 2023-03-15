<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PaymentTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereUpdatedAt($value)
 * @property string|null $name_kin
 * @property bool $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereNameKin($value)
 * @mixin \Eloquent
 */
class PaymentType extends Model
{
    use HasFactory;

    const CONNECTION_FEE = 1;
    const METERS_FEE = 2;
    const MATERIALS_FEE = 3;


}
