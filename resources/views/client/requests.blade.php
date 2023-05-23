@extends('client.layout.auth')
@section('breadcrumbs')
    <x-layouts.breadcrumb>

        <x-layouts.breadcrumb-item>
            Requests
        </x-layouts.breadcrumb-item>

        <x-slot name="actions">
        </x-slot>

    </x-layouts.breadcrumb>
@endsection
@section('content')
    <div class="card card-body h-100 tw-rounded-lg tw-bg-cover tw-bg-no-repeat tw-bg-center"
         style="background-image: url({{ asset('images/bg_logo.png') }});">
        <h4>
            @lang('app.all_requests')
        </h4>

        <div class="list-group list-group-flush mt-4">
            @forelse($recentRequests as $item)
                <div class="list-group-item d-flex flex-column flex-lg-row justify-content-between mb-3 bg-transparent">
                    <div class="d-flex align-items-start  flex-column flex-lg-row">
                        <img src="{{ $item->operator->logo_url }}" class="mr-3 tw-w-10" alt="...">
                        <div class="">
                            <div class="mt-0 mb-1 d-flex justify-content-between align-items-center">
                                <h5 class="">
                                    {{ $item->operator->name }}
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted mb-0">{{ $item->requestType->name }}</p>
                                <strong>Meter
                                    Requested:</strong> {{ $item->meter_qty }}
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <p class="mb-0">
                                    <strong>UPI:</strong> {{ $item->upi }},
                                </p>
                                <strong>Given meters:</strong> {{ $item->meter_numbers_count }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <div class="text-muted tw-text-xs mb-1">
                            {{ $item->created_at->format('d M Y') }}
                        </div>
                        <div>
                            @if($item->return_back_status==\App\Constants\Status::RETURN_BACK)
                                <span class="badge badge-warning rounded-pill align-self-start tw-py-1.5 tw-px-2">Returned Back</span>
                            @endif
                            <span
                                class="badge badge-{{ $item->status_color }} rounded-pill tw-py-1.5 tw-px-2">{{ $item->status }}</span>
                            <a href="{{ route('client.request-details',encryptId($item->id)) }}"
                               class="btn btn-secondary btn-sm rounded-sm">
                                @lang('app.details')
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <li class="list-group-item list-group-item-action">
                    <div class="alert alert-info">
                        No recent requests found,you can use "New Connection" button to create a new request.
                    </div>
                </li>
            @endforelse

        </div>

        <div class="d-flex justify-content-between flex-column flex-lg-row tw-gap-2 mt-4">
            <div>
                Showing {{ $recentRequests->firstItem() }} to {{ $recentRequests->lastItem() }}
                of {{ $recentRequests->total() }} entries
            </div>
            <div>
                {{ $recentRequests->links() }}
            </div>
        </div>
    </div>

@endsection
