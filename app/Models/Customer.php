<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property int $legal_type_id
 * @property string $doc_number
 * @property string|null $email
 * @property string $phone
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $sector_id
 * @property int|null $cell_id
 * @property int|null $village_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $document_type_id
 * @property-read \App\Models\DocumentType $documentType
 * @property-read \App\Models\LegalType $legalType
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCellId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDocNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLegalTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereVillageId($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory;

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id','=',decryptId($value))->firstOrFail();
    }

    public function legalType(): BelongsTo
    {
        return $this->belongsTo(LegalType::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}
