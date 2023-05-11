@extends('client.layout.auth')
@section('breadcrumbs')
    <x-layouts.breadcrumb>

        <x-layouts.breadcrumb-item>
            Home
        </x-layouts.breadcrumb-item>

        <x-slot name="actions">
            <button class="btn rounded tw-bg-accent  tw-font-semibold hover:tw-bg-accent hover:tw-text-white "
                    type="button" data-toggle="modal" data-target="#exampleModal">
                <span class="ti ti-plus"></span>
                New Connection
            </button>

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
                            <span
                                class="badge badge-{{ $item->status_color }} rounded-pill tw-py-1.5 tw-px-2">{{ $item->status }}</span>

                        </div>
                        <p class="text-muted">
                            {{ $item->requestType->name }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                                <strong>UPI:</strong> {{ $item->upi }}, <strong>Meter
                                    Requested:</strong> {{ $item->meter_qty }}

                            </p>
                            <a href="" class="btn btn-secondary btn-sm rounded-sm">
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

    <!-- Modal -->
    <div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content tw-rounded-md border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        New Connection
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="ti ti-x"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush">
                        @foreach($operators as $item)
                            <div href="{{ route('client.connection-new',encryptId($item->id)) }}"
                                 class="list-group-item d-flex justify-content-between hover:tw-bg-gray-100">
                                <div>
                                    <h6 class="mb-1">
                                        {{ $item->name }}
                                    </h6>
                                    <small class="text-muted group-hover:tw-text-white">
                                        {{ $item->address }}
                                    </small>
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="tw-inline-flex tw-items-center px-2 tw-py-2 tw-text-sm tw-font-medium tw-text-white tw-bg-primary border tw-border tw-rounded hover:tw-bg-gray-100 hover:tw-text-accent focus:tw-z-10 focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-outline-none focus:tw-ring-accent focus:tw-text-accent tw-no-underline dropdown-toggle"
                                        type="button"
                                        data-toggle="dropdown">
                                        Select District
                                    </button>
                                    <div class="dropdown-menu tw-shadow dropdown-menu-right">
                                        @foreach($item->operationAreas as $operationArea)
                                            <a class="dropdown-item"
                                               href="{{ route('client.connection-new',encryptId($item->id)) }}?op_id={{ encryptId($operationArea->id) }}">
                                                {{ $operationArea->district->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
