@extends('layouts.master')
@section('title',"Request details")

@section('content')
    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none mb-4" id="kt_subheader">
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
                @if($request->return_back_status==\App\Constants\Status::RE_SUBMITTED)
                    <span class="badge badge-warning rounded-pill align-self-start">Re-Submitted</span>
                @elseif($request->return_back_status==\App\Constants\Status::RETURN_BACK)
                    <span class="badge badge-warning rounded-pill align-self-start">
                    Returned Back
                </span>
                @endif
                <span class="badge badge-{{$request->status_color}} rounded-pill ml-2">
                  {{ $request->status }}
              </span>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>

    <div class="card card-body tw-shadow-sm border tw-border-gray-300">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
            <ul class="nav nav-light-primary nav-pills" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-weight-bolder active" id="home-tab" data-toggle="tab" href="#home"
                       role="tab"
                       aria-controls="home"
                       aria-selected="true">
                      <span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layers-intersect"
                               width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                               fill="none"
                               stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path
                               d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                           <path
                               d="M4 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                        </svg>
                      </span>
                        Details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bolder" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message" width="24"
                           height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M8 9h8"></path>
                           <path d="M8 13h6"></path>
                           <path
                               d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path>
                        </svg>
                    </span>
                        Reviews
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bolder" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                       aria-controls="contact" aria-selected="false">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M12 8l0 4l2 2"></path>
                           <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"></path>
                        </svg>
                    </span>
                        Flow History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bolder" id="payments-tab" data-toggle="tab" href="#payments">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path
                               d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2"></path>
                        </svg>
                    </span>
                        Payments
                    </a>
                </li>
            </ul>

            @if($request->status==\App\Constants\Status::PENDING && auth()->user()->can(\App\Constants\Permission::CreateRequest))
                <a href="{{ route('admin.requests.edit', encryptId($request->id)) }}"
                   class="btn btn-sm bg-accent font-weight-bolder align-self-start text-primary">
                    <i class="flaticon2-edit text-primary"></i>
                    Edit Request
                </a>
            @endif
        </div>
        <div class="tab-content  mt-5" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                @include('admin.requests.partials._customer_details')

                @include('admin.requests.partials._request_details')

                @if($request->canBeReviewed())
                    {{--     <div class="mb-3">
                             @include('admin.requests.partials._technician_details')
                         </div>--}}

                    @if(!$request->equipment_payment)
                        @include('admin.requests.partials._equipments')
                    @endif
                    @if($request->pendingPayments(\App\Models\PaymentType::METERS_FEE))
                        <div class="alert alert-outline-warning alert-notice alert-custom">
                            <div class="alert-icon text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-shield-exclamation" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M15.04 19.745c-.942 .551 -1.964 .976 -3.04 1.255a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 .195 6.015"></path>
                                    <path d="M19 16v3"></path>
                                    <path d="M19 22v.01"></path>
                                </svg>
                            </div>
                            <div class="alert-text">
                                Please make sure all pending payments are paid before assigning meter numbers to this
                                request.
                            </div>
                        </div>
                    @endif
                    @if($request->canMeterNumberBeShown())
                        @include('admin.requests.partials._assign_meter_numbers')
                    @endif

                    @if( $request->canBeApprovedByMe() && auth()->user()->operation_area)
                        @if((!$request->equipment_payment && $requestItems->count()>0) || $request->equipment_payment)
                            @include('admin.requests.partials._review_form')
                        @endif
                    @endif
                @endif


            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="home-tab">
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
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="home-tab">
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
                                    <div class="font-weight-normal font-size-lg timeline-content pl-3">
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
            <div class="tab-pane fade" id="payments">
                <div class="accordion accordion-solid  accordion-panel accordion-svg-toggle mb-3"
                     id="accordionExample3">
                    @forelse($request->paymentDeclarations as $payment)
                        <div class="card border">
                            <div class="card-header" id="headingOne{{$payment->id}}">
                                <div class="card-title  bg-light rounded-bottom-0" data-toggle="collapse"
                                     data-target="#collapseOne{{$payment->id}}">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column  py-2 w-75">
                                            <!--begin::Title-->
                                            <a href="#"
                                               class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                                {{ $payment->paymentConfig->paymentType->name }}

                                                <span class="ml-3">
                                                    {{ number_format($payment->amount) }} RWF
                                                </span>
                                            </a>
                                            <!--end::Title-->
                                            <!--begin::Data-->
                                            <div>


                                                <span>
                                                    Payment Reference:
                                                    <span
                                                        class="font-weight-bold">
                                                        {{ $payment->payment_reference }}
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Data-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Label-->
                                        <span
                                            class="label label-lg font-weight-bold label-light-{{ $payment->status_color }} label-inline rounded-pill mr-4">
                                            {{ ucfirst($payment->status=='active'?'Not paid':$payment->status) }}
                                        </span>
                                        <!--end::Label-->
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne{{$payment->id}}" class="collapse" data-parent="#accordionExample3">
                                <div class="card-body">
                                    @if($payment->paymentHistories->count() >0)
                                        <div class="timeline timeline-6 mt-4">

                                            @foreach($payment->paymentHistories as $item)
                                                <div class="timeline-item align-items-start hover-opacity-70">
                                                    <!--begin::Label-->
                                                    <div
                                                        class="timeline-label  text-dark-75 font-size-sm">
                                                        {{ $item->created_at->format('h:i A') }}
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge mt-1">
                                                        <i class="fa fa-chevron-up text-success"></i>
                                                    </div>
                                                    <!--end::Badge-->

                                                    <!--begin::Text-->
                                                    <div class="mx-3 d-flex flex-column w-100">
                                                        <div class="mb-1 d-flex justify-content-between">
                                                            <div>
                                                                <span>Amount Paid</span>
                                                                <span
                                                                    class="label label-inline label-light-success rounded-pill font-weight-bolder">{{ number_format($item->amount) }} RWF</span>

                                                            </div>
                                                            <span
                                                                class="label label-inline label-secondary rounded-pill font-weight-bolder">{{ $item->created_at->format('d M Y') }}</span>
                                                        </div>
                                                        <div class="mt-1 font-weight-bolder">
                                                          <span>
                                                                Payment Provider:
                                                          </span>
                                                            <span
                                                                class="label label-inline label-light-primary rounded-pill font-weight-bolder">
                                                                   {{ $item->mapping->account->paymentServiceProvider->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-light-info p-3 mt-4 mb-0 alert-custom">
                                            <div class="alert-text">
                                                No payment made yet.
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light-info p-3 alert-custom">
                            <div class="alert-text">
                                No payment declaration yet.
                            </div>
                        </div>
                    @endforelse
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
                    <input type="hidden" name="request_id" value="{{ $request->id }}"/>
                    <input type="hidden" name="id" value="0" id="materialId"/>
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
                        {{--      <div class="form-group">
                                  <label for="unit_price">Unit Price</label>
                                  <input type="number" name="unit_price" id="unit_price" disabled class="form-control"/>
                              </div>--}}


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
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAssignMeterNumber::class,'#saveMeterForm') !!}
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAddWaterNetwork::class,'#saveWaterNetworkForm') !!}

    <script>

        let getItems = function (categoryId, selectedItemId) {
            let url = "{{ route('admin.stock.items.by-category',':id') }}";
            url = url.replace(':id', categoryId);
            let $itemSelect = $('#item_meter_id');
            $itemSelect.empty();
            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                success: function (response) {
                    $itemSelect.append('<option value="">Select Item</option>');
                    $.each(response, function (index, item) {
                        let selected = '';
                        if (Number(selectedItemId) === Number(item.id))
                            selected = 'selected';
                        $itemSelect.append('<option value="' + item.id + '" ' + selected + '>' + item.name + ' - RWF ' + item.selling_price + '</option>');
                    });
                    $itemSelect.trigger('change');
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: "Unable to get items, please try again later",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        let isSubmitting = false;
        $(document).ready(function () {

            let $saveMeterForm = $('#saveMeterForm');
            $saveMeterForm.validate();

            let $saveWaterNetworkForm = $('#saveWaterNetworkForm');
            $saveWaterNetworkForm.validate();

            $('.dataTable').DataTable();

            let $categoryId = $('#category_id');
            $categoryId.on('change', function () {
                let categoryId = $(this).val();
                if (categoryId)
                    getItems(categoryId, 0);
            });

            $saveWaterNetworkForm.on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid() || isSubmitting)
                    return false;

                isSubmitting = true;
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
                    error: function (error) {
                        isSubmitting = false;
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to save water network, please try again later",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        btn.removeClass('spinner spinner-white spinner-right')
                            .prop('disabled', false);
                    },
                });
            });
            let $itemId = $('#item_id');
            $('#addBtn').on('click', function () {
                $('#addModal').modal('show');
                $('#saveItemForm')[0].reset();
                $('#materialId').val(0);
                $itemId.val('');
                $itemId.trigger('change');
            });


            $('#formSaveReview').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid() || isSubmitting)
                    return false;

                isSubmitting = true;
                let btn = $form.find('button[type="submit"]');

                btn.addClass('spinner spinner-white spinner-right')
                    .prop('disabled', true);

                // submit form here
                e.target.submit();

            });

            $('#saveItemForm').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid() || isSubmitting)
                    return false;
                isSubmitting = true;
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
                        isSubmitting = false;
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let message = '';
                            $.each(errors, function (index, error) {
                                message += error[0] + ' ';
                            });
                            Swal.fire({
                                title: 'Error!',
                                text: message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                        btn.removeClass('spinner spinner-white spinner-right')
                            .prop('disabled', false);
                    },
                    complete: function () {
                        /*      btn.removeClass('spinner spinner-white spinner-right')
                                  .prop('disabled', false);*/
                    }
                })

            });

            $(document).on('click', '.js-edit', function () {

                $itemId.val($(this).data('item_id'));
                $('#materialId').val($(this).data('id'))
                $('#quantity').val($(this).data('quantity'));
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


            $('#addMeterBtn').on('click', function () {
                $('#addMeterModal').modal('show');
                $('#meter_id').val(0);
            });

            $saveMeterForm.on('submit', function (e) {
                e.preventDefault();
                let $form = $(this);
                if (!$form.valid() || isSubmitting)
                    return false;

                let btn = $form.find('button[type="submit"]');

                btn.prop('disabled', true);
                btn.addClass('spinner spinner-white spinner-right');

                isSubmitting = true;
                $.ajax({
                    url: $form.attr('action'),
                    method: 'post',
                    data: $form.serialize(),
                    success: function (response) {
                        location.reload();
                        isSubmitting = false;
                    },
                    error: function (xhr, status, error) {
                        isSubmitting = false;
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        btn.removeClass('spinner spinner-white spinner-right');
                        btn.prop('disabled', false);
                    },
                    complete: function () {

                    }
                });

            });

            let $itemMeterId = $('#item_meter_id');
            $('.js-edit-meter').on('click', function (e) {
                e.preventDefault();
                let catId = $(this).data('item_category_id');
                $categoryId.val(catId);
                getItems(catId, $(this).data('item_id'));
                $itemMeterId.val($(this).data('item_id'));
                $('#meter_number').val($(this).data('meter_number'));
                $('#last_index').val($(this).data('last_index'));
                $('#addMeterModal').modal('show');
                $('#meter_id').val($(this).data('id'));
                $categoryId.trigger('change');
            });

            $('#addMeterModal').on('hidden.bs.modal', function () {
                $saveMeterForm.trigger('reset');
                $saveMeterForm.validate().resetForm();
                $saveMeterForm.find('button[type="submit"]').removeClass('spinner spinner-white spinner-right')
                    .prop('disabled', false);

                $categoryId.val('');
                $categoryId.trigger('change');
                $itemMeterId.val('');
                $itemMeterId.trigger('change');
            });

        });
    </script>
@endsection
