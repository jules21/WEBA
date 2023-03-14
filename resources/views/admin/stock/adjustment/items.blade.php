@extends('layouts.master')
@section('title','Item Adjustments')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Stock </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Item Adjustments</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="container">
        <div class="card card-body mb-3">
            <div class="p-3 mb-3">


                @if($adjustment->status == 'Pending')
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Items</h5>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm rounded btn-primary mr-3" id="addBtn">
                                <i class="flaticon2-add"></i>
                                Add New
                            </button>
                            <button type="button" class="btn btn-sm rounded btn-success" id="submitBtn"
                                data-url="{{ route('admin.stock.stock-adjustments.submit',$adjustment->id) }}"
                            >
                                <i class="flaticon2-paper-plane"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('admin.stock.adjustments.index') }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                        <i class="flaticon2-left-arrow-1"></i>
                        Back
                    </a>
                @endif
                <div class="table-responsive">
                    <table class="table border dataTable rounded table-head-solid table-head-custom" id="datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($items as $item)
                            <tr>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                @if($adjustment->status == 'pending')
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
                                                data-href="{{ route('admin.stock.stock-adjustments.items.remove',[$adjustment->id,$item->id]) }}"
                                                class="btn btn-sm btn-light-danger btn-icon rounded-circle js-delete">
                                            <i class="flaticon2-trash"></i>
                                        </button>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>

                        @empty
                            {{--     <tr>
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
                                 </tr>--}}
                        @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Material</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.stock.stock-adjustments.items.add',$adjustment->id) }}" method="post"
                      id="saveItemForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select Item</option>
                                @foreach($stock as $record)
                                    <option value="{{$record->item_id}}">{{optional($record->item)->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" max="{{$record->quantity}}"/>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="unit_price">Unit Price</label>--}}
{{--                            <input type="number" name="unit_price" id="unit_price" class="form-control"/>--}}
{{--                        </div>--}}


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
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAdjustmentItemRequest::class,'#saveItemForm') !!}
    <script>
        $(document).ready(function (){
            $('#datatable').DataTable();
        })
        $('#addBtn').on('click', function () {
            $('#addModal').modal('show');
        });
        $('#submitBtn').on('click', function (e){
            e.preventDefault();
            const url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('#submitBtn').prop('disabled', true)
                    $('#submitBtn').html('<i class="fa fa-spinner fa-spin"></i> Submitting...');
                    //redirect to the url
                    window.location.replace(url);
                }
            });
        })
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
    </script>
@endsection
