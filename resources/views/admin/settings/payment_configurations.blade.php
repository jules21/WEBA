@extends('layouts.master')
@section("title","Payment Configurations")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Payment Configurations</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Payment Configurations</a>
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
                <h3 class="card-label">Payment Configurations List</h3>
            </div>
            <div class="card-toolbar">
                <!-- Button trigger modal-->
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModalLong">
                    <span class="flaticon-add"></span>
                    Add New Record
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
                        <th>Payment Type</th>
                        <th>Request Type</th>
                        @if(auth()->user()->is_super_admin)
                            <th>Operator</th>
                        @endif
                        <th>Operation Area</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($payments as $key=>$payment)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$payment->paymentType->name}}</td>
                            <td>{{$payment->requestType->name}}</td>
                            @if(auth()->user()->is_super_admin)
                                <td>{{$payment->operator->name}}</td>
                            @endif
                            <td>{{$payment->operationArea->name}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                        <a href="#" data-id="{{$payment->id}}"
                                           data-payment="{{$payment->payment_type_id}}"
                                           data-request="{{$payment->request_type_id}}"
                                           data-operator="{{$payment->operator_id}}"
                                           data-area="{{$payment->operation_area}}"
                                           data-amount="{{$payment->amount}}"
                                           class="dropdown-item js-edit">Edit</a>
                                        <a href="{{route('admin.payment.configuration.delete',$payment->id)}}"
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
            <form action="{{route('admin.payment.configuration.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Payment Configuration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Payment Type</label>
                            <select name="payment_type_id" id="payment_type_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\PaymentType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Request Type</label>
                            <select name="request_type_id" id="request_type_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\RequestType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

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

                        <div class="form-group">
                            <label for="name">Operation Area</label>
                            <select name="operation_area_id" id="operation_area_id" class="form-control">
                                <option value="">Please Select Area</option>
                                @foreach(App\Models\OperationArea::all() as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input type="number"  name="amount" class="form-control" required/>
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
            <form action="{{route('admin.payment.configuration.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="PaymentId" name="PaymentId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Payment Configuration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Payment Type</label>
                            <select name="payment_type_id" id="edit_payment_type_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\PaymentType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Request Type</label>
                            <select name="request_type_id" id="edit_request_type_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\RequestType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if(auth()->user()->operator_id == null)
                            <div class="form-group">
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2 kt_select2_2" style="width: 100% !important;" id="edit_operator_id">
                                    <option value="">Select Operator</option>
                                    @foreach($operators as $operator)
                                        <option value="{{$operator->id}}">{{$operator->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        @endif

                        <div class="form-group">
                            <label for="name">Operation Area</label>
                            <select name="operation_area_id" id="edit_operation_area_id" class="form-control">
                                <option value="">Please Select Area</option>
                                @foreach(App\Models\OperationArea::all() as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input type="text"  name="amount" id="edit_amount" class="form-control" required/>
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
    {!! JsValidator::formRequest(\App\Http\Requests\ValidatePaymentConfiguration::class,'.submissionForm') !!}

  <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-payment-configurations').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#PaymentId").val($(this).data('id'));
            $("#edit_payment_type_id").val($(this).data('payment'));
            $("#edit_request_type_id").val($(this).data('request'));
            $("#edit_operator_id").val($(this).data('operator'));
            $("#edit_operation_area_id").val($(this).data('area'));
            $("#edit_amount").val($(this).data('amount'));
            $("#edit_is_active").val($(this).data('active'));
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Request Duration Configuration ?",
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

        // basic
        $('#kt_select2_1, .kt_select2_2').select2({
            placeholder: 'Select an operator'
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#PaymentId').val(0);
        });

    </script>

@endsection