<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\IssueReportDetail
 *
 * @property int $id
 * @property int $issue_report_id
 * @property int $user_id
 * @property string $user_type
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IssueReport $issueReport
 * @property-read Model|\Eloquent $user
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereIssueReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereUserType($value)
 * @mixin \Eloquent
 */
class IssueReportDetail extends Model
{
    use HasFactory;

    public function issueReport(): BelongsTo
    {
        return $this->belongsTo(IssueReport::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo('user');
    }
}
