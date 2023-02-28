<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LegalType extends Model
{
    use HasFactory;

    protected $table = 'legal_types';

    public function documentTypes(): BelongsToMany
    {
        return $this->belongsToMany(DocumentType::class, 'document_mapping');
    }
}


