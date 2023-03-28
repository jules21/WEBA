@extends('layouts.master')

@section('title',"All Requests")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    {{ isset($customer)?$customer->name."'s":'All' }} Requests
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
                        <span class="text-muted">Request Management</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>


    <div class="card shadow-none border">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    {{ isset($customer)?$customer->name."'s":'All' }} Requests
                </h4>

                {{--  @if(auth()->user()->can(\App\Constants\Permission::CreateRequest) && !is_null(auth()->user()->operation_area))
                      <a href="{{ route('admin.requests.create') }}"
                         class="btn btn-light-primary rounded-sm font-weight-normal btn-sm" id="addButton">
                         <span class="svg-icon">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                  stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                              </svg>
                         </span>
                          New Request
                      </a>
                  @endif--}}
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border rounded-lg table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Operator</th>
                        <th>Customer</th>
                        <th>Request Type</th>
                        <th>Meter Qty</th>
                        <th>UPI</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{--  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
      {!! JsValidator::formRequest(App\Http\Requests\StoreCustomerRequest::class) !!}--}}

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
            $('.nav-request-management').addClass('menu-item-active menu-item-open');
            $('.nav-all-requests').addClass('menu-item-active');

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {
                        data: "created_at", name: "created_at",
                        render: function (data, type, row) {
                            return (new Date(data)).toLocaleDateString();
                        }
                    },
                    {data: "operator.name", name: "operator.name"},
                    {data: "customer.name", name: "customer.name"},
                    {data: "request_type.name", name: "requestType.name"},
                    {data: "meter_qty", name: "meter_qty"},
                    {data: "upi", name: "upi"},
                    {
                        data: "status", name: "status",
                        render: function (data, type, row) {
                            return `<span class="badge badge-${row.status_color} rounded-pill">${data}</span>`;
                        },
                    },
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
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

            $('#legal_type_id').on('change', function () {
                getDocumentTypes($(this).val());
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
