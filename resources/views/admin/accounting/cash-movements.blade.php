@extends('layouts.master')
@section('title', 'Cash Movements')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Cash Movements
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
                          Manage Cash Movements
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
                    Cash Movements
                </h4>
            </div>
            @if(auth()->user()->operation_area)
                <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder" id="addNewBtn">
                    <i class="flaticon2-plus"></i>
                    New Entry
                </button>
            @endif

        </div>


        <div class="table-responsive my-3">
            <table class="table table-head-custom border table-head-solid table-hover dataTable">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Bank</th>
                    <th>Account No</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Cash Movement
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.accounting.cash-movements.store') }}" method="post" id="submitForm">
                    @csrf
                    <input type="hidden" name="id" id="id" value="0"/>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" value="{{ now()->toDateString() }}"
                                           class="form-control"
                                           id="date"/>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="transaction_type">Transaction Type</label>
                                    <select name="transaction_type" id="transaction_type" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach(\App\Constants\TransactionType::getTypes() as $key => $value)
                                            <option
                                                value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="psp_id">Bank</label>
                                    <select name="psp_id" id="psp_id"
                                            class="form-control">
                                        <option value="">Select Bank</option>
                                        @foreach($banks as $expenseCategory)
                                            <option
                                                value="{{ $expenseCategory->id }}">{{ $expenseCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="psp_account_id">Bank Account</label>
                                    <select name="psp_account_id" id="psp_account_id" class="form-control">
                                        <option value="">Select Bank Account</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" id="amount"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="reference_no">Reference No</label>
                                    <input type="text" name="reference_no" class="form-control" id="reference_no"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
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
    {!! JsValidator::formRequest(App\Http\Requests\ValidateCashMovementRequest::class) !!}
    <script>


        function getBankAccounts(pspId, selectedId) {
            let url = "{{ route('admin.accounting.provider-service-by-accounts',':id') }}";
            url = url.replace(':id', pspId);

            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    let bankAccounts = response;
                    let html = '<option value="">Select Account</option>';
                    bankAccounts.forEach(function (account) {
                        html += '<option value="' + account.id + '">' + account.account_number + '-' + account.account_name + '</option>';
                    });

                    let $bankAccountId = $('#psp_account_id');
                    $bankAccountId.html(html);
                    if (selectedId) {
                        $bankAccountId.val(selectedId);
                    }
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: "Unable to get bank accounts, please try again later",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        $(document).ready(function () {
            $('.nav-accounting').addClass('menu-item-active menu-item-open');
            $('.nav-cash-movements').addClass('menu-item-active');

            let submitForm = $('#submitForm');
            submitForm.validate();

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {data: "date", name: "date"},
                    {data: "transaction_type", name: "transaction_type"},
                    {
                        data: "amount", name: "amount",
                        render: function (data, type, row) {
                            return Number(data).toLocaleString();
                        }
                    },

                    {data: "payment_service_provider.name", name: "paymentServiceProvider.name"},
                    {
                        data: "payment_service_provider_account.account_number",
                        name: "paymentServiceProviderAccount.account_number"
                    },
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
            });

            $('#addNewBtn').on('click', function () {
                $('#addModal').modal('show');
            });

            $('#psp_id').on('change', function () {
                let bank = $(this).val();
                getBankAccounts(bank, null);
            })


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
                            text: "Record saved successfully",
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to save, please try again later",
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
                                    text: "Record deleted successfully",
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                });
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Unable to delete , please try again later",
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
                $('#id').val('0');
            });

            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (response) {
                        $('#addModal').modal('show');
                        $('#id').val(response.id);
                        $('#psp_id').val(response.psp_id);
                        getBankAccounts(response.psp_id, response.psp_account_id);
                        $('#amount').val(response.amount);
                        $('#date').val(response.date);
                        $('#description').val(response.description);
                        $('#transaction_type').val(response.transaction_type);
                        $('#reference_no').val(response.reference_no);
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to edit cash movement, please try again later",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                });
            });


        });
    </script>

@endsection
