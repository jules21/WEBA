@extends('layouts.master')
@section('title', 'Clusters')

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Clusters
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
                        <span class="text-muted">Clusters</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

@endsection

@section('content')
    <div class="card shadow-none border">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    Manage Clusters
                </h4>

                <buttont type="button" class="btn btn-light-primary rounded font-weight-bolder btn-sm" id="addButton">
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
                        <th>Created At</th>
                        <th>Name</th>
                        <th>Expiration Date</th>
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
                    <h5 class="modal-title">
                        Cluster
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.cluster.store') }}" autocomplete="off"
                      method="post" id="formSave">
                    @csrf
                    <input type="hidden" value="0" id="id" name="id"/>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="expiration_date">Expiration Date</label>
                            <input type="text" name="expiration_date" id="expiration_date"
                                   class="form-control datepicker w-100"/>
                        </div>


                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary btn-sm ">Save Changes</button>
                        <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js') }}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreClusterRequest::class, '#formSave') !!}

    <script>
        $(function () {

            $('#addButton').click(function () {
                $('#addModal').modal('show');
            });

            let dataTable = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.clusters') }}",
                columns: [
                    {
                        data: 'created_at', name: 'created_at',
                        render: function (data, type, row) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                    {data: 'name', name: 'name'},
                    {
                        data: 'expiration_date', name: 'expiration_date',
                        render: function (data, type, row) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#formSave').submit(function (e) {
                e.preventDefault();
                let form = $(this);

                if (!form.valid()) {
                    return;
                }

                let url = form.attr('action');
                let method = form.attr('method');
                let data = form.serialize();

                let submitButton = form.find('[type="submit"]');
                submitButton.prop('disabled', true);
                submitButton.addClass('spinner spinner-white spinner-right');

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        $('#addModal').modal('hide');
                        form.trigger('reset');
                        dataTable.ajax.reload();
                    },
                    complete: function () {
                        submitButton.prop('disabled', false);
                        submitButton.removeClass('spinner spinner-white spinner-right');
                    },
                    error: function (reason) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: reason?.responseJSON?.message ?? "Something went wrong!, Please try again later.",
                        })
                    }
                })
            });

            $(document).on('click', '.js-edit', function () {
                let id = $(this).data('id');

                $('#id').val(id);
                $('#name').val($(this).data('name'));
                $('#expiration_date').val($(this).data('expiration_date'));
                $('#addModal').modal('show');

            });

            $(document).on('click', '.js-delete', function (e) {
                e.preventDefault();
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this cluster!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            url: $(this).attr('href'),
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Cluster has been deleted.',
                                    'success'
                                );
                                dataTable.ajax.reload();
                            },
                            error: function (reason) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: reason?.responseJSON?.message ?? "Something went wrong!, Please try again later.",
                                })
                            }
                        });
                    }
                });
            });

        });


    </script>
@endsection
