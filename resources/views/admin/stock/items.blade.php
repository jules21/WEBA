@extends('layouts.master')
@section('title','Items')
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
                            <a class="text-muted">Items</a>
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
        @include('partials._alerts')
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">Items</h3>
                <div class="card-toolbar">
                    <a href="javascript:void(0)" class="btn btn-primary"
                       data-toggle="modal"
                       data-target="#addModal" >
                        <i class="la la-plus"></i>
                        New Item
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-separate border table-head-solid table-head-custom" id="kt_datatable1">
                        {{--                    kt_datatable1--}}
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Is Meter</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                   <span class=" label label-inline label-light-{{$item->is_meter ? 'primary':'danger'}} font-weight-bold ">
                                       {{$item->is_meter ? 'Yes':'No'}}
                                   </span>
                                </td>
                                <td>
                                   <span class="label label-inline label-light-{{$item->is_active ? 'primary':'danger'}}">
                                       {{$item->is_active ? 'Active':'Inactive'}}
                                   </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light-primary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                        <div class="dropdown-menu" style="">
                                            <a href="#" class=" edit-btn dropdown-item "
                                               data-toggle="modal"
                                               data-target="#user_category_edit_modal"
                                               data-name="{{$item->name}}"
                                               data-is_meter="{{$item->is_meter}}"
                                               data-is_active="{{$item->is_active}}"
                                               data-id="{{$item->id}}"
                                               data-url="{{ route('admin.stock.item-categories.update', $item->id) }}">
                                                Edit
                                            </a>
                                            <a class="delete_btn dropdown-item"
                                               data-url="{{route('admin.stock.item-categories.destroy', $item->id) }}">
                                                Delete
                                            </a>
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
        {{--user category modal--}}
        <div class="modal fade" id="addModal" tabindex="-1" category="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" category="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="add-category-form" action="{{route('admin.stock.item-categories.store')}} "
                          method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Item name">
                            </div>
                            <div class="form-group">
                                <label>Is Meter</label>
                                <select name="is_meter" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Save Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--user update modal--}}
        <div class="modal fade" id="user_category_edit_modal" tabindex="-1" category="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" category="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="edit-category-form"
                          method="POST">
                        @method('PUT')
                        {{csrf_field()}}
                        <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" name="name" id="_name" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Item name">
                            </div>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="checkbox">
                                        <input type="hidden" name="is_meter" value="0">
                                        <input type="checkbox" name="is_meter" id="_is_meter" value="1">
                                        <span class="mr-2"></span>Is Meter

                                    </label>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="checkbox">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" id="_is_active" value="1">
                                        <span class="mr-2"></span>Is Active

                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Edit Item
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
    {!! JsValidator::formRequest(App\Http\Requests\StoreItemRequest::class,'#add-category-form') !!}
    {!! JsValidator::formRequest(App\Http\Requests\UpdateItemRequest::class,'#edit-category-form') !!}
    <script>
        $("#kt_datatable1").DataTable({responsive:true});
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            $('#_name').val($(this).data('name'));
            $('#_is_meter').prop('checked', $(this).data('is_meter'));
            $('#_is_active').prop('checked', $(this).data('is_active'));

            $('#edit-category-form').attr('action', $(this).data('url'));
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
