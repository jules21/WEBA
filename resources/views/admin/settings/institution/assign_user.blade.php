@extends('layouts.master')
@section("title","User Management")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Users</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Users Management</a>
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
    <div class="card card-custom gutter-b">
        <div class="flex-wrap card-header">
            <div class="card-title">
                <h3 class="kt-portlet__head-title">
                    Users
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="javascript:void(0)" class="btn btn-light-primary"
                   data-toggle="modal"
                   data-target="#addModal" >
                    <i class="la la-plus"></i>
                    New User
                </a>
            </div>
            <!--end::Dropdown-->

        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $key=>$institution)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$institution->name}}</td>
                            <td>{{$institution->email}}</td>
                            <td>{{$institution->phone}}</td>
                            <td>{{$institution->created_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                        <a href="#" data-id="{{$institution->id}}"
                                           data-email="{{$institution->email}}"
                                           data-name="{{$institution->name}}"
                                           data-phone="{{$institution->phone}}"
                                           data-status="{{$institution->status}}"
                                           class="dropdown-item js-edit">Edit</a>
                                        <a href="{{route('admin.assign.user.delete',$institution->id)}}"
                                           class="dropdown-item js-delete">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>


        {{--user add modal--}}
        <div data-backdrop="static" class="modal fade" id="addModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="add-user-form" action="{{route('admin.assign.user.store')}}"
                          method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="institution_id" value="{{$institution_id}}">
                                <div class="col-md-12 form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                                           placeholder="user name">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Email">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Phone">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" aria-describedby="emailHelp"
                                           placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--user update modal--}}
        <div class="modal fade" id="modalUpdate" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('admin.assign.user.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="0"  id="InstitutionId" name="InstitutionId">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required/>
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" id="edit_email" class="form-control" required/>
                            </div>

                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" name="phone" id="edit_phone" class="form-control" required/>
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
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\UpdateAssignInstitutionToUserRequest::class,'#submissionFormEdit') !!}
    {!! JsValidator::formRequest(App\Http\Requests\StoreAssignInstitutionToUserRequest::class,'#add-user-form') !!}
    <script  src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-institution').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#InstitutionId").val($(this).data('id'));
            $("#edit_name").val($(this).data('name'));
            $("#edit_email").val($(this).data('email'));
            $("#edit_phone").val($(this).data('phone'));
            $("#edit_status").val($(this).data('status'));
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this User ?",
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
            $('#InstitutionId').val(0);
        });

    </script>

@endsection
