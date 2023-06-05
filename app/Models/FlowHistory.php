<?php

namespace App\Models;

use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\FlowHistory
 *
 * @property int $id
 * @property int $model_id
 * @property string $model_type
 * @property string|null $comment
 * @property string $status
 * @property string $type
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $model
 * @method static Builder|FlowHistory newModelQuery()
 * @method static Builder|FlowHistory newQuery()
 * @method static Builder|FlowHistory query()
 * @method static Builder|FlowHistory whereComment($value)
 * @method static Builder|FlowHistory whereCreatedAt($value)
 * @method static Builder|FlowHistory whereId($value)
 * @method static Builder|FlowHistory whereModelId($value)
 * @method static Builder|FlowHistory whereModelType($value)
 * @method static Builder|FlowHistory whereStatus($value)
 * @method static Builder|FlowHistory whereType($value)
 * @method static Builder|FlowHistory whereUpdatedAt($value)
 * @method static Builder|FlowHistory whereUserId($value)
 * @property bool $is_comment
 * @property-read string $status_color
 * @property-read User $user
 * @method static Builder|FlowHistory whereIsComment($value)
 * @property string|null $attachment
 * @property-read mixed $attachment_url
 * @method static Builder|FlowHistory whereAttachment($value)
 * @mixin Eloquent
 */
class FlowHistory extends Model
{
    use HasStatusColor;

    protected $appends = [
        'attachment_url'
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->attachment && Storage::exists($this->attachment) ? Storage::url($this->attachment) : null;
    }
}
