<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clms_id
 * @property-read \App\Models\Cell|null $cell
 * @property-read \App\Models\District|null $district
 * @property-read string $full_address
 * @property-read string $logo_url
 * @property-read \App\Models\LegalType $legalType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OperationArea> $operationAreas
 * @property-read int|null $operation_areas_count
 * @property-read \App\Models\Province|null $province
 * @property-read \App\Models\Sector|null $sector
 * @property-read \App\Models\Village|null $village
 * @method static \Database\Factories\OperatorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereCellId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereClmsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereDocNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereLegalTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereVillageId($value)
 * @mixin \Eloquent
 */
class Operator extends Model
{
    use HasFactory;

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
        return $this->logo ? Storage::url(self::LOGO_PATH . $this->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=A6CE39&background=1068BF';
    }

    public function operationAreas(): HasMany
    {
        return $this->hasMany(OperationArea::class);
    }


}
