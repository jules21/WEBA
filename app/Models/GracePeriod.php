<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GracePeriod
 *
 * @property int $id
 * @property int $days
 * @property string $status
 * @property int|null $operation_area_id
 * @property int|null $contract_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\GracePeriodFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GracePeriod extends Model
{
    use HasFactory;
}
