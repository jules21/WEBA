@extends('layouts.master')
@section('title','Item Categories')
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
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Item Categories</a>
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
    <div class="">
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">Categories</h3>
               @can(\App\Constants\Permission::ManageItemCategories)
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" class="btn btn-light-primary"
                           data-toggle="modal"
                           data-target="#addModal" >
                            <i class="la la-plus"></i>
                            New Category
                        </a>
                    </div>
               @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border table-head-solid table-head-custom" id="kt_datatable1">
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
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>
                                   <span class=" label label-inline label-light-{{$category->is_meter ? 'primary':'danger'}} font-weight-bold ">
                                       {{$category->is_meter ? 'Yes':'No'}}
                                   </span>
                                </td>
                                <td>
                                   <span class="label label-inline label-light-{{$category->is_active ? 'primary':'danger'}}">
                                       {{$category->is_active ? 'Active':'Inactive'}}
                                   </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light-primary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                        <div class="dropdown-menu" style="">

                                            <a href="{{route('admin.stock.item-categories.items', encryptId($category->id))}}" class="dropdown-item">
                                                Items
                                            </a>
                                            @can(\App\Constants\Permission::ManageItemCategories)
                                                <div class="dropdown-divider"></div>

                                                <a href="#" class=" edit-btn dropdown-item "
                                                   data-toggle="modal"
                                                   data-target="#user_category_edit_modal"
                                                   data-name="{{$category->name}}"
                                                   data-is_meter="{{$category->is_meter}}"
                                                   data-is_active="{{$category->is_active}}"
                                                   data-id="{{$category->id}}"
                                                   data-url="{{ route('admin.stock.item-categories.update', encryptId($category->id)) }}">
                                                    Edit
                                                </a>
                                                <a class="delete_btn dropdown-item"
                                                   data-url="{{route('admin.stock.item-categories.destroy', encryptId($category->id)) }}">
                                                    Delete
                                                </a>
                                            @endcan
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
                                <label>Category</label>
                                <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Category name">
                            </div>
                            <input type="hidden" name="is_meter" class="form-control" value="1">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Save Category
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
                                <label>Category</label>
                                <input type="text" name="name" id="_name" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Category name">
                            </div>
                            <div class="row">
                                <input type="hidden" name="is_meter" id="_is_meter" value="1">

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
                                Edit Category
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
    {!! JsValidator::formRequest(App\Http\Requests\StoreItemCategoryRequest::class,'#add-category-form') !!}
    {!! JsValidator::formRequest(App\Http\Requests\UpdateItemCategoryRequest::class,'#edit-category-form') !!}
    <script>

        $(document).ready(function () {
            $('.nav-stock-managements').addClass('menu-item-active menu-item-open');
            $('.nav-item-categories').addClass('menu-item-active');
        });

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
