<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlowHistory whereUserId($value)
 * @mixin \Eloquent
 */
class FlowHistory extends Model
{
   // create a polymorphic relationship
    public function model(): MorphTo
    {
         return $this->morphTo();
    }
}
