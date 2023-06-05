<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RequestAssignment
 *
 * @property int $id
 * @property int $request_id
 * @property int $user_id
 * @property int $assigned_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereAssignedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereUserId($value)
 * @mixin \Eloquent
 */
class RequestAssignment extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
