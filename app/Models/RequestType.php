<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RequestTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RequestType extends Model
{
    use HasFactory;
}
