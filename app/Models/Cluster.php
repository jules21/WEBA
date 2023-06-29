<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Cluster
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $expiration_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $district_id
 * @property-read \App\Models\District|null $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sector> $sectors
 * @property-read int|null $sectors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WaterNetwork> $waterNetworks
 * @property-read int|null $water_networks_count
 * @method static \Database\Factories\ClusterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cluster extends Model
{
    use HasFactory;

    protected $dates = ['expiration_date'];

    public function sectors(): BelongsToMany
    {
        return $this->belongsToMany(Sector::class, 'cluster_sector');
    }

    public function waterNetworks(): BelongsToMany
    {
        return $this->belongsToMany(WaterNetwork::class, 'cluster_water_network');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
