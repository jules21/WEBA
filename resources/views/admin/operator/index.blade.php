@extends('layouts.master')

@section('title',"Operators")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Operators</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Operator Management</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="container">
        <div class="card shadow-none border">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>
                        Operators
                    </h4>

                    <buttont type="button" class="btn btn-light-primary rounded font-weight-bolder" id="addButton">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
</svg>

                       </span>
                        Add New Operator
                    </buttont>
                </div>


                <div class="table-responsive my-3">
                    <table class="table table-head-custom border table-head-solid table-hover dataTable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Doc Number</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    {{--    add modal--}}

    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Operator
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.operator.store') }}" method="post" id="formSave">
                    @csrf
                    <input type="hidden" value="0" id="id" name="id"/>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="identification_type">
                                        Identification type
                                    </label>
                                    <select name="identification_type" id="identification_type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="document_number">Document Number</option>
                                        <option value="code">Operator Code</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="identification_number">
                                        Identification Number
                                    </label>
                                    <div class="input-group ">
                                        <input type="text" class="form-control" id="identification_number"
                                               name="identification_number"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="searchButton">
                                                Check
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-light-info alert-custom" style="display: flex;" id="operatorInfo">
                            <div class="alert-icon text-info">
                            <span class="svg-icon svg-icon-3x">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-info-circle" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    <path d="M12 8l.01 0"></path>
                                    <path d="M11 12l1 0l0 4l1 0"></path>
                                </svg>
                            </span>
                            </div>
                            <div class="alert-text">
                                Operator Details will be displayed here , Please click on check button to get details
                                after choosing identification type and number.
                            </div>
                        </div>
                        <div class="card card-body" style="display: none" id="results">
                            <input type="hidden" id="operator_details" name="operator_details" value=""/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label font-weight-bold">Name</label>
                                        <input type="text" readonly class="form-control-plaintext" id="name"
                                               value="email@example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="legal_type" class="form-label font-weight-bold">Legal Type</label>
                                        <input type="text" readonly class="form-control-plaintext" id="legal_type"
                                               value="email@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_type_id" class="form-label font-weight-bold">ID Type</label>
                                        <input type="text" readonly class="form-control-plaintext" id="id_type_id"
                                               name="id_type_id" value="email@example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="doc_number" class="form-label font-weight-bold">
                                            Doc Number
                                        </label>
                                        <input type="text" readonly class="form-control-plaintext" id="doc_number"
                                               name="doc_number" value="email@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-label font-weight-bold">
                                            Phone Number
                                        </label>
                                        <input type="text" readonly class="form-control-plaintext" id="phone_number"
                                               name="phone_number" value="email@example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label font-weight-bold">
                                            Address
                                        </label>
                                        <input type="text" readonly class="form-control-plaintext" id="address"
                                               name="address" value="email@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_id" class="form-label font-weight-bold">
                                            Province
                                        </label>
                                        <input type="text" readonly class="form-control-plaintext" id="province_id"
                                               name="province_id" value="email@example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_id" class="form-label font-weight-bold">
                                            District
                                        </label>
                                        <input type="text" readonly class="form-control-plaintext" id="district_id"
                                               name="district_id" value="email@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sector_id" class="form-label font-weight-bold">
                                            Sector
                                        </label>
                                        <input type="text" readonly class="form-control-plaintext" id="sector_id"
                                               name="sector_id" value="email@example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cell_id" class="form-label font-weight-bold">
                                                    Cell
                                                </label>
                                                <select name="cell_id" id="cell_id" class="form-control">
                                                    <option value="">Select Cell</option>
                                                    <option value="document_number">Document Number</option>
                                                    <option value="code">Operator Code</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="village_id" class="form-label font-weight-bold">
                                                    Village
                                                </label>
                                                <select name="village_id" id="village_id" class="form-control">
                                                    <option value="">Select Village</option>
                                                    <option value="document_number">Document Number</option>
                                                    <option value="code">Operator Code</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end border-top pt-8">
                                <button type="submit" class="btn btn-primary  mr-2">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                            </div>

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

    {{--    edit modal--}}

    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Operator</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ki ki-close"></i>
                    </button>
                </div>
                <form action="" id="editForm" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <div class="symbol symbol-100 symbol-circle position-relative">
                                <div class="symbol-label" id="logoBg"
                                     style="background-image:url({{ asset('img/logo.svg') }})">
                                </div>
                                <button type="button" id="editLogoBtn"
                                        class="btn btn-sm btn-icon btn-circle btn-light-linkedin position-absolute top-0 right-0">
                                    <i class="flaticon2-edit"></i>
                                </button>
                                <input type="file" name="logo" id="logo" class="d-none"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="edit_address">Address</label>
                            <input type="text" class="form-control" id="edit_address" name="address" value="">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">
                            <i class="flaticon2-checkmark"></i>
                            Save changes
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
    {!! JsValidator::formRequest(App\Http\Requests\StoreOperatorRequest::class) !!}

    <script>
        function getCells(sectorId, selectedCellId) {
            let cellId = $('#cell_id');
            cellId.empty();
            cellId.append('<option value="">Select Cell</option>');
            $.ajax({
                url: "/cells/" + sectorId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        cellId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    cellId.val(selectedCellId);
                }
            })
        }

        function getVillages(cellId, selectedVillageId) {
            let villageId = $('#village_id');
            villageId.empty();
            villageId.append('<option value="">Select Village</option>');
            $.ajax({
                url: "/villages/" + cellId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        villageId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    villageId.val(selectedVillageId);
                }
            })
        }


        $(document).ready(function () {
            $('.nav-operators').addClass('menu-item-active');
            $('#addButton').on('click', function () {
                $('#addModal').modal();
            });

            let dataTable = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.operator.index') }}",
                columns: [
                    {data:'logo',name:'logo',
                        render: function (data, type, row, meta) {
                            return `<div class="symbol symbol-50 symbol-circle position-relative bg-transparent">
                                        <div class="symbol-label" style="background-image:url(${row.logo_url})">
                                        </div>
                                    </div>`;
                        },
                        searchable: false,
                        orderable: false
                    },
                    {data: 'name', name: 'name',
                        render: function (data, type, row, meta) {
                            return `<div>
                                        <div class="font-weight-bold">${row.name}</div>
                                        <div class="text-muted mt-1">${row.legal_type.name}</div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'doc_number', name: 'doc_number',
                        render: function (data, type, row, meta) {
                            return `<div>
                                        <div class="font-weight-bold">${row.doc_number}</div>
                                        <div class="text-muted mt-1">${row.id_type}</div>
                                    </div>`;
                        }
                    },
                    {data: 'address', name: 'address'},

                    {
                        data: 'created_at', name: 'created_at',
                        render: function (data, type, row, meta) {
                            return (new Date(data)).toLocaleDateString();
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "order": [[4, "desc"]],
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

            $('#cell_id').on('change', function () {
                let cellId = $(this).val();
                getVillages(cellId);
            });


            $('#searchButton').on('click', function () {

                let identificationType = $('#identification_type').val();
                let identificationNumber = $('#identification_number').val();


                if (!identificationNumber || !identificationType) {
                    return;
                }

                let btn = $(this);
                btn.prop('disabled', true)
                    .addClass('spinner spinner-white spinner-right');

                let operatorInfo = $('#operatorInfo');
                operatorInfo.slideDown();

                let results = $('#results');
                results.slideUp();
                $('#operator_details').val('');

                let settings = {
                    "url": "{{ route('admin.operator.details') }}",
                    "method": "GET",
                    "data": {
                        "identification_type": identificationType,
                        "identification_number": identificationNumber
                    },
                    success: function (response) {

                        operatorInfo.slideUp();

                        getCells(response.sector_id, response.cell_id);

                        $('#operator_details').val(JSON.stringify(response));

                        $('#name').val(response.name);
                        $('#legal_type').val(response.legal_type.name);
                        $('#id_type_id').val(response.id_type);
                        $('#doc_number').val(response.document_number);
                        $('#province_id').val(response.province.name);
                        $('#district_id').val(response.district.name);
                        $('#sector_id').val(response.sector.name);
                        $('#phone_number').val(response.telephone);
                        $('#address').val(response.address);

                        results.slideDown();

                    },
                    error: function (response) {
                        let statusCode = response.status;
                        let message = 'Something went wrong';
                        if (statusCode === 400) {
                            message = response.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: message,
                        });
                    }, complete: function () {
                        btn.prop('disabled', false)
                            .removeClass('spinner spinner-white spinner-right');
                    }
                };
                $.ajax(settings);
            });

            let isSubmitting = false;
            $('#formSave').on('submit', function (e) {
                e.preventDefault();

                if (!$(this).valid() || isSubmitting) {
                    return;
                }

                isSubmitting = true;

                let btn = $(this).find('button[type="submit"]');
                btn.prop('disabled', true)
                    .addClass('spinner spinner-white spinner-right disabled');

                let settings = {
                    "url": $(this).attr('action'),
                    "method": $(this).attr('method'),
                    "data": $(this).serialize(),
                    success: function (response) {
                        $('#addModal').modal('hide');
                        $('#formSave')[0].reset();
                        $('#results').slideUp();
                        $('#operator_details').val('');

                        dataTable.ajax.reload();
                    },
                    error: function (response) {

                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;

                            $.each(errors, function (index, value) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: value[0],
                                });
                            });
                            return;
                        } else if (response.status === 400) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.responseJSON.message,
                            });
                            return;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });

                    }, complete: function () {
                        isSubmitting = false;
                        btn.prop('disabled', false)
                            .removeClass('spinner spinner-white spinner-right disabled');
                    }
                };
                $.ajax(settings);
            });

            $(document).on('click', '.js-delete', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');
                // show Swal confirm message  before delete

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                dataTable.ajax.reload();
                            },
                            error: function (data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Unable to delete! Please try again later.',
                                });
                            }
                        })
                    }
                });

            });

            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');
                $('#logoBg').css('background-image', 'url(' + $(this).data('logo') + ')');

                $('#edit_address').val($(this).data('address'));

                $('#editForm').attr('action', url);
                $('#editModal').modal('show');

            });

            $('#editLogoBtn').on('click', function () {
                // find file sibling input and click it
                $(this).siblings('input[type="file"]').click();
            });

            $('#logo').on('change', function () {
                let file = $(this)[0].files[0];
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#logoBg').css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(file);
            });

            $('#editForm').on('submit', function (e) {
                e.preventDefault();


                let btn = $(this).find('button[type="submit"]');
                btn.prop('disabled', true)
                    .addClass('spinner spinner-white spinner-right disabled');

                let settings = {
                    "url": $(this).attr('action'),
                    "method": $(this).attr('method'),
                    "data": new FormData(this),
                    "contentType": false,
                    "processData": false,
                    success: function (response) {
                        $('#editModal').modal('hide');
                        dataTable.ajax.reload();
                    },
                    error: function (response) {

                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let messages = [];
                            $.each(errors, function (index, value) {
                                messages.push(value[0]);
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: messages.join('<br>'),
                            });
                        }
                    }, complete: function () {
                        btn.prop('disabled', false)
                            .removeClass('spinner spinner-white spinner-right disabled');
                    }
                };
                $.ajax(settings);
            });


        });
    </script>
@endsection
