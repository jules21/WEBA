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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <a href="#" class="dropdown-item list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        {{ $item->name }}
                                    </h6>
                                </div>
                                {{--                                <p class="mb-1">Some placeholder content in a paragraph.</p>--}}
                                <small class="text-muted">
                                    {{ $item->address }}
                                </small>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
