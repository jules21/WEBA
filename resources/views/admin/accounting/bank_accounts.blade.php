@extends('layouts.master')
@section('title', 'Bank Accounts')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Bank Accounts
                </h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="text-muted">
                          Manage   Bank Accounts
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">

            </div>

            <!--end::Toolbar-->
        </div>
    </div>

    <div class="card card-body">


        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4>
                    Bank Accounts
                </h4>
            </div>
            @if(auth()->user()->operation_area)
                <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder" id="addNewBtn">
                    <i class="flaticon2-plus"></i>
                    New Account
                </button>
            @endif

        </div>
        <div class="table-responsive my-3">
            <table class="table table-head-custom border table-head-solid table-hover dataTable">
                <thead>
                <tr>
                    <th>Bank</th>
                    <th>Account No</th>
                    <th>Account Name</th>
                    <th>Ledger No</th>
                    <th>Opening Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        New Bank Account
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.accounting.bank-accounts.store') }}" method="post" id="submitForm">
                    @csrf
                    <input type="hidden" name="id" id="accountId" value="0"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="payment_service_provider_id">Service Provider</label>
                            <select name="payment_service_provider_id" id="payment_service_provider_id"
                                    class="form-control">
                                <option value="">Select Service Provider</option>
                                @foreach($serviceProviders as $serviceProvider)
                                    <option value="{{ $serviceProvider->id }}">{{ $serviceProvider->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <input type="text" name="account_number" id="account_number" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="account_name">Account Name</label>
                            <input type="text" name="account_name" id="account_name" class="form-control"/>
                        </div>
                        {{--      <div class="form-group">
                                  <label for="currency">
                                      Currency
                                  </label>
                                  <select name="currency" id="currency" class="form-control">
                                      <option value="">Select Currency</option>
                                      @foreach($currencies as $currency)
                                          <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                      @endforeach
                                  </select>
                              </div>--}}

                        <div class="form-group">
                            <label for="opening_date">Opening Date</label>
                            <input type="date" name="opening_date" id="opening_date" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i>
                            Save Changes
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateServiceProviderAccountRequest::class) !!}
    <script>


        $(document).ready(function () {
            $('.nav-accounting-settings').addClass('menu-item-active menu-item-open');
            $('.nav-bank-accounts').addClass('menu-item-active');

            let submitForm = $('#submitForm');
            submitForm.validate();

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {data: "payment_service_provider.name", name: "paymentServiceProvider.name"},
                    {data: "account_number", name: "account_number"},
                    {data: "account_name", name: "account_name"},
                    {data: "ledger_no", name: "ledger_no"},
                    {data: "opening_date", name: "opening_date"},
                    {
                        data: "is_active", name: "is_active",
                        render: function (data) {
                            if (data) {
                                return '<span class="label label-lg font-weight-bold label-light-success label-inline rounded-pill">Active</span>';
                            }
                            return '<span class="label label-lg font-weight-bold label-light-danger label-inline rounded-pill">Inactive</span>';
                        }
                    },
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
            });

            $('#addNewBtn').on('click', function () {
                $('#addModal').modal('show');
            });

            $('.js-delete').on('click', function () {
                $(this).closest('tr').remove();
            });
            let isSubmitting = false;
            submitForm.on('submit', function (e) {
                e.preventDefault();
                if (!submitForm.valid() || isSubmitting) {
                    return;
                }
                let btn = $(this).find('[type="submit"]');
                btn.addClass('spinner spinner-white spinner-right').attr('disabled', true);
                isSubmitting = true;
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#addModal').modal('hide');
                        dataTable.ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: "Bank account saved successfully",
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to save bank account, please try again later",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                    complete: function () {
                        btn.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
                        isSubmitting = false;
                    }
                });
            });

            $(document).on('click', '.js-delete', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            method: 'delete',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                dataTable.ajax.reload();
                                Swal.fire({
                                    title: 'Success!',
                                    text: "Bank account deleted successfully",
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                });
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Unable to delete bank account, please try again later",
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            },
                        });
                    }
                });
            });

            $('#addModal').on('hidden.bs.modal', function () {
                submitForm.trigger('reset');
                $('#accountId').val('');
            });

            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (response) {
                        $('#addModal').modal('show');
                        $('#account_number').val(response.account_number);
                        $('#account_name').val(response.account_name);
                        $('#opening_date').val(response.opening_date);
                        $('#is_active').val(response.is_active ? 1 : 0);
                        $('#accountId').val(response.id);
                        $('#payment_service_provider_id').val(response.payment_service_provider_id);

                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to edit bank account, please try again later",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                });
            });


        });
    </script>

@endsection
