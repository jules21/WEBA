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
            Recent Requests
        </h4>

        <ul class="list-group list-group-flush mt-4">
            @forelse($recentRequests as $item)
                <li class="list-group-item d-flex align-items-start mb-3 bg-transparent">
                    <img src="{{ $item->operator->logo_url }}" class="mr-3 tw-w-10" alt="...">
                    <div class="media-body">
                        <div class="mt-0 mb-1 d-flex justify-content-between align-items-center">
                            <h5>
                                {{ $item->operator->name }}

                            </h5>
                            <div>
                                @if($item->return_back_status==\App\Constants\Status::RETURN_BACK)
                                    <span class="badge badge-warning rounded-pill align-self-start tw-py-1.5 tw-px-2">Returned Back</span>
                                @endif
                                <span
                                    class="badge badge-{{ $item->status_color }} rounded-pill tw-py-1.5 tw-px-2">{{ $item->status }}</span>
                            </div>

                        </div>
                        <p class="text-muted">
                            {{ $item->requestType->name }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                                <strong>UPI:</strong> {{ $item->upi }}, <strong>Meter
                                    Requested:</strong> {{ $item->meter_qty }}

                            </p>
                            <a href="{{ route('client.request-details',encryptId($item->id)) }}"
                               class="btn btn-secondary btn-sm rounded-sm">
                                Details
                            </a>
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item list-group-item-action">
                    <div class="alert alert-info">
                        No recent requests found,you can use "New Connection" button to create a new request.
                    </div>
                </li>
            @endforelse


        </ul>
    </div>

@endsection
