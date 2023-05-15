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
                <form action="{{ route('client.connection-new') }}">
                    <div class="modal-body">
                        <div class="tw-my-6">

                            <div class="d-flex justify-content-between">
                                <label for="district">District</label>
                                <div class="d-none align-items-center" id="loader">
                                    <strong>Loading...</strong>
                                    <div class="spinner-border spinner-border-sm ml-auto" role="status"
                                         aria-hidden="true"></div>
                                </div>
                            </div>
                            <select required
                                    class="form-control tw-shadow focus:tw-ring tw-ring-primary focus:tw-ring-offset-2"
                                    id="district" name="district">
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="tw-my-6">
                            <label for="operator_id">Operator</label>
                            <select required
                                    class="form-control tw-shadow focus:tw-ring tw-ring-primary focus:tw-ring-offset-2"
                                    id="operator_id" name="op_id">
                                <option value="">Select Operator</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary" id="btn-create-request">
                            Continue <i class="ti ti-arrow-right"></i>
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(function () {
            $('#district').on('change', function () {
                let districtId = $(this).val();
                $('#loader').removeClass('d-none')
                    .addClass('d-flex');
                $.ajax({
                    url: '{{ route('get-operators-by-district') }}',
                    type: 'GET',
                    data: {
                        district_id: districtId
                    },
                    success: function (response) {
                        let options = '<option value="">Select Operator</option>';
                        $.each(response, function (index, value) {
                            options += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $('#operator_id').html(options);
                    },
                    complete: function () {
                        $('#loader').removeClass('d-flex')
                            .addClass('d-none');
                    }
                });
            });
        });
    </script>
@endsection
