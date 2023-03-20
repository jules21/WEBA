@extends('layouts.master')

@section('title',"Customers")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Customers</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Customer Management</span>
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
                        Customers
                    </h4>

                    <buttont type="button" class="btn btn-primary btn-sm" id="addButton">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
</svg>

                       </span>
                        Add New
                    </buttont>
                </div>


                <div class="table-responsive my-3">
                    <table class="table table-head-custom border table-head-solid table-hover dataTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Doc Number</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Connections</th>
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


    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Customer
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.customers.store') }}"
                      method="post" id="formSave">
                    @csrf
                    <input type="hidden" value="0" id="id" name="id"/>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="legal_type_id">Legal Type</label>
                                    <select name="legal_type_id" id="legal_type_id" class="form-control" required>
                                        <option value="">Select Legal</option>
                                        @foreach($legalTypes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="document_type_id">Document Type</label>
                                    <select name="document_type_id" id="document_type_id" class="form-control" required>
                                        <option value="">Select Type</option>
                                        @foreach($idTypes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="doc_number">Document Number</label>
                                    <div class="d-flex flex-shrink-0">
                                 {{--       <input type="hidden" name="doc_number" id="doc_number" class="form-control"
                                               required/>--}}
                                       <input type="text" id="doc_number" name="doc_number" class="form-control" required/>
                                        {{-- <button type="button" id="btnCheckIdDetails"
                                                class="btn btn-primary ml-2">
                                            Check
                                        </button>--}}
                                    </div>
                                    <label id="input_doc_number-error" class="error" for="input_doc_number"></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" id="email" class="form-control"/>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="province_id">Province</label>
                                    <select name="province_id" id="province_id" class="form-control" required>
                                        <option value="">Select Province</option>
                                        @foreach($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sector_id">Sector</label>
                                    <select name="sector_id" id="sector_id" class="form-control" required>
                                        <option value="">Select Sector</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="cell_id">Cell</label>
                                    <select name="cell_id" id="cell_id" class="form-control" required>
                                        <option value="">Select Cell</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="village_id">Village</label>
                                    <select name="village_id" id="village_id" class="form-control">
                                        <option value="">Select Village</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
        {!! JsValidator::formRequest(App\Http\Requests\StoreCustomerRequest::class) !!}--}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

    <script>

        function getDistricts(provinceId, selectedDistrictId) {
            let districtId = $('#district_id');
            districtId.empty();
            districtId.append('<option value="">Select District</option>');

            $.ajax({
                url: "/districts/" + provinceId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        districtId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    districtId.val(selectedDistrictId);
                }
            });
        }


        function getSectors(districtId, selectedSectorId) {
            let sectorId = $('#sector_id');
            sectorId.empty();
            sectorId.append('<option value="">Select Sector</option>');


            $.ajax({
                url: "/sectors/" + districtId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        sectorId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    sectorId.val(selectedSectorId);
                }
            });
        }


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

        function getDocumentTypes(legalTypeId, selectedDocTypedId) {
            let docTypeId = $('#document_type_id');
            docTypeId.empty();
            docTypeId.append('<option value="">Select Doc Type</option>');
            $.ajax({
                url: "/documents-types/" + legalTypeId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        docTypeId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    docTypeId.val(selectedDocTypedId);
                }
            })


        }


        $(document).ready(function () {
            $('.nav-customers').addClass('menu-item-active');
            let $formSave = $('#formSave');
            $formSave.validate();

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{{ route('admin.customers.index') }}",
                columns: [
                    {
                        data: "name", name: "name",
                        render: function (data, type, row) {
                            return `<div>
                                        <div>${data}</div>
                                        <div class="text-muted  mt-2">${row.legal_type.name}</div>
                                    </div`
                        }
                    },
                    {
                        data: "doc_number", name: "doc_number",
                        render: function (data, type, row) {
                            return `<div>
                                        <div>${data}</div>
                                        <div class="text-muted mt-2">${row.document_type.name}</div>
                                    </div`
                        }
                    },
                    {data: "email", name: "email"},
                    {data: "phone", name: "phone"},
                    {data: "connection", name: "connection"},
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        targets: 4,
                        className: 'text-center'
                    },
                ]
            });

            $('#addButton').on('click', function () {
                $('#addModal').modal('show');
            });

            $('#province_id').on('change', function (e) {
                getDistricts($(this).val());
            });


            $('#district_id').on('change', function (e) {
                getSectors($(this).val());
            });


            $('#sector_id').on('change', function (e) {
                getCells($(this).val());
            });

            let $legalTypeId = $('#legal_type_id');
            $legalTypeId.on('change', function () {
                getDocumentTypes($(this).val());
            });

            let $inputDocNumber = $('#input_doc_number');
            let $documentTypeId = $('#document_type_id');
            $documentTypeId.on('change', function () {
                let docTypeId = $(this).val();
                if (docTypeId === "{{ config('app.NATIONAL_ID') }}") {
                    $inputDocNumber.attr('maxlength', '16');
                } else {
                    $inputDocNumber.attr('maxlength', '10');
                }
            });

            $('#btnCheckIdDetails').on('click', function () {
                let docNumber = $inputDocNumber.val();
                let legalTypeId = $legalTypeId.val();
                let documentTypeId = $documentTypeId.val();
                if (docNumber && legalTypeId && documentTypeId) {
                    let url = "{{ route("admin.customers.fetch-identification-from-nida",":id") }}";
                    url = url.replace(':id', docNumber);

                    $inputDocNumber.attr('disabled', true);
                    $legalTypeId.attr('disabled', true);
                    $documentTypeId.attr('disabled', true);

                    let btn = $(this);
                    btn.attr('disabled', true);
                    btn.addClass('spinner spinner-white spinner-right');

                    $.ajax({
                        url: url,
                        method: "get",
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#input_name').val(response.data.name);
                                $('#input_email').val(response.data.email);
                                $('#input_phone').val(response.data.phone);
                                $('#input_address').val(response.data.address);
                                $('#province_id').val(response.data.province_id);
                                getDistricts(response.data.province_id, response.data.district_id);
                                getSectors(response.data.district_id, response.data.sector_id);
                                getCells(response.data.sector_id, response.data.cell_id);
                                getVillages(response.data.cell_id, response.data.village_id);
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    icon: "error",
                                    text: response.message
                                });
                            }
                        }, error: function (response) {
                            Swal.fire({
                                title: "Error",
                                icon: "error",
                                text: "Unable to check id details, try again"
                            });
                        },
                        complete: function () {
                            btn.attr('disabled', false);
                            btn.removeClass('spinner spinner-white spinner-right');
                            $inputDocNumber.prop("disabled", false);
                            $legalTypeId.prop("disabled", false);
                            $documentTypeId.prop("disabled", false);
                        }
                    });
                }

            });

            $formSave.on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);
                if (!$form.valid())
                    return;
                let $btn = $form.find(":submit");

                $btn.prop("disabled", true)
                    .addClass("spinner spinner-white spinner-sm spinner-right");
                $.ajax({
                    url: $form.attr("action"),
                    method: "post",
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        dataTable.ajax.reload();
                        $('#addModal').modal('hide');
                    }, error: function (response) {
                        Swal.fire({
                            title: "Error",
                            icon: "error",
                            text: "Unable to save customer, try again"
                        });
                    },
                    complete: function () {

                        $btn.prop("disabled", false)
                            .removeClass("spinner spinner-white spinner-sm spinner-right");
                    }
                });

            });


            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');

                $.ajax({
                    url: url,
                    method: "GET",
                    success: function (data) {
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $legalTypeId.val(data.legal_type_id);
                        $documentTypeId.val(data.document_type_id);
                        $('#doc_number').val(data.doc_number);
                        $('#phone').val(data.phone);
                        $('#email').val(data.email);
                        $('#province_id').val(data.province_id);
                        getDistricts(data.province_id, data.district_id);
                        getSectors(data.district_id, data.sector_id);
                        getCells(data.sector_id, data.cell_id);
                        $('#addModal').modal();
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
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
                            }
                        })
                    }
                });

            });


        });
    </script>

@endsection
