<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 * @property-read int|null $bill_charges_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property string|null $license_number
 * @property string|null $valid_from
 * @property string|null $valid_to
 * @property string|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChartAccount> $chartOfAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReport> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereValidTo($value)
 * @mixin \Eloquent
 */
class OperationArea extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

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

    public function billCharges(): HasMany
    {
        return $this->hasMany(BillCharge::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'operation_area');
    }

    public function issues(): hasMany
    {
        return $this->hasMany(IssueReport::class, 'operation_area_id');
    }
}
