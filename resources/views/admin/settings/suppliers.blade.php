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
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
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
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Suppliers List</h3>
            </div>
            <div class="card-toolbar">
                <!-- Button trigger modal-->
                <button type="button" class="btn btn-light-primary" data-toggle="modal"
                        data-target="#exampleModalLong">
                    <span class="la la-plus"></span>
                    Add New Supplier
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
{{--                        <th>Operator</th>--}}
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact Name</th>
                        <th>Contact Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($suppliers as $key=>$supplier)
                        <tr>
                            <td>{{++$key}}</td>
{{--                            <td>{{$supplier->operator->name}}</td>--}}
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->phone_number}}</td>
                            <td>{{$supplier->email}}</td>
                            <td>{{$supplier->address}}</td>
                            <td>{{$supplier->contact_name}}</td>
                            <td>{{$supplier->contact_email}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                        <a href="#" data-id="{{$supplier->id}}"
                                           data-operator="{{$supplier->operator_id}}"
                                           data-name="{{$supplier->name}}"
                                           data-phone="{{$supplier->phone_number}}"
                                           data-email="{{$supplier->email}}"
                                           data-address="{{$supplier->address}}"
                                           data-contname="{{$supplier->contact_name}}"
                                           data-contmail="{{$supplier->contact_email}}"
                                           class="dropdown-item js-edit">Edit</a>
                                        <a href="{{route('admin.supplier.delete',$supplier->id)}}"
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
            <form action="{{route('admin.supplier.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New supplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        @if(auth()->user()->operator_id == null)
                            <div class="form-group">
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2" style="width: 100% !important;" id="kt_select2_1">
                                    <option value="">Select Operator</option>
                                    @foreach($operators as $operator)
                                        <option value="{{$operator->id}}">{{$operator->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"  name="name" id="name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Phone Number</label>
                                    <input type="text"  name="phone_number" id="phone_number" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email"  name="email" id="email" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text"  name="address" id="address" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Contact Name</label>
                                    <input type="text"  name="contact_name" id="contact_name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Contact Email</label>
                                    <input type="email"  name="contact_email" id="contact_email" class="form-control" required/>
                                </div>
                            </div>
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
            <form action="{{route('admin.supplier.edit')}}" method="post" id="submissionFormEdit" class="submissionFormEdit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="SupplierId" name="SupplierId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Supplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        @if(auth()->user()->operator_id == null)
                            <div class="form-group">
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2" style="width: 100% !important;" id="edit_operator_id">
                                    <option value="">Select Operator</option>
                                    @foreach($operators as $operator)
                                        <option value="{{$operator->id}}">{{$operator->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"  name="name" id="edit_name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Phone Number</label>
                                    <input type="text"  name="phone_number" id="edit_phone_number" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email"  name="email" id="edit_email" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text"  name="address" id="edit_address" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Contact Name</label>
                                    <input type="text"  name="contact_name" id="edit_contact_name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Contact Email</label>
                                    <input type="email"  name="contact_email" id="edit_contact_email" class="form-control" required/>
                                </div>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreSupplierRequest::class,'.submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateSupplierRequest::class,'.submissionFormEdit') !!}

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        // $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-suppliers').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#SupplierId").val($(this).data('id'));
            $("#edit_operator_id").val($(this).data('operator'));
            $("#edit_name").val($(this).data('name'));
            $("#edit_phone_number").val($(this).data('phone'));
            $("#edit_email").val($(this).data('email'));
            $("#edit_address").val($(this).data('address'));
            $("#edit_contact_name").val($(this).data('contname'));
            $("#edit_contact_email").val($(this).data('contmail'));
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Supplier ?",
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
            $('#SupplierId').val(0);
        });

    </script>

@endsection
