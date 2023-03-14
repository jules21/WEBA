<?php

class Helper{
    public static function generatePassword($length = 8): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }
    public static function getRandomModelId($model): int
    {
        $count = $model::count();
        if ($count > 0){
            return rand(1, $count);
        }else{
            return $model::factory()->create()->id;
        }
    }
    public static function isOperator(): bool
    {
        $user = auth()->user();
        return $user->operator_id != null;
    }

//    public static function movementDetails($operation_area, $item)
//    {
//        return StockMovementDetail::query()
//            ->whereHas('stockMovement', function ($query) use ($operation_area) {
//                $query->where('operation_area_id', $operation_area);
//            })
//            ->where('item_id', $item)
//            ->get();
//    }
}
