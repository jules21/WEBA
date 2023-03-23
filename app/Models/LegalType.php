<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\LegalType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 * @property-read int|null $document_types_count
 * @method static \Database\Factories\LegalTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 * @mixin \Eloquent
 */
class LegalType extends Model
{
    use HasFactory;

    protected $table = 'legal_types';

    public function documentTypes(): BelongsToMany
    {
        return $this->belongsToMany(DocumentType::class, 'document_mapping');
    }
}


