@extends('layouts.master')
@section("title","Water Network Types")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Water Network Types</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Water Network Types</a>
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
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Water Network Types List</h3>
            </div>
            @if(auth()->user()->is_super_admin)
                <div class="card-toolbar">
                    <!-- Button trigger modal-->
                    <button type="button" class="btn btn-light-primary" data-toggle="modal"
                            data-target="#exampleModalLong">
                        <i class="flaticon2-plus"></i>
                        Add New Type
                    </button>

                    <!-- Modal-->
                </div>
            @endif
        </div>
        <div class="card-body">


            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="table">
                    {{--                    <table class="table table-striped" id="kt_datatable">--}}
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Unit Price</th>
                        <th>Created At</th>
                        @if(auth()->user()->is_super_admin)
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($types as $key=>$type)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->unit_price}}</td>
                            <td>{{$type->created_at}}</td>
                            @if(auth()->user()->is_super_admin)
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                            <a href="#" data-id="{{$type->id}}"
                                               data-name="{{$type->name}}"
                                               data-unit-price="{{$type->unit_price}}"
                                               class="dropdown-item js-edit">Edit</a>
                                            <a href="{{route('admin.water.network.type.delete',$type->id)}}"
                                               class="dropdown-item js-delete">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <!--end: Datatable-->
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.water.network.type.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Water Network Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control" required/>
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
            <form action="{{route('admin.water.network.type.edit')}}" method="post" id="submissionFormEdit" class="submissionFormEdit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="WaterNetworkTypeId" name="WaterNetworkTypeId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Water Network Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Unit Price</label>
                            <input type="number" name="unit_price" id="edit_unit_price" class="form-control" required/>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreWaterNetworkTypeRequest::class,'.submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateWaterNetworkTypeRequest::class,'.submissionFormEdit') !!}

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-water-network-types').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            console.log($(this).data('kin'));
            console.log($(this).data('active'));
            var url = $(this).data('url');
            $("#WaterNetworkTypeId").val($(this).data('id'));
            $("#edit_name").val($(this).data('name'));
            $("#edit_unit_price").val($(this).data('unit-price'));
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Type ?",
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
            $('#WaterNetworkTypeId').val(0);
        });

    </script>

@endsection
