@extends('layouts.master')
@section("title","Suppliers")
@section('css')
@endsection
@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Suppliers</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Suppliers</a>
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
@stop
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Suppliers List</h3>
                    </div>
                    <div class="card-toolbar">
                        <!-- Button trigger modal-->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalLong">
                            <span class="flaticon-add"></span>
                            Add New Supplier
                        </button>

                        <!-- Modal-->
                    </div>
                </div>
                <div class="card-body">


                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            {{--                    <table class="table table-striped" id="kt_datatable">--}}
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($units as $key=>$unit)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$unit->name}}</td>
                                    @if($unit->is_active == 1)
                                        <td><span class="badge badge-success">Yes</span></td>
                                    @else
                                        <td><span class="badge badge-danger">No</span></td>
                                    @endif
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                                <a href="#" data-id="{{$unit->id}}"
                                                   data-name="{{$unit->name}}"
                                                   data-active="{{$unit->is_active}}"
                                                   class="dropdown-item js-edit">Edit</a>
                                                <a href="{{route('admin.packaging.unit.delete',$unit->id)}}"
                                                   class="dropdown-item js-delete">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.packaging.unit.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Packaging Unit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  name="name" id="name" class="form-control" required/>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>




    <div class="modal fade" id="modalUpdate" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.packaging.unit.edit')}}" method="post" id="submissionFormEdit" class="submissionFormEdit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="UnitId" name="UnitId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Packaging Unit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  name="name" id="edit_name" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Active</label>
                            <select name="is_active" id="edit_is_active" class="form-control">
                                <option value="">Please Select </option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StorePackagingUnitRequest::class,'.submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdatePackagingUnitRequest::class,'.submissionFormEdit') !!}

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-packaging-units').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#UnitId").val($(this).data('id'));
            $("#edit_name").val($(this).data('name'));
            $("#edit_is_active").val($(this).data('active')? 1:0);
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Unit ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((willDelete) => {
                if (willDelete.value) {
                    window.location = href;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#UnitId').val(0);
        });

    </script>

@endsection
