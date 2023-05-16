<?php

namespace App\Http\Livewire\Client;

use App\Models\PaymentDeclaration;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Payments extends Component
{
    public $search = '';
    protected $queryString = [
        'search' => ['except' => '']
    ];


    public function render()
    {
        $payments = PaymentDeclaration::with('paymentHistories.mapping.account.paymentServiceProvider', 'request.operator')
            ->whereHas('request', function (Builder $builder) {
                $builder->whereHas('customer', function (Builder $builder) {
                    $builder->where([
                        ['doc_number', '=', auth('client')->user()->doc_number],
                        ['document_type_id', '=', auth('client')->user()->document_type_id]
                    ]);
                });
            })
            ->when($this->search, function (Builder $builder) {
                $builder->where(function (Builder $builder) {
                    $builder->where('payment_reference', 'ilike', "%{$this->search}%")
                        ->orWhere('type', 'ilike', "%{$this->search}%")
                        ->orWhere('status', 'ilike', "%{$this->search}%")
                        ->orWhereHas('request',function (Builder $builder){
                            $builder->whereHas('operator',function (Builder $builder){
                                $builder->where('name','ilike',"%{$this->search}%");
                            });
                        });
                });
            })
            ->latest()
            ->paginate(10);
        return view('livewire.client.payments', [
            'payments' => $payments
        ])->extends('client.layout.auth');
    }
}
