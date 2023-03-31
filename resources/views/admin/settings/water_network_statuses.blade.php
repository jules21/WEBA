@extends('layouts.master')
@section("title","Water Network Statuses")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Water Network Statuses</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Water Network Statuses</a>
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
                <h3 class="card-label">Water Network Statuses List</h3>
            </div>
            <div class="card-toolbar">
                <!-- Button trigger modal-->
                <button type="button" class="btn btn-light-primary" data-toggle="modal"
                        data-target="#exampleModalLong">
                    <i class="flaticon2-plus"></i>
                    Add New Status
                </button>

                <!-- Modal-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($statuses as $key=>$status)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$status->name}}</td>
                            <td>{{$status->created_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                        <a href="#" data-id="{{$status->id}}"
                                           data-name="{{$status->name}}"
                                           class="dropdown-item js-edit">Edit</a>
                                        <a href="{{route('admin.water.network.status.delete',$status->id)}}"
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

    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.water.network.status.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Water Network Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required/>
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
            <form action="{{route('admin.water.network.status.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="WaterNetworkStatusId" name="WaterNetworkStatusId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Water Network Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required/>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreWaterNetworkStatusRequest::class,'.submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateWaterNetworkStatusRequest::class,'.submissionFormEdit') !!}

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-water-network-statuses').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#WaterNetworkStatusId").val($(this).data('id'));
            $("#edit_name").val($(this).data('name'));
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Status ?",
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
            $('#WaterNetworkStatusId').val(0);
        });

    </script>

@endsection
