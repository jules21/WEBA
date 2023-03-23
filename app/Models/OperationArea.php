<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OperationArea
 *
 * @property int $id
 * @property string $name
 * @property string|null $contact_person_name
 * @property string|null $contact_person_phone
 * @property string|null $contact_person_email
 * @property int|null $district_id
 * @property int $operator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\District|null $district
 * @property-read \App\Models\Operator $operator
 * @method static \Database\Factories\OperationAreaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereContactPersonEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereContactPersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereContactPersonPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChartAccount> $chartOfAccounts
 * @property-read int|null $chart_of_accounts_count
 * @mixin \Eloquent
 */
class OperationArea extends Model
{
    use HasFactory;

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);
        return $this->where('id', '=', $id)->firstOrFail();
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function chartOfAccounts(): HasMany
    {
        return $this->hasMany(ChartAccount::class);
    }

}
