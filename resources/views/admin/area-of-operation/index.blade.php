@extends('layouts.master')

@section('title', 'Area of Operation')


@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Operation Areas
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
                        <a href="{{ route('admin.operator.index') }}" class="text-muted">
                            Operators
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Operation Areas</span>
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
                    {{ $operator->name }} 's Operation Areas
                </h4>

                <buttont type="button" class="btn btn-light-primary rounded font-weight-bolder btn-sm" id="addButton">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
</svg>

                       </span>
                    Add New Area
                </buttont>
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border table-head-solid table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>District</th>
                        <th>Contact Name</th>
                        <th>Contact Phone</th>
                        <th>Contact Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Operation Area
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.operator.area-of-operation.store',encryptId($operator->id)) }}"
                      method="post" id="formSave">
                    @csrf
                    <input type="hidden" value="0" id="id" name="id"/>
                    <input type="hidden" id="license_number" name="license_number"/>
                    <input type="hidden" id="valid_from" name="valid_from"/>
                    <input type="hidden" id="valid_to" name="valid_to"/>
                    <input type="hidden" id="valid_to" name="valid_to"/>
                    <input type="hidden" value="Active" id="status" name="status"/>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="district_id">District</label>
                            <select name="district_id" id="district_id" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select District</option>
                                {{-- @foreach($districts as $district)
                                     <option value="{{ $district->id }}">{{ $district->name }}</option>
                                 @endforeach--}}
                            </select>
                            {{--                            <span id="district_id-error" class="invalid-feedback"></span>--}}
                        </div>
                        <div class="card card-body border-primary border-2 mb-3 p-2 rounded-0"
                             style="border-style: dotted !important;display: none" id="resultsContent">
                            <div class="font-weight-bold" id="licenseName"></div>
                            <div>
                                Validity From: <span id="validityFrom"></span> To: <span id="validityTo"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="contact_person_name">
                                Contact Person Name
                            </label>
                            <input type="text" name="contact_person_name" id="contact_person_name"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="contact_person_phone">
                                Contact Person Phone
                            </label>
                            <input type="text" name="contact_person_phone" id="contact_person_phone"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="contact_person_email">
                                Contact Person Email
                            </label>
                            <input type="text" name="contact_person_email" id="contact_person_email"
                                   class="form-control"/>
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
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\StoreOperationAreaRequest::class) !!}

    <script>


        $(document).ready(function () {
            $('.nav-operation-areas').addClass('menu-item-active');
            // $('.nav-operators').addClass('menu-item-active');

            let $licences = [];
            let isSubmitting = false;

            $('#addButton').on('click', function () {
                if (isSubmitting) return;
                $('#id').val(0);
                let $districtId = $('#district_id');
                $districtId.attr('disabled', false);
                $districtId.parent('.form-group').removeClass('d-none');

                isSubmitting = true;
                let $btn = $(this);
                $btn.prop('disabled', true);
                $btn.addClass('spinner spinner-white spinner-right');

                $.ajax({
                    url: "{{ route('admin.operator.get-area-of-operations',encryptId($operator->clms_id)) }}?op_id={{encryptId($operator->id)}}",
                    type: 'GET',
                    success: function (response) {
                        $licences = response;
                        let $district_id = $('#district_id');
                        let districts = response
                            .flatMap(function (item) {
                                return item.area_of_operations
                                    .map(function (newItem) {
                                        console.log(newItem);
                                        return {
                                            id: newItem.district_id,
                                            name: newItem.district_name,
                                            doc_number: item.doc_number
                                        };
                                    })
                            });

                        $district_id.empty();
                        $district_id.append('<option value="">Select District</option>');
                        $.each(districts, function (key, value) {
                            $district_id.append(`<option value="${value.id}">${value.name} - ${value.doc_number}</option>`);
                        });
                        $district_id.trigger('change');

                        $('#addModal').modal();
                    },
                    error: function (response) {
                        let message = response?.responseJSON?.message ?? 'Unable to fetch area of operations, please try again later';
                        let status = response?.status;
                        Swal.fire({
                            icon: Number(status) === 422 ? "warning" : "error",
                            title: Number(status) === 422 ? "Oops" : "Error",
                            text: message,
                        });
                    },
                    complete: function () {
                        $btn.prop('disabled', false);
                        $btn.removeClass('spinner spinner-white spinner-right');
                        isSubmitting = false;
                    }
                });
            });

            $('#district_id').on('change', function () {
                let $district_id = $(this).val();
                let $resultsContent = $('#resultsContent');

                $resultsContent.slideUp();

                let $license = $licences.find(function (item) {
                    return item.area_of_operations.find(function (item) {
                        return item.district_id == $district_id;
                    })
                });
                if ($license) {
                    $('#licenseName').text($license.license_name);
                    $('#validityFrom').text((new Date($license.valid_from)).toLocaleDateString());
                    $('#validityTo').text((new Date($license.valid_to)).toLocaleDateString());
                    $resultsContent.slideDown();
                } else {
                    $('#licenseName').text('');
                    $('#validityFrom').text('');
                    $('#validityTo').text('');
                    $resultsContent.slideUp();
                }
            });

            let dataTable = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.operator.area-of-operation.index',encryptId($operator->id)) }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'district.name', name: 'district.name'},
                    {data: 'contact_person_name', name: 'contact_person_name'},
                    {data: 'contact_person_phone', name: 'contact_person_phone'},
                    {data: 'contact_person_email', name: 'contact_person_email'},
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


            $('#formSave').on('submit', function (e) {
                e.preventDefault();

                if (!$(this).valid() || isSubmitting) {
                    return;
                }

                let btn = $(this).find('button[type="submit"]');
                btn.prop('disabled', true)
                    .addClass('spinner spinner-white spinner-right disabled');

                isSubmitting = true;

                let settings = {
                    "url": $(this).attr('action'),
                    "method": $(this).attr('method'),
                    "data": $(this).serialize(),
                    success: function (response) {
                        $('#addModal').modal('hide');
                        $('#formSave')[0].reset();
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
                        btn.prop('disabled', false)
                            .removeClass('spinner spinner-white spinner-right disabled');
                        isSubmitting = false;
                    }
                };
                $.ajax(settings);
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
                        let $districtId = $('#district_id');
                        $districtId.val(data.district_id);
                        $districtId.trigger('change');
                        $districtId.attr('disabled', true);
                        let $resultsContent = $('#resultsContent');
                        $resultsContent.slideUp();
                        /// find $districtId parent .form-group and add .d-none class
                        $districtId.parent('.form-group').addClass('d-none');


                        $('#contact_person_name').val(data.contact_person_name);
                        $('#contact_person_phone').val(data.contact_person_phone);
                        $('#contact_person_email').val(data.contact_person_email);
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
                            },
                            error: function (response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong! Unable to delete this record',
                                });
                            }
                        })
                    }
                });

            });
        });
    </script>
@endsection

