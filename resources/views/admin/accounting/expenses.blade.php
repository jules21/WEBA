@extends('layouts.master')
@section('title', 'Expenses')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Expenses
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
                          Manage Expenses
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
                    Expenses
                </h4>
            </div>
            @if(auth()->user()->operation_area)
                <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder" id="addNewBtn">
                    <i class="flaticon2-plus"></i>
                    New Expense
                </button>
            @endif

        </div>
        <div class="table-responsive my-3">
            <table class="table table-head-custom border table-head-solid table-hover dataTable">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Expense Ledger</th>
                    <th>Payment Ledger</th>
                    <th>Amount</th>
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
                        Expense
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.accounting.expenses.store') }}" method="post" id="submitForm">
                    @csrf
                    <input type="hidden" name="id" id="expenseId" value="0"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" value="{{ now()->toDateString() }}" class="form-control"
                                   id="date"/>
                        </div>

                        <div class="form-group">
                            <label for="expense_category">Expense Category</label>
                            <select name="expense_category" id="expense_category"
                                    class="form-control">
                                <option value="">Select Expense Category</option>
                                @foreach($expenseCategories as $expenseCategory)
                                    <option
                                        value="{{ $expenseCategory->id }}">{{ $expenseCategory->ledger_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="expense_ledger">Expense Ledger</label>
                            <select name="expense_ledger" id="expense_ledger"
                                    class="form-control">
                                <option value="">Select Expense Ledger</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_ledger">Payment Ledger</label>
                            <select name="payment_ledger" id="payment_ledger"
                                    class="form-control">
                                <option value="">Select Payment Ledger</option>
                                @foreach($paymentLedgers as $paymentLedger)
                                    <option
                                        value="{{ $paymentLedger->id }}">{{ $paymentLedger->ledger_description }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount"/>
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
    {!! JsValidator::formRequest(App\Http\Requests\ValidateExpenseRequest::class) !!}
    <script>


        function getExpenseLedgers(expenseCategoryId, selectedId) {
            let url = "{{ route('admin.accounting.expense-ledgers',':id') }}";
            url = url.replace(':id', expenseCategoryId);

            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    let expenseLedgers = response;
                    let html = '<option value="">Select Expense Ledger</option>';
                    expenseLedgers.forEach(function (expenseLedger) {
                        html += '<option value="' + expenseLedger.id + '">' + expenseLedger.ledger_description + '</option>';
                    });

                    let $expenseLedger = $('#expense_ledger');
                    $expenseLedger.html(html);
                    if (selectedId) {
                        $expenseLedger.val(selectedId);
                    }
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: "Unable to get expense ledgers, please try again",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        $(document).ready(function () {
            $('.nav-accounting').addClass('menu-item-active menu-item-open');
            $('.nav-expenses').addClass('menu-item-active');

            let submitForm = $('#submitForm');
            submitForm.validate();

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {data: "date", name: "date"},
                    {data: "expense_ledger.ledger_description", name: "expense_ledger.ledger_description"},
                    {data: "payment_ledger.ledger_description", name: "payment_ledger.ledger_description"},
                    {
                        data: "amount", name: "amount",
                        render: function (data, type, row) {
                            return Number(data).toLocaleString();
                        }
                    },
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
            });

            $('#addNewBtn').on('click', function () {
                $('#addModal').modal('show');
            });

            $('#expense_category').on('change', function () {
                let expenseCategoryId = $(this).val();
                getExpenseLedgers(expenseCategoryId, null);
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
                            text: "Expense saved successfully",
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to save expense, please try again later",
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
                                    text: "Expense deleted successfully",
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                });
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Unable to delete Expense, please try again later",
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
                $('#expenseId').val('0');
            });

            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (response) {
                        $('#addModal').modal('show');
                        $('#expenseId').val(response.id);
                        $('#expense_category').val(response.expense_category);
                        getExpenseLedgers(response.expense_category, response.expense_ledger);
                        $('#amount').val(response.amount);
                        $('#date').val(response.date);
                        $('#description').val(response.description);
                        $('#payment_ledger').val(response.payment_ledger);


                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to edit expense, please try again later",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                });
            });


        });
    </script>

@endsection
