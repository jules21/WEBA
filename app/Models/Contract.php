<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function getContractUrlAttribute(){
        return \Storage::url('public/contract/attachments' .$this->attachment);
    }

    public function operationArea()
    {
        return $this->belongsTo(OperationArea::class, 'operation_area_id');
    }
}
