<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\IssueReportDetail
 *
 * @property int $id
 * @property int $issue_report_id
 * @property int $user_id
 * @property string $user_type
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IssueReport $issueReport
 * @property-read Model|Eloquent $user
 * @method static Builder|IssueReportDetail newModelQuery()
 * @method static Builder|IssueReportDetail newQuery()
 * @method static Builder|IssueReportDetail query()
 * @method static Builder|IssueReportDetail whereCreatedAt($value)
 * @method static Builder|IssueReportDetail whereDescription($value)
 * @method static Builder|IssueReportDetail whereId($value)
 * @method static Builder|IssueReportDetail whereIssueReportId($value)
 * @method static Builder|IssueReportDetail whereUpdatedAt($value)
 * @method static Builder|IssueReportDetail whereUserId($value)
 * @method static Builder|IssueReportDetail whereUserType($value)
 * @property-read User $client
 * @property-read Model|Eloquent $model
 * @property int|null $district_id
 * @method static Builder|IssueReportDetail whereDistrictId($value)
 * @mixin Eloquent
 */
class IssueReportDetail extends Model
{


    public function issueReport(): BelongsTo
    {
        return $this->belongsTo(IssueReport::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo('model', 'user_type', 'user_id');
    }


}
