<?php

namespace App\Models;

use Database\Factories\OperatorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Storage;

/**
 * App\Models\Operator
 *
 * @property int $id
 * @property string $name
 * @property int $legal_type_id
 * @property string $id_type
 * @property string $doc_number
 * @property string|null $address
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $sector_id
 * @property int|null $cell_id
 * @property int|null $village_id
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $clms_id
 * @property-read Cell|null $cell
 * @property-read District|null $district
 * @property-read string $full_address
 * @property-read string $logo_url
 * @property-read LegalType $legalType
 * @property-read Collection<int, OperationArea> $operationAreas
 * @property-read int|null $operation_areas_count
 * @property-read Province|null $province
 * @property-read Sector|null $sector
 * @property-read Village|null $village
 *
 * @method static OperatorFactory factory(...$parameters)
 * @method static Builder|Operator newModelQuery()
 * @method static Builder|Operator newQuery()
 * @method static Builder|Operator query()
 * @method static Builder|Operator whereAddress($value)
 * @method static Builder|Operator whereCellId($value)
 * @method static Builder|Operator whereClmsId($value)
 * @method static Builder|Operator whereCreatedAt($value)
 * @method static Builder|Operator whereDistrictId($value)
 * @method static Builder|Operator whereDocNumber($value)
 * @method static Builder|Operator whereId($value)
 * @method static Builder|Operator whereIdType($value)
 * @method static Builder|Operator whereLegalTypeId($value)
 * @method static Builder|Operator whereLogo($value)
 * @method static Builder|Operator whereName($value)
 * @method static Builder|Operator whereProvinceId($value)
 * @method static Builder|Operator whereSectorId($value)
 * @method static Builder|Operator whereUpdatedAt($value)
 * @method static Builder|Operator whereVillageId($value)
 *
 * @property-read Collection<int, \App\Models\Customer> $customers
 * @property-read int|null $customers_count
 * @property-read Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 *
 * @mixin Eloquent
 */
class Operator extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $appends = ['logo_url'];

    const LOGO_PATH = 'operators/logos/';

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);
        // find the model by id
        return $this->where('id', $id)->firstOrFail();
    }

    public function legalType(): BelongsTo
    {
        return $this->belongsTo(LegalType::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function cell(): BelongsTo
    {
        return $this->belongsTo(Cell::class);
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address . ' ' . $this->village->name . ' ' . $this->cell->name . ' ' . $this->sector->name . ' ' . $this->district->name . ' ' . $this->province->name;
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->logo ? Storage::url(self::LOGO_PATH . $this->logo) : asset('img/logo.svg');
    }

    public function operationAreas(): HasMany
    {
        return $this->hasMany(OperationArea::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'operator_id');
    }

    public function stocks(): HasManyThrough
    {
        return $this->hasManyThrough(Stock::class, OperationArea::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'operator_id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'operator_id');
    }

    public function findCustomerByDocNumber($docNumber)
    {
        return Customer::query()
            ->where([
                ['doc_number', '=', $docNumber],
                ['operator_id', '=', $this->id]
            ])
            ->first();
    }
}
