<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Adjustment
 *
 * @property int $id
 * @property string $status Pending,Approved
 * @property string $description
 * @property int $operation_area_id
 * @property int $created_by
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Adjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'operation_area_id',
        'created_by',
        'approved_by',
    ];

    public function operationArea(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OperationArea::class);
    }

    public function items(): MorphMany
    {
        return $this->morphMany(StockMovementDetail::class, 'model', 'model_type', 'model_id');
    }
}
