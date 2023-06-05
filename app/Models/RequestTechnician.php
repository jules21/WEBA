<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestTechnician
 *
 * @property int $id
 * @property int $request_id
 * @property string $name
 * @property string $phone_number
 * @property string|null $email
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RequestTechnician extends Model
{
    use HasFactory;
}
