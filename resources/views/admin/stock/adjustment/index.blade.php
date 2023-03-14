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
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">Adjustments</h3>
                <div class="card-toolbar">
                    <a href="javascript:void(0)" class="btn btn-primary"
                       data-toggle="modal"
                       data-target="#addModal" >
                        <i class="la la-plus"></i>
                        New Adjustment
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border table-head-solid table-head-custom" id="kt_datatable1">
                        <thead>
                        <tr>
                            <th>Operation area</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adjustments as $adjustment)
                            <tr>
                                <td>{{$adjustment->operationArea->name ?? ''}}</td>
                                <td>{{$adjustment->description}}</td>
                                <td>
                                    @if($adjustment->status == 'Pending')
                                        <span class="label label-lg font-weight-bold label-light-warning label-inline">Pending</span>
                                    @elseif($adjustment->status == 'Submitted')
                                        <span class="label label-lg font-weight-bold label-light-info label-inline">Submitted</span>
                                    @elseif($adjustment->status == 'Approved')
                                        <span class="label label-lg font-weight-bold label-light-success label-inline">Approved</span>
                                    @elseif($adjustment->status == 'Rejected')
                                        <span class="label label-lg font-weight-bold label-light-danger label-inline">Rejected</span>
                                    @endif
                                </td>

                                <td>{{$adjustment->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light-primary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                        <div class="dropdown-menu" style="">
                                            <a href="{{route('admin.stock.adjustments.show', encryptId($adjustment->id))}}"
                                               class="dropdown-item">
                                                Details
                                            </a>
{{--                                            <a href="{{route('admin.stock.stock-adjustments.items', encryptId($adjustment->id))}}"--}}
{{--                                               class="dropdown-item">--}}
{{--                                                Items--}}
{{--                                            </a>--}}
                                            @if($adjustment->status == 'Pending')
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class=" edit-btn dropdown-item "
                                                   data-toggle="modal"
                                                   data-target="#user_adjustment_edit_modal"
                                                   data-description="{{$adjustment->description}}"
                                                   data-id="{{encryptId($adjustment->id)}}"
                                                   data-url="{{ route('admin.stock.adjustments.update', encryptId($adjustment->id)) }}">
                                                    Edit
                                                </a>
                                                <a class="delete_btn dropdown-item"
                                                   data-url="{{route('admin.stock.adjustments.destroy', encryptId($adjustment->id)) }}">
                                                    Delete
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--user adjustment modal--}}
        <div class="modal fade" id="addModal" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="kt-form" id="add-adjustment-form" action="{{route('admin.stock.adjustments.store')}} "
                          method="POST">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Reason</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                            <input type="hidden" name="operation_area_id" value="{{auth()->user()->operation_area}}">
                            <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                            <input type="hidden" name="status" value="Pending">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Save Adjustment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--user update modal--}}
        <div class="modal fade" id="user_adjustment_edit_modal" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit adjustment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="edit-adjustment-form"
                          method="POST">
                        @method('PUT')
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Reason</label>
                                <textarea name="description" id="_description" class="form-control" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                            <input type="hidden" name="operation_area_id" value="{{auth()->user()->operation_area}}">
                            <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                            <input type="hidden" name="status" value="Pending">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Edit Adjustment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--    delete form--}}
        <form id="delete-form" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\StoreAdjustmentRequest::class,'#add-adjustment-form') !!}
    {!! JsValidator::formRequest(App\Http\Requests\UpdateAdjustmentRequest::class,'#edit-adjustment-form') !!}
    <script>
        $("#kt_datatable1").DataTable({
            responsive:true,
            "order": [[ 3, "desc" ]]
        });
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            $('#_description').val($(this).data('description'));

            $('#edit-adjustment-form').attr('action', $(this).data('url'));
        });

        $('.delete_btn').click(function (e){
            e.preventDefault();
            var url = $(this).data('url');
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.value) {
                    $('#delete-form').attr('action', url);
                    $('#delete-form').submit();
                }
            });
        });
    </script>


@endsection
