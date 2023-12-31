<?php

namespace App\Models;

use App\Traits\HasAddress;
use Database\Factories\CustomerFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $document_type_id
 * @property-read DocumentType $documentType
 * @property-read LegalType $legalType
 * @method static CustomerFactory factory(...$parameters)
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereCellId($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereDistrictId($value)
 * @method static Builder|Customer whereDocNumber($value)
 * @method static Builder|Customer whereDocumentTypeId($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereLegalTypeId($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer wherePhone($value)
 * @method static Builder|Customer whereProvinceId($value)
 * @method static Builder|Customer whereSectorId($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @method static Builder|Customer whereVillageId($value)
 * @property-read Cell|null $cell
 * @property-read Collection<int, MeterRequest> $connections
 * @property-read int|null $connections_count
 * @property-read District|null $district
 * @property-read string $address
 * @property-read Collection<int, Operator> $operators
 * @property-read int|null $operators_count
 * @property-read Province|null $province
 * @property-read Collection<int, Request> $requests
 * @property-read int|null $requests_count
 * @property-read Sector|null $sector
 * @property-read Village|null $village
 * @property int|null $operator_id
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read OperationArea $operationArea
 * @property-read Operator|null $operator
 * @method static Builder|Customer whereOperatorId($value)
 * @property-read Collection<int, Audit> $audits
 * @property-read int|null $audits_count
 * @property-read Collection<int, Audit> $audits
 * @property-read Collection<int, \App\Models\MeterRequest> $connections
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read Collection<int, \App\Models\Request> $requests
 * @mixin Eloquent
 */
class Customer extends Model implements Auditable
{
    use HasFactory, Notifiable, \OwenIt\Auditing\Auditable;
    use HasAddress;

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', '=', decryptId($value))->firstOrFail();
    }

    public function legalType(): BelongsTo
    {
        return $this->belongsTo(LegalType::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function operators(): bool
    {
        return $this->hasMacro(Operator::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    // has many connections through requests
    public function connections()
    {
        return $this->hasManyThrough(MeterRequest::class, Request::class);
    }

    public function operationArea(): BelongsTo
    {
        return $this->belongsTo(OperationArea::class);
    }
}
