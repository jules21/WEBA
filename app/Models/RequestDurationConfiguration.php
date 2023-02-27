<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDurationConfiguration extends Model
{
    use HasFactory;

    public function requestType(){
        return $this->belongsTo(RequestType::class,'request_type_id');
    }

    public function operator(){
        return $this->belongsTo(Operator::class,'operator_id');
    }

    public function operatorArea(){
        return $this->belongsTo(AreaOfOperation::class,'operation_area_id');
    }
}
