<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\IssueReport
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property int|null $client_id
 * @property int|null $operation_area_id
 * @property int|null $user_id
 * @property int|null $district_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReportDetail> $details
 * @property-read int|null $details_count
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereUserId($value)
 * @mixin \Eloquent
 */
class IssueReport extends Model
{
    use HasFactory;

    public function details(): HasMany
    {
        return $this->hasMany(IssueReportDetail::class);
    }
}
