@extends('layouts.master')
@section('title', 'Ledger Migration')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Ledger Migration
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
                            Ledger Migration
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
                    Ledger Migration
                </h4>
            </div>
            <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder" id="addNewBtn">
                <i class="flaticon2-plus"></i>
                New Entry
            </button>
        </div>
        <div class="table-responsive my-3">
            <table class="table table-head-custom border table-head-solid table-hover dataTable">
                <thead>
                <tr>
                    <th>Ledger Category</th>
                    <th>Ledger Name</th>
                    <th>Ledger No</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                @foreach($ledgerMigrations as $item)
                    <tr>
                        <td>{{ $item->ledgerGroup->ledger_description }}</td>
                        <td>{{ $item->ledgerCategory->ledger_description }}</td>
                        <td>{{ $item->ledger->ledger_no }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->balance_type }}</td>
                        <td>
                            <button type="button" class="btn btn-light-primary btn-sm btn-icon rounded-circle">
                                <i class="flaticon2-edit"></i>
                            </button>
                            <button type="button" class="btn btn-light-danger btn-sm btn-icon rounded-circle">
                                <i class="flaticon2-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <div>
                    Total Debit : <strong>{{ number_format($totalDebits) }}</strong>
                </div>
                <div>
                    Total Credit : <strong>{{ number_format($totalCredits) }}</strong>
                </div>
                <div>
                    Difference : <strong>{{ number_format($totalBalance) }}</strong>
                </div>
            </div>

        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Ledger Migration
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.accounting.ledger-migration.store') }}" method="post" id="submitForm">
                    @csrf
                    <input type="hidden" name="id" id="entryId" value="0"/>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="ledger_group">Ledger Group</label>
                            <select name="ledger_group" id="ledger_group"
                                    class="form-control">
                                <option value="">Select Ledger</option>
                                @foreach($ledgerGroups as $item)
                                    <option
                                        value="{{ $item->id }}">{{ $item->ledger_description }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="ledger_category">
                                Ledger Category
                            </label>
                            <select name="ledger_category" id="ledger_category"
                                    class="form-control">
                                <option value="">
                                    Select Ledger
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ledger_id">Ledger No</label>
                            <select name="ledger_id" id="ledger_no"
                                    class="form-control">
                                <option value="">Select Ledger</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount"/>
                        </div>

                        <div class="form-group">
                            <label for="balance_type">
                                Balance Type
                            </label>
                            <select class="form-control" name="balance_type" id="balance_type">
                                <option value=""></option>
                                @foreach(\App\Constants\BalanceType::types() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
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
    {!! JsValidator::formRequest(App\Http\Requests\ValidateLedgerMigration::class) !!}
    <script>


        function getLedgers(expenseCategoryId, $element, selectedId) {
            let url = "{{ route('admin.accounting.expense-ledgers',':id') }}";
            url = url.replace(':id', expenseCategoryId);

            $.ajax({
                url: url,
                method: 'get',
                success: function (response) {
                    let ledgers = response;
                    let html = '<option value="">Select Ledger</option>';
                    ledgers.forEach(function (ledger) {
                        html += '<option value="' + ledger.id + '">' + ledger.ledger_description + '</option>';
                    });

                    $element.html(html);
                    if (selectedId) {
                        $element.val(selectedId);
                    }
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: "Unable to get  ledgers, please try again",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        $(document).ready(function () {
            $('.nav-ledger-migration').addClass('menu-item-active');

            let submitForm = $('#submitForm');
            submitForm.validate();


            $('#addNewBtn').on('click', function () {
                $('#addModal').modal('show');
            });

            $('#ledger_group').on('change', function () {
                let groupId = $(this).val();
                getLedgers(groupId, $('#ledger_category'), null);
            })
            $('#ledger_category').on('change', function () {
                let groupId = $(this).val();
                getLedgers(groupId, $('#ledger_no'), null);
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
                        location.reload();
                    },
                    error: function (error) {
                        isSubmitting = false;
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to save record, please try again later",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                    complete: function () {

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
                                location.reload();
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Unable to delete record, please try again later",
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
                $('#entryId').val('0');
            });

            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (response) {
                        $('#addModal').modal('show');
                        $('#entryId').val(response.id);

                        $('#debit_ledger_croup').val(response.debit_ledger_croup);
                        getLedgers(response.debit_ledger_croup, $('#debit_ledger'), response.debit_ledger);

                        $('#credit_ledger_croup').val(response.credit_ledger_croup);
                        getLedgers(response.credit_ledger_croup, $('#credit_ledger'), response.credit_ledger);


                        $('#amount').val(response.amount);
                        $('#date').val(response.date);
                        $('#description').val(response.description);
                        $('#payment_ledger').val(response.payment_ledger);


                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: "Unable to edit journal entry, please try again",
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    },
                });
            });


        });
    </script>

@endsection
