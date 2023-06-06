<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Sector
 *
 * @property int $id
 * @property string $name
 * @property int $district_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @property-read int|null $cells_count
 * @method static \Database\Factories\SectorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @mixin \Eloquent
 */
class Sector extends Model
{
    use HasFactory;

    public function cells(): HasMany
    {
        return $this->hasMany(Cell::class);
    }
    public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
