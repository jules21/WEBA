<?php

namespace App\Http\Livewire\Client;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ClientBilling extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function render()
    {
        $billings = Billing::query()
            ->with(['meterRequest.request.operator', 'user'])
            ->whereHas('meterRequest', function (Builder $builder) {
                $builder->whereHas('request', function (Builder $builder) {
                    $builder->whereHas('customer', function (Builder $builder) {
                        $client = auth('client')->user();
                        $builder->where([
                            ['doc_number', '=', $client->doc_number],
                            ['document_type_id', '=', $client->document_type_id]
                        ]);
                    });
                });
            })
            ->when(!empty($this->search), function (Builder $builder) {
                $builder->where('meter_number', 'like', '%' . $this->search . '%')
                    ->orWhere('subscription_number', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
        return view('livewire.client.billing', [
            'billings' => $billings
        ])->layout('client.layout.auth');
    }
}
