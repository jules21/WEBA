<?php

namespace App\Http\Livewire\Client;

use App\Models\IssueReport;
use App\Traits\HasStatusColor;
use Livewire\Component;
use Livewire\WithPagination;

class IssuesReported extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $issues = IssueReport::with(['details.model', 'operator', 'operatingArea'])
            ->where('client_id','=',auth('client')->id())
            ->latest()
            ->paginate(10);

        return view('livewire.client.issues-reported', [
            'issues' => $issues
        ]);
    }
}
