@extends('layouts.master')
@section('title',"Request details")

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Details
                </h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            Request Details
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
              <span class="badge badge-{{$request->status_color}} rounded-pill">
                  {{ $request->status }}
              </span>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>



    <div class="card card-body">
        <ul class="nav nav-light-primary nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link font-weight-bolder active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                   aria-controls="home"
                   aria-selected="true">
                    <i class="flaticon2-layers mr-2"></i>
                    Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bolder" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="false">
                    <i class="flaticon2-heart-rate-monitor mr-2"></i>
                    Reviews
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bolder" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                   aria-controls="contact" aria-selected="false">
                    <i class="flaticon2-time mr-2"></i>
                    Flow History
                </a>
            </li>
        </ul>
        <div class="tab-content  mt-5" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-4">
                            Customer Details
                        </h5>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Name</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->customer->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Phone</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->customer->phone }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Email</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->customer->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">ID Type</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->customer->documentType->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Doc Number</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->customer->doc_number }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Address</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->customer->address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-4">
                            Request Details
                        </h5>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Type</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->requestType->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Water Usage</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->waterUsage->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">
                                        Number of Meters Requested
                                    </label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->meter_qty }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">UPI</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->upi }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="font-weight-bold">
                                        Will the new connection cross a road?
                                    </div>
                                    <span class="label label-light-info label-inline rounded-pill">
                                        {{ $request->new_connection_crosses_road? 'Yes' : 'No' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Road Type:</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->road_type }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="font-weight-bold">
                                        Will you buy the equipments by yourself?
                                    </div>
                                    <span class="label label-light-info label-inline rounded-pill">
                                        {{ $request->equipment_payment? 'Yes' : 'No' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="font-weight-bold">
                                        Will you dig the pipeline by yourself?
                                    </div>
                                    <span class="label label-light-info label-inline rounded-pill">
                                        {{ $request->digging_pipeline? 'Yes' : 'No' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">
                                        Address
                                    </label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->address }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Description</label>
                                    <div class="form-control-plaintext py-0">
                                        {{ $request->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">

                    @if($technician)

                        <div class="card card-body ">
                            <h6 class="mb-3">
                                Technician Details
                            </h6>

                            <div class="row">
                                <div class="col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Name:</label>
                                        <div class="form-control-plaintext">
                                            {{ $technician->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <label  class="font-weight-bold">Phone Number:</label>
                                        <div class="form-control-plaintext">
                                            {{ $technician->phone_number }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <label  class="font-weight-bold">Address:</label>
                                        <div class="form-control-plaintext">
                                            {{ $technician->address }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <button
                                    data-id="{{ $technician->id }}"
                                    data-name="{{ $technician->name }}"
                                    data-phone="{{ $technician->phone_number }}"
                                    data-address="{{ $technician->address }}"
                                    class="btn btn-sm btn-light-primary mr-3 rounded-pill px-5 font-weight-bold js-edit-tech">
                                    <i class="flaticon2-edit"></i>
                                    Edit
                                </button>
                                <button type="button"
                                        data-href="{{ route('admin.requests.technician.delete',encryptId($technician->id)) }}"
                                        class="btn btn-sm btn-light-danger rounded-pill px-5 font-weight-bold js-delete">
                                    <i class="flaticon2-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>


                    @else
                        <div class="alert alert-light-info flex-column alert-custom justify-content-center align-items-center">
                            <h1 class="display-6 mb-4">
                                No technicians assigned yet
                            </h1>
                            <button type="button" class="btn rounded btn-info" id="addTechBtn">
                                <i class="flaticon2-add-1"></i>
                                Add New
                            </button>
                        </div>
                    @endif
                </div>


                <div class="card card-body mb-3">

                    @if(!$request->equipment_payment)
                        <div class="p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Materials</h5>
                                <button type="button" class="btn btn-sm rounded btn-primary" id="addBtn">
                                    <i class="flaticon2-add"></i>
                                    Add New
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table border dataTable rounded table-head-solid table-head-custom">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right font-weight-bold">Total:</td>
                                        <td class="font-weight-bolder">
                                            RWF
                                            <span id="total">{{ number_format($requestItems->sum('total')) }}</span>
                                        </td>
                                        <td></td>
                                    </tfoot>
                                    <tbody>

                                    @forelse($requestItems as $item)
                                        <tr>
                                            <td>{{ $item->item->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->unit_price) }}</td>
                                            <td>RWF {{ number_format($item->total) }}</td>
                                            <td>
                                                <button
                                                    data-id="{{ $item->id }}"
                                                    data-quantity="{{ $item->quantity }}"
                                                    data-unit_price="{{ $item->unit_price }}"
                                                    data-item_id="{{ $item->item_id }}"
                                                    class="btn btn-sm btn-light-primary btn-icon rounded-circle js-edit">
                                                    <i class="flaticon2-edit"></i>
                                                </button>
                                                <button type="button"
                                                        data-href="{{ route('admin.requests.delete-request-item',[encryptId($request->id),encryptId($item->id)]) }}"
                                                        class="btn btn-sm btn-light-danger btn-icon rounded-circle js-delete">
                                                    <i class="flaticon2-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <div class="alert alert-light-info alert-custom py-1">
                                                    <div class="alert-icon">
                                                        <i class="flaticon2-exclamation"></i>
                                                    </div>
                                                    <div class="alert-text">
                                                        No items found, please add some items.
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endif
                </div>

                @if((!$request->equipment_payment && $requestItems->count()>0) || $request->equipment_payment)
                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <h4 class="my-4">Review</h4>
                                    <form action="{{ route('admin.requests.reviews.save',encryptId($request->id)) }}"
                                          method="post" id="formSaveReview">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="status" class="col-md-3 col-form-label">Status:</label>
                                            <div class="col-md-9">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach($request->getApprovalStatuses() as $item)
                                                        <option value="{{$item}}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="comment" class="col-md-3 col-form-label">Comment:</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="comment" id="comment" cols="30"
                                                          rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-9 offset-md-3">
                                                <button type="submit" class="btn btn-primary">
                                                <span class="svg-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                      stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                </span>
                                                    Submit Review
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="home-tab">
                @if($reviews->count() == 0)
                    <div class="alert alert-light-info alert-custom ">
                        <div class="alert-icon text-info">
                            <i class="flaticon2-exclamation"></i>
                        </div>
                        <div class="alert-text">
                            No reviews yet for this request
                        </div>
                    </div>

                @else
                    <div class="timeline timeline-justified timeline-4">
                        <div class="timeline-bar"></div>
                        <div class="timeline-items">
                            @foreach($reviews as $item)
                                <div class="timeline-item">
                                    <div class="timeline-badge">
                                        <div class="bg-{{$item->status_color}}"></div>
                                    </div>

                                    <div class="timeline-label">
                                        <span class="text-primary font-weight-bold">
                                            {{ $item->user->name }}
                                        </span>
                                        <span class="ml-2">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <div class="timeline-content">
                                        {{ $item->comment }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <div class="tab-pane fade  " id="contact" role="tabpanel" aria-labelledby="home-tab">
                <div class="card card-body">
                    @if($flowHistories->count()==0)
                        <div class="alert alert-light-info alert-custom ">
                            <div class="alert-icon text-info">
                                <i class="flaticon2-exclamation"></i>
                            </div>
                            <div class="alert-text">
                                No flow history yet for this request
                            </div>
                        </div>
                    @else
                        <div class="timeline timeline-6 mt-3">
                            @foreach($flowHistories as $item)
                                <!--begin::Item-->
                                <div class="timeline-item align-items-start">
                                    <!--begin::Label-->
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">
                                        {{ $item->created_at->format('h:i A') }}
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-{{ $item->status_color }} icon-xl"></i>
                                    </div>
                                    <!--end::Badge-->

                                    <!--begin::Text-->
                                    <div class="font-weight-mormal font-size-lg timeline-content pl-3">
                                    <span class="text-muted font-weight-bolder">
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                        <p>
                                            {{ $item->comment }}
                                        </p>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>


        </div>
    </div>


    {{--    add technician modal--}}

    <div class="modal fade" tabindex="-1" id="addTechnicianModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        Technician
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.requests.technician.save',encryptId($request->id)) }}" method="post"
                      id="saveTechnicianForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="0" id="tech_id" name="id"/>
                        <div class="form-group">
                            <label for="tech_name">Name</label>
                            <input type="text" name="name" id="tech_name" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="tech_phone_number">Phone Number</label>
                            <input type="tel" name="phone_number" id="tech_phone_number" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="tech_address">Address</label>
                            <input type="tel" name="address" id="tech_address" class="form-control"/>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    add modal--}}

    <div class="modal fade" tabindex="-1" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Material</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.requests.save-item',encryptId($request->id)) }}" method="post"
                      id="saveItemForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}
                                        - RWF {{ number_format($item->selling_price,0) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control"/>
                        </div>


                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateReviewRequest::class,'#formSaveReview') !!}
    {!! JsValidator::formRequest(App\Http\Requests\ValidateStoreItemRequest::class,'#saveItemForm') !!}
    {!! JsValidator::formRequest(App\Http\Requests\ValidateTechnicianRequest::class,'#saveTechnicianForm') !!}

    <script>
        $(document).ready(function () {

            $('.dataTable').DataTable();

            $('#addBtn').on('click', function () {
                $('#addModal').modal('show');
            });

            $('#formSaveReview').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid())
                    return false;

                let btn = $form.find('button[type="submit"]');

                btn.addClass('spinner spinner-white spinner-right')
                    .prop('disabled', true);

                // submit form here
                e.target.submit();

            });

            $('#saveItemForm').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid())
                    return false;

                let btn = $form.find('button[type="submit"]');

                btn.addClass('spinner spinner-white spinner-right')
                    .prop('disabled', true);

                $.ajax({
                    url: $form.attr('action'),
                    method: 'post',
                    data: $form.serialize(),
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                    complete: function () {
                        /*      btn.removeClass('spinner spinner-white spinner-right')
                                  .prop('disabled', false);*/
                    }
                })

            });

            $(document).on('click', '.js-edit', function () {
                let $itemId = $('#item_id');
                $itemId.val($(this).data('item_id'));
                $('#quantity').val($(this).data('quantity'));
                $('#unit_price').val($(this).data('unit_price'));
                $itemId.trigger('change');
                $('#addModal').modal('show');
            });

            $(document).on('click', '.js-delete', function (e) {
                e.preventDefault();

                let $this = $(this);
                let url = $this.data('href');


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.value) {
                        $this.prop('disabled', true)
                            .addClass('spinner spinner-white spinner-right');
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            complete: function () {
                                $this.prop('disabled', false)
                                    .removeClass('spinner spinner-white spinner-right');
                            },
                            success: function (response) {
                                location.reload();
                            },
                            error: function (xhr) {
                                Swal.fire(
                                    'Error!',
                                    "Unable to delete item, please try again later",
                                    'error'
                                );
                            }
                        });
                    }
                });

            });

            $('#addTechBtn').on('click', function () {
                $('#addTechnicianModal').modal('show');
            });

            $('#saveTechnicianForm').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid())
                    return false;

                let btn = $form.find('button[type="submit"]');

                btn.addClass('spinner spinner-white spinner-right')
                    .prop('disabled', true);

                $.ajax({
                    url: $form.attr('action'),
                    method: 'post',
                    data: $form.serialize(),
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                    complete: function () {

                    }
                })
            });

            $(document).on('click', '.js-edit-tech', function () {
                $('#tech_id').val($(this).data(('id')));
                $('#tech_name').val($(this).data(('name')));
                $('#tech_phone_number').val($(this).data(('phone')));
                $('#tech_address').val($(this).data(('address')));
                $('#addTechnicianModal').modal('show');
            });

        });
    </script>
@endsection
