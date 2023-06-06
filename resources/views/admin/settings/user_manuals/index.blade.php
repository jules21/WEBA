@extends('layouts.master')
@section("title","User Manuals")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">User Manuals</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">User Manuals</a>
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
                <h3 class="card-label">User Manuals List</h3>
            </div>

            <div class="card-toolbar">
                <!-- Button trigger modal-->
                <button type="button" class="btn btn-light-primary" data-toggle="modal"
                        data-target="#exampleModalLong">
                    <i class="flaticon2-plus"></i>
                    Add New Record
                </button>
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
                        <th>File(ENG)</th>
                        <th>Title(ENG)</th>
                        <th>Description(ENG)</th>

                        <th>Title(KINY)</th>
                        <th>Description(KINY)</th>
                        <th>File(KINY)</th>

                        <th>For Admins</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($manuals as $key=>$manual)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <a class="btn btn-light-primary btn-sm rounded-pill" href="{{route('admin.user.manuals.download',$manual->slug)}}" target="_blank">
                                    Download
                                </a>
                            </td>
                            <td>{{trans($manual->title)}}</td>
                            <td>{{trans($manual->description)}}</td>

                            <td>{{trans($manual->title,[],'kn')}}</td>
                            <td>{{trans($manual->description,[],'kn')}}</td>
                            <td>
                                <a class="btn btn-light-primary btn-sm rounded-pill" href="{{route('admin.user.manuals.download',$manual->slug)}}" target="_blank">
                                    Download
                                </a>
                            </td>
                            <td>
                                @if($manual->for_admin)
                                    <span class="label label-inline label-light-success font-weight-bold">Yes</span>
                                @else
                                    <span class="label label-inline label-light-danger font-weight-bold">No</span>
                                @endif
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                        <a href="#" data-id="{{$manual->id}}"
                                           data-title="{{trans($manual->title)}}"
                                           data-description="{{trans($manual->description)}}"
                                           data-file="{{$manual->file}}"
                                             data-title_kn="{{trans($manual->title,[],'kn')}}"
                                             data-description_kn="{{trans($manual->description,[],'kn')}}"
                                             data-for_admin="{{$manual->for_admin}}"
                                           class="dropdown-item js-edit">Edit</a>
                                        <a href="{{route('admin.user.manual.delete',$manual->id)}}"
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
        <div class="modal-dialog modal-lg">
            <form action="{{route('admin.user.manual.store')}}" method="post" id="submissionForm" class="submissionForm"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0" name="id" id="id"/>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New User Manual</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">File(ENGLISH)</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="file">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">File(KINYARWANDA)</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_kn" class="custom-file-input" id="file_kn">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title(ENGLISH)</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="title">Title(KINYARWANDA)</label>
                                <input type="text" name="title_kn" id="title_kn" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description(ENGLISH)</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description">Description(KINYARWANDA)</label>
                                <textarea name="description_kn" id="description_kn" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>For Admin</label>
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-rounded">
                                    <input type="radio" checked="checked" name="for_admin" value="1">
                                    <span></span>Yes</label>
                                <label class="checkbox checkbox-rounded">
                                    <input type="radio" name="for_admin" checked value="0">
                                    <span></span>No</label>
                            </div>
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
        <div class="modal-dialog modal-lg">
            <form action="{{route('admin.user.manual.edit')}}" method="post" id="submissionFormEdit"
                  class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0" id="UserManualId" name="UserManualId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit New User Manual</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">File (ENGLISH)</label>
                                    <input type="file" name="file" id="edit_file" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">File (KINYARWANDA)</label>
                                    <input type="file" name="file_kn" id="edit_file_kn" class="form-control">
                                </div>
                            </div>
                            </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title (ENGLISH)</label>
                                    <input type="text" name="title" id="edit_title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title (KINYARWANDA)</label>
                                    <input type="text" name="title_kn" id="edit_title_kn" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="edit_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description">Description(KINYARWANDA)</label>
                                <textarea name="description_kn" id="edit_description_kn" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>For Admin</label>
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-rounded">
                                    <input type="radio" checked="checked" name="for_admin" value="1">
                                    <span></span>Yes</label>
                                <label class="checkbox checkbox-rounded">
                                    <input type="radio" name="for_admin" checked value="0">
                                    <span></span>No</label>
                            </div>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreUserManualRequest::class,'#submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateUserManualRequest::class,'#submissionFormEdit') !!}


    <script>

        $(document).ready(function () {
            $('#table').DataTable();

            /*      $('#water_network_type_id').on('change', function () {
                      if (!$(this).val())
                          return;
                      loadOperationAreas($(this).val(), 0);
                  });*/
        });

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-user-manuals').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#UserManualId").val($(this).data('id'));
            $("#edit_title").val($(this).data('title'));
            $("#edit_description").val($(this).data('description'));

            $("#edit_title_kn").val($(this).data('title_kn'));
            $("#edit_description_kn").val($(this).data('description_kn'));
            //for admin
            if ($(this).data('for_admin') == 1) {
                $("input[name='for_admin'][value='1']").prop('checked', true);
            } else {
                $("input[name='for_admin'][value='0']").prop('checked', true);
            }
            $('#submissionFormEdit').attr('action', url);
        });

        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            let btn = form.find('button[type="submit"]');
            btn.prop('disabled', true);
            e.target.submit();
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this User Manual ?",
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
            $('#FaqId').val(0);
        });

    </script>

@endsection
