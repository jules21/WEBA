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

    public static function hasOperationArea(): bool
    {
        $user = auth()->user();
        return $user->operation_area != null;
    }

    public static function isSuperAdmin(): bool
    {
        $user = auth()->user();
        return $user->is_super_admin || auth()->user()->operator_id == null;
    }
    public static function paymentDeclarationStatuses(): array
    {
        return [
            \App\Models\PaymentDeclaration::ACTIVE => 'Pending',//Active
            \App\Models\PaymentDeclaration::PAID => 'Paid',
            \App\Models\PaymentDeclaration::PARTIALLY_PAID => 'Partially Paid',
        ];
    }

    public static function stockCardInitiator($card_id): string
    {
        $card = \App\Models\StockMovement::query()->find($card_id);
        if ($card->type == \App\Models\StockMovement::Adjustment){
            $adjustment = \App\Models\Adjustment::query()->find($card->adjustment_id);
            return $adjustment ? optional($adjustment->createdBy)->name : '-';
        }elseif ($card->type == \App\Models\StockMovement::StockIn){
            $purchase = \App\Models\Purchase::query()->find($card->purchase_id);
            return $purchase ? optional($purchase->createdBy)->name : '-';
        }elseif ($card->type == \App\Models\StockMovement::StockOut){
            $request = \App\Models\Request::query()->find($card->request_id);
            return $request ? optional(optional($request->requestAssignment)->user)->name : '-';
        }else
            return '-';
    }
}
