<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentConfiguration extends Model
{
    use HasFactory;

    public function paymentType(){
        return $this->belongsTo(PaymentType::class,'payment_type_id');
    }

    public function requestType(){
        return $this->belongsTo(RequestType::class,'request_type_id');
    }

    public function operator(){
        return $this->belongsTo(Operator::class,'operator_id');
    }

    public function operationArea(){
        return $this->belongsTo(OperationArea::class,'operation_area_id');
    }
}
