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
                        <li class="breadcrumb-item">
                            <a class="text-muted">District Users</a>
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
                    District Users
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
            <div class="table-responsive my-3">
                <table class="table table-head-custom border table-head-solid table-hover dataTable">
                    <thead>
                    <tr>
                        <th>District</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>


        {{--user role modal--}}
        <div data-backdrop="static" class="modal fade" id="addModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="add-user-form" action="{{route('admin.users.store')}} "
                          method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="operation_area">District</label>
                                    <select class="form-control form-control-sm select2" name="district_id" id="district_id" style="width: 100%" required>
                                        <option value="">Select District</option>
                                        @foreach(\App\Models\District::all() as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
        <div data-backdrop="static" class="modal fade" id="edit-user-model" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class="kt-form" id="edit-user-form" action=""
                          method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="operation_area">District</label>
                                    <select class="form-control form-control-sm select2" name="district_id" id="_district_id" style="width: 100%" required>
                                        <option value="">Select District</option>
                                        @foreach(\App\Models\District::all() as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-group ">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" name="name" class="form-control form-control-sm" aria-describedby="emailHelp"
                                           placeholder="user name">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" class="form-control form-control-sm" aria-describedby="emailHelp"
                                           placeholder="Email">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="telephone">Telephone</label>
                                    <input id="telephone" type="text" name="phone" class="form-control form-control-sm"
                                           aria-describedby="emailHelp"
                                           placeholder="Telephone">
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="status">Active</label>
                                    <select class="form-control form-control-sm" id="status" name="status">
                                        <option disabled selected>--select--</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                    class="la la-close"></span> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                                Confirm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateDistrictUser::class,'#edit-user-form') !!}
    {!! JsValidator::formRequest(App\Http\Requests\ValidateDistrictUser::class,'#add-user-form') !!}
    {{ $dataTable->scripts() }}
    <script  src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $(document).ready(function () {
            let dataTable = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                //route with type district parameter
                ajax: "{{ route('admin.users.index') }}?type=district",
                columns: [
                    {data: 'district', name: 'district',
                        render: function (data, type, row) {
                            return data ? data : 'N/A';
                        }
                    },

                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "order": [[0, "asc"]],
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Search:",
                }
            });
        });


        $('.nav-user-managements').addClass('menu-item-active  menu-item-open');

        @if(request()->has('type') && request()->get('type') == 'district')
        $('.nav-district-users').addClass('menu-item-active');
        @else
        $('.nav-all-users').addClass('menu-item-active');
        @endif

        $('#edit-user-model').on('show.bs.modal',function (event) {
            var button = $(event.relatedTarget);
            var href = button.data('url');
            $("#email").val($(button).data("email"));
            $("#name").val($(button).data("name"));
            $("#telephone").val($(button).data("phone"));
            $("#status").val($(button).data("status"));
            $("#_district_id").val($(button).data("district")).select2();
            $('#edit-user-form').attr("action", $(this).data('url'));
            var modal = $(this);
            modal.find('form').attr('action', href)
        })

    </script>

    @endsection
