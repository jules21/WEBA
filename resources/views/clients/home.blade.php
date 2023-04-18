@extends('layouts.main')
@section('breadcrumbs')
    <x-layouts.breadcrumb>

        <x-layouts.breadcrumb-item>
            Home
        </x-layouts.breadcrumb-item>

        <x-slot name="actions">
            <button type="button" href="{{ route('clients.connection-new') }}"
                    class="btn rounded tw-bg-accent/30  tw-font-semibold hover:tw-bg-accent hover:tw-text-white">
                <span class="ti ti-plus"></span>
                New Connection
            </button>
        </x-slot>

    </x-layouts.breadcrumb>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6 my-2 my-lg-0">
            <div class="card card-body h-100 tw-rounded-lg">
                <h4>
                    My Operators
                </h4>


                <ul class="list-unstyled mt-4">
                    @foreach($operators as $item)
                        <li class="media mb-3">
                            <img src="{{ $item->logo_url }}" class="mr-3 tw-w-10" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">
                                    {{ $item->name }}
                                </h5>
                                <p class="mb-1">
                                    {{ $item->address }}
                                </p>
                                <div class="d-flex tw-gap-1">
                                    <a href=""
                                       class="btn tw-bg-primary/10 tw-text-primary font-weight-bolder hover:tw-bg-primary hover:tw-text-white">
                                        <span class="ti ti-plus d-none d-lg-inline"></span>
                                        New Connection
                                    </a>
                                    <a href=""
                                       class="btn tw-bg-primary/20 tw-text-primary hover:tw-bg-primary hover:tw-text-white">
                                        <span class="ti ti-receipt d-none d-lg-inline"></span>
                                        Billing
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach


                </ul>
            </div>
        </div>
        <div class="col-md-6 my-2 my-lg-0">
            <div class="card card-body h-100 tw-rounded-lg">
                <h4>
                    Recent Requests
                </h4>

                <ul class="list-group list-group-flush mt-4">
                    @foreach($recentRequests as $item)
                        <li class="list-group-item d-flex align-items-start mb-3">
                            <img src="{{ $item->operator->logo_url }}" class="mr-3 tw-w-10" alt="...">
                            <div class="media-body">
                                <div class="mt-0 mb-1 d-flex justify-content-between align-items-center">
                                    <h5>
                                        {{ $item->requestType->name }}
                                    </h5>
                                    <span class="badge badge-{{ $item->status_color }} rounded-pill">
                                     {{ $item->status }}
                                 </span>

                                </div>
                                <p class="text-muted">
                                    {{ $item->operator->name }}
                                </p>
                                <p class="mb-1">
                                    <strong>UPI:</strong> {{ $item->upi }}, <strong>Meter
                                        Requested:</strong> {{ $item->meter_qty }}
                                </p>
                            </div>
                        </li>
                    @endforeach


                </ul>
            </div>
        </div>

    </div>

@endsection
