@extends('layouts.master')
@section("title","Banks")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Banks</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">banks</a>
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
                <h3 class="card-label">List of Banks</h3>
            </div>
            <div class="card-toolbar">
                <!-- Button trigger modal-->
                @can("Manage banks")
                    @if(auth()->user()->operator_id==null && auth()->user()->operation_area==null)
                        <div class="btn-group">
                            <a href="{{route('admin.banks.sync')}}" class="btn btn-success js-sync-banks">
                                <span class="flaticon-add"></span>
                                Sync Banks
                            </a>
                            <a href="{{route('admin.banks.sync')}}" class="btn btn-primary"
                               data-toggle="modal"
                               data-target="#exampleModalLong">
                                <span class="flaticon-add"></span>
                                New Bank
                            </a>
                        </div>

                    @endif

                @endcan

                <!-- Modal-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Is Active</th>
                        <th>Support Payment</th>
                        <th>Created At</th>
                        @can("Manage banks")
                            @if(auth()->user()->operator_id==null && auth()->user()->operation_area==null)
                                <td>Action</td>
                            @endif
                        @endcan
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($banks as $key=>$bank)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$bank->name}}</td>
                            <td>
                                @if($bank->is_active)
                                    <span class="label label-lg label-light-success label-inline">Active</span>
                                @else
                                    <span class="label label-lg label-light-danger label-inline">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($bank->supports_payment)
                                    <span class="label label-lg label-light-success label-inline">Yes</span>
                                @else
                                    <span class="label label-lg label-light-danger label-inline">No</span>
                                @endif
                            </td>
                            <td>{{optional($bank->created_at)->format('Y-m-d')}}</td>
                            @can("Manage banks")
                                @if(auth()->user()->operator_id==null && auth()->user()->operation_area==null)
                                    <td>
                                        @if(!$bank->supports_payment)
                                            <a href="#"
                                               data-url="{{route('admin.banks.update',$bank->id)}}"
                                               data-name="{{$bank->name}}"
                                               data-is_active="{{$bank->is_active}}"
                                               class="btn btn-sm btn-clean btn-icon js-edit"
                                               title="Edit details">
                                    <span class="svg-icon svg-icon-sm">
                                        <i class="flaticon2-edit text-primary"></i>
                                    </span>
                                            </a>
                                            <a href="{{route('admin.banks.destroy',$bank->id)}}"
                                               class="btn btn-sm btn-clean btn-icon js-delete" title="Delete">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon2-trash text-danger"></i>
                                    </span>
                                            </a>
                                        @endif
                                    </td>
                                @endif
                            @endcan
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
            <form action="{{route('admin.banks.add')}}" method="post" id="submissionForm" class="submissionForm"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Bank Name</label>
                            <input required type="text" name="name" id="name" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
            <form action="" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0" id="BillId" name="BillId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="_name">Bank Name</label>
                            <input type="text" name="name" id="_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Is Active</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="">Select</option>
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
    <script>

        $(document).ready(function () {
            $('#table').DataTable();
        });
        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-banks').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            var url = $(this).data('url');
            $("#_name").val($(this).data('name'));
            if ($(this).data('is_active') == 1) {
                $("#is_active").val(1);
            } else {
                $("#is_active").val(0);
            }
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Bill ?",
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

        $(document).on('click', '.js-sync-banks', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Sync Payment banks ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Continue!",
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


    </script>

@endsection
