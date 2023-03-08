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
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
        {{--user category modal--}}
        <div class="modal fade" id="addModal" tabindex="-1" category="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" category="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="add-category-form" action="{{route('admin.stock.items.store')}} "
                          method="POST">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>Item</label>
                                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Item name">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Item Category</label>
                                    <select name="item_category_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label>Packaging Unit</label>
                                    <select name="packaging_unit_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label>Selling Price</label>
                                    <input type="number" name="selling_price" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Selling Price">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Vatable</label>
                                    <select name="vatable" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="vat_rate">Vat Rate</label>
                                    <input type="number" name="vat_rate" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Vat Rate">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Item Description</label>
                                    <textarea name="description" class="form-control" aria-describedby="emailHelp"
                                              placeholder="Item description"></textarea>
                                </div>
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
        <div class="modal fade" id="edit-item-modal" tabindex="-1" category="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" category="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="edit-category-form"
                          method="POST">
                        @method('PUT')
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>Item</label>
                                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Item name" id="_name">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="item_category_id">Item Category</label>
                                    <select name="item_category_id" class="form-control" id="_item_category_id">
                                        <option value="">--select--</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="packaging_unit_id">Packaging Unit</label>
                                    <select name="packaging_unit_id" class="form-control" id="_packaging_unit_id">
                                        <option value="">--select--</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="number" name="selling_price" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Selling Price" id="_selling_price">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="vatable">Vatable</label>
                                    <select name="vatable" class="form-control" id="_vatable">
                                        <option value="">--select--</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="vat_rate">Vat Rate</label>
                                    <input type="number" name="vat_rate" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Vat Rate" id="_vat_rate">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="status">Status</label>
                                    <select name="is_active" class="form-control" id="_status">
                                        <option value="">--select--</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>

                                </div>
                                <div class="col-12 form-group">
                                    <label for="description">Item Description</label>
                                    <textarea name="description" class="form-control" aria-describedby="emailHelp"
                                              placeholder="Item description" id="_description"></textarea>
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
    {!! $dataTable->scripts() !!}
    <script>
        $("#kt_datatable1").DataTable({responsive:true});
        $(document).on('click','.btn-edit', function (e) {
            e.preventDefault();
            console.log($(this).data('vatable'));
            $('#_name').val($(this).data('name'));
              $('#_item_category_id').val($(this).data('item_category_id'));
            $('#_packaging_unit_id').val($(this).data('packaging_unit_id'));
            $('#_selling_price').val($(this).data('selling_price'));
            $('#_vatable').val($(this).data('vatable') ? 1 : 0);
            $('#_vat_rate').val($(this).data('vat_rate'));
            $('#_description').val($(this).data('description'));
            $('#_status').val($(this).data('is_active'));
            $('#edit-category-form').attr('action', $(this).data('url'));
        });

        $(document).on('click', '.btn-delete', function (e){
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
