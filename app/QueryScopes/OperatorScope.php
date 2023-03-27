<?php

namespace App\QueryScopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use PhpParser\Node\Expr\AssignOp\Mod;

class OperatorScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user();
        $builder
            ->when($user->operation_area, function ($builder) use ($user) {
                $builder->where('operation_area_id', $user->operation_area);
            })
            ->when($user->operator_id && !$user->operation_area, function ($builder) use ($user) {
                $builder->whereHas('operationArea', function ($query) use ($user) {
                    $query->where('operator_id', $user->operator_id);
                });
            });
    }
}
