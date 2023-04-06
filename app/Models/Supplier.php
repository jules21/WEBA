<?php

namespace App\Models;

use Database\Factories\SupplierFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string|null $email
 * @property string $address
 * @property string|null $contact_name
 * @property string|null $contact_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $operator_id
 *
 * @method static SupplierFactory factory(...$parameters)
 * @method static Builder|Supplier newModelQuery()
 * @method static Builder|Supplier newQuery()
 * @method static Builder|Supplier query()
 * @method static Builder|Supplier whereAddress($value)
 * @method static Builder|Supplier whereContactEmail($value)
 * @method static Builder|Supplier whereContactName($value)
 * @method static Builder|Supplier whereCreatedAt($value)
 * @method static Builder|Supplier whereEmail($value)
 * @method static Builder|Supplier whereId($value)
 * @method static Builder|Supplier whereName($value)
 * @method static Builder|Supplier whereOperatorId($value)
 * @method static Builder|Supplier wherePhoneNumber($value)
 * @method static Builder|Supplier whereUpdatedAt($value)
 *
 * @property-read \App\Models\Operator|null $operator
 *
 * @mixin Eloquent
 */
class Supplier extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
