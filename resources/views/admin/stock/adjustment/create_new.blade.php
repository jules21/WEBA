@extends('layouts.master')
@section('title',"New Stock Adjustment")
@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Create Adjustment
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
                        <a href="{{ route('admin.stock.adjustments.create') }}" class="text-muted">
                            Stock Adjustments
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            Stock Adjustment Details
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
              <span class="badge badge-{{$adjustment->status_color ?? ''}} rounded-pill">
                  {{ $adjustment->status ?? "new" }}
              </span>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-body">
        <ul class="nav nav-light-primary nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link font-weight-bolder active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                   aria-controls="home"
                   aria-selected="true">
                    <i class="flaticon2-layers mr-2"></i>
                    New Adjustment Form
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

                <div class="card card-body mb-3">
                    <form id="saveNewForm" action="{{route('admin.stock.adjustments.store')}}">
                        @csrf
                        <input type="hidden" name="adjustment_id" id="adjustment_id" value="{{$adjustment->id ?? null}}">
                        <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        <input type="hidden" name="operation_area_id" value="{{auth()->user()->operation_area}}">
                        <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                        <input type="hidden" name="status" value="Pending">
                        <div class="row">
                            <div class="col-12">
                                <label class="d-block">Reason:</label>
                                <textarea name="description" id="reason" class="form-control" rows="3" required>{{ $adjustment->description ?? '' }}</textarea>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-sm btn-light-primary font-weight-bold" id="saveNew">
                                    Save & continue
                                </button>
                                <button type="button" class="btn btn-sm btn-light-primary font-weight-bold" id="editText" style="display: none">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card card-body mb-3 d-none" id="items_container">
                    <div class="p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Items</h5>
                                <button type="button" class="btn btn-sm rounded btn-primary" id="addBtn">
                                    <i class="flaticon2-add"></i>
                                    Add Item
                                </button>
                            </div>

                        <div class="table-responsive">
                            <table class="table border dataTable rounded table-head-solid table-head-custom" id="">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th>Narration</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right font-weight-bold">Total:</td>
                                    <td class="font-weight-bolder">
                                        RWF
                                        <span id="total">{{ $adjustment ? number_format($adjustment->items->sum('total')):0 }}</span>
                                    </td>
                                    <td></td>
                                </tfoot>
                                <tbody>

                                @forelse(($adjustment ? $adjustment->items : []) as $item)
                                    <tr>
                                        <td>{{ $item->item->name }}</td>
                                        <td>
                                            @if($item->adjustment_type == 'decrease')
                                                <span class="text-danger">-{{ $item->quantity }}</span>
                                            @else
                                                <span class="text-success">+{{ $item->quantity }}</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->unit_price) }}</td>
                                        <td>RWF {{ number_format($item->total) }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if($adjustment->status == \App\Models\Adjustment::PENDING)
                                                <button
                                                    data-id="{{ $item->id }}"
                                                    data-quantity="{{ $item->quantity }}"
                                                    data-unit_price="{{ $item->unit_price }}"
                                                    data-item_id="{{ $item->item_id }}"
                                                    data-adjustment_type="{{ $item->adjustment_type }}"
                                                    data-description="{{ $item->description }}"
                                                    data-adjustment_id="{{ $adjustment->id }}"
                                                    class="btn btn-sm btn-light-primary btn-icon rounded-circle js-edit">
                                                    <i class="flaticon2-edit"></i>
                                                </button>
                                                <button type="button"
                                                        data-href="{{ route('admin.stock.stock-adjustments.items.remove',[encryptId($adjustment->id),encryptId($item->id)]) }}"
                                                        class="btn btn-sm btn-light-danger btn-icon rounded-circle js-delete">
                                                    <i class="flaticon2-trash"></i>
                                                </button>
                                            @endif
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
                </div>

                @if($adjustment)
                    <form method="post" action="{{ route("admin.stock.stock-adjustments.submit",encryptId($adjustment->id)) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-body mb-3 d-none" id="attachment-container">
                                    <div class="col-12">
                                        <label class="d-block">Attachment <small>(optional)</small></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="attachment">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                        </div>
                        <div class="row justify-content-end mr-1 d-none" id="submit-container">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="la la-check-circle"></i>
                                Submit</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="home-tab">
                @if($reviews->count() == 0)
                    <div class="alert alert-light-info alert-custom ">
                        <div class="alert-icon text-info">
                            <i class="flaticon2-exclamation"></i>
                        </div>
                        <div class="alert-text">
                            No reviews yet for this Stock Adjustment
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
                                No flow history yet for this Stock Adjustment
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
    <div class="modal fade" tabindex="-1" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Item</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.stock.stock-adjustments.items.add') }}" method="post"
                      id="saveItemForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="item_adjustment_id" name="adjustment_id" value="{{$adjustment->id ?? null}}">
                        <input type="hidden" id="_item_id" name="id" value="">
                        <div class="form-group">
                            <label for="type">Adjustment Type</label>
                            <select name="adjustment_type" id="adjustment-type" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select Type</option>
                                <option value="increase">In</option>
                                <option value="decrease">Out</option>
                            </select>
                        </div>
                        <input type="hidden" name="available_quantity" id="available-quantity">
                        <div class="form-group">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select Item</option>
                                @foreach($stock ?? [] as $record)
                                    <option data-quantity="{{$record->quantity}}" value="{{$record->id}}">
                                        {{optional($record)->name}} - Qty({{optional($record)->quantity}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" />
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" value="{{$adjustment->description ?? ''}}"></textarea>
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
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAdjustmentItemRequest::class,'#saveItemForm') !!}

    <script>
        $(document).ready(function () {
            initData();
            $('#saveNewForm').submit(function (e) {
                e.preventDefault();
                const form = $('#saveNewForm');
                const btn = $('#saveNew');
                if (form.valid()) {
                    btn.addClass('spinner spinner-white spinner-right')
                        .prop('disabled', true);
                    //make ajax call
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        complete: function () {
                            btn.removeClass('spinner spinner-white spinner-right')
                                .prop('disabled', false);
                        },
                        success: function (response) {
                            $('#adjustment_id').val(response.id);
                            $('#item_adjustment_id').val(response.id);
                            $('#_description').val(response.reason);
                            $('#items_container').removeClass('d-none');
                            $('#reason').prop('disabled', true);
                            $('#editText').css('display', 'inline-block');
                            $('#saveNew').css('display', 'none');

                            $("#attachment-container").removeClass('d-none');
                            $("#submit-container").removeClass('d-none');

                            console.log(response);
                            window.history.replaceState(null, null, "?adjustment_id=" + response.id_encrypted);

                        },
                        error: function (xhr) {
                            console.log(xhr);
                            // Swal.fire(
                            //     'Error!',
                            //     "Unable to save item, please try again later",
                            //     'error'
                            // );
                        }
                    });
                }
            })
            $('#saveNewForm1').submit(function (e) {
                e.preventDefault();
                const form = $('#saveNewForm1');
                const btn = $('#uploadAttachment');
                if (form.valid()) {
                    btn.addClass('spinner spinner-white spinner-right')
                        .prop('disabled', true);
                    //make ajax call
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        complete: function () {
                            btn.removeClass('spinner spinner-white spinner-right')
                                .prop('disabled', false);
                        },
                        success: function (response) {
                            $('#adjustment_id').val(response.id);
                            $('#item_adjustment_id').val(response.id);
                            $('#items_container').removeClass('d-none');
                            $('#reason').prop('disabled', true);
                            $('#editText').css('display', 'inline-block');
                            $('#saveNew').css('display', 'none');
                            btn.css('display', 'none');
                            $('#uploadAttachment').css('display', 'none');
                            $('#editAttachment').css('display', 'inline-block');

                            $("#attachment-container").removeClass('d-none');
                            $("#submit-container").removeClass('d-none');

                            console.log(response);
                            // location.reload();
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            // Swal.fire(
                            //     'Error!',
                            //     "Unable to save item, please try again later",
                            //     'error'
                            // );
                        }
                    });
                }
            })
            $('#addBtn').on('click', function () {
                $('#addModal').modal('show');
            });
            $(document).on('click', '.js-edit', function () {
                $('#addModal').modal('show');
                $('#adjustment-type').val($(this).data('adjustment_type')).trigger('change');
                let $itemId = $('#item_id');
                $itemId.val($(this).data('item_id'));
                $itemId.select2();
                // $itemId.select2().trigger('change');
                $('#quantity').val($(this).data('quantity'));
                $('#unit_price').val($(this).data('unit_price'));
                $('#description').val($(this).data('description'));
                $('#_item_id').val($(this).data('id'));
                $('#item_adjustment_id').val($(this).data('adjustment_id'));
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
                                console.log(xhr);
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
        });

        $('#adjustment-type').change(function (){
            $('#item_id').val('');
            $('#item_id').select2();
            $('#quantity').val('');
            if ($(this).val() === 'increase') {
                $('#unit_price').val('').attr('readonly', false);
            } else {
                $('#unit_price').val('').attr('readonly', true);
            }
        })

        $('#item_id').change(function (){
            //quantity
            $('#quantity').val('');
            const adjustmenTtype = $('#adjustment-type').val();
            if (adjustmenTtype === 'increase') {
                const quantity = $(this).find(':selected').data('quantity');
                $('#available-quantity').val(9999999999999)
            } else {
                const quantity = $(this).find(':selected').data('quantity');
                $('#available-quantity').val(quantity);
            }
            //unit price
            // getUnitPrice($(this).val()).done(function (response){
            //     $('#unit_price').val(response);
            // })
            if($(this).val() != ''){
                if (adjustmenTtype === 'increase') {
                    $('#unit_price').val('');
                } else {
                    getUnitPrice($(this).val());
                }
            }else{
                $('#unit_price').val('');
            }
        })

        $('#editText').on('click', function (){
            $('#reason').prop('disabled', false);
            $('#editText').css('display', 'none');
            $('#saveNew').css('display', 'inline-block');
        })
        const initData = function (){
            const adjustment_id = $('#adjustment_id').val();
            if (adjustment_id) {
                $('#items_container').removeClass('d-none');
                $('#reason').prop('disabled', true);
                $('#editText').css('display', 'inline-block');
                $('#saveNew').css('display', 'none');

                $("#attachment-container").removeClass('d-none');
                $("#submit-container").removeClass('d-none');
            }
        }
        const getUnitPrice = function (item_id) {
            const url = "{{ route('items.get-unit-price', ':id') }}";
            return $.ajax({
                url: url.replace(':id', item_id),
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#unit_price').val(response);
                    if(response == 0){
                        $('#unit_price').attr('readonly', false);
                    }else{
                        $('#unit_price').attr('readonly', true);
                    }

                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        }
    </script>
@endsection
