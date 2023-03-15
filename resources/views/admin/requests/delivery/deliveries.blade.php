@extends('layouts.master')

@section('title', 'Delivery Requests')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Deliveries
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
                        <a href="{{ route('admin.requests.to-be-delivered') }}" class="text-muted">
                            Manage Item Delivery
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                          Deliveries
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
              <span class="badge badge-{{$request->status_color}} rounded-pill">
                  {{ $request->status }}
              </span>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>

    <div class="card card-body">


        <div class="d-flex justify-content-between align-items-center">
            <h4>Deliveries</h4>
            <button type="button" class="btn btn-light-primary btn-sm font-weight-bolder" id="addDelivery">
                <i class="flaticon2-plus"></i>
                New Delivery
            </button>
        </div>
        <div class="separator separator-dashed my-8"></div>


        <div class="table-responsive my-3">
            <table class="table table-head-custom border table-head-solid table-hover dataTable">
                <thead>
                <tr>
                    <th>Delivery Date</th>
                    <th>Delivered QTY</th>
                    <th>Collected Name</th>
                    <th>Collected Phone</th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="deliveryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        New Delivery
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    @if($items->count()>0)
                        <h6>Material Items to be delivered</h6>
                        <div class="table-responsive my-3">
                            <table class="table table-head-custom border table-head-solid">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>ALREADY DELIVERED</th>
                                    <th>REMAINING</th>
                                    <th>TO BE DELIVERED</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            <input type="number" class="form-control w-100px"
                                                   value="{{ $item->quantity }}"/>
                                        </td>
                                        <th>
                                            <button type="button"
                                                    class="btn btn-sm btn-light-danger btn-circle btn-icon font-weight-bolder js-delete">
                                                <i class="flaticon2-trash"></i>
                                            </button>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endif
                    @if($meterNumbers->count()>0)
                        <h6>
                            Meters to be delivered
                        </h6>
                        <div class="table-responsive my-3">
                            <table class="table table-head-custom border table-head-solid">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>ALREADY DELIVERED</th>
                                    <th>REMAINING</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($meterNumbers as $item)
                                    <tr>
                                        <td>{{ $item->item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <th>
                                            <button type="button"
                                                    class="btn btn-sm btn-light-danger btn-circle btn-icon font-weight-bolder js-delete">
                                                <i class="flaticon2-trash"></i>
                                            </button>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-check-circle"></i>
                        Save changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script>


        $(document).ready(function () {
            $('.nav-item-delivery').addClass('menu-item-active');

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {
                        data: "delivery_date", name: "delivery_date",
                        render: function (data, type, row) {
                            return (new Date(data)).toLocaleDateString();
                        }
                    },
                    {data: "delivered_by_name", name: "delivered_by_name"},
                    {data: "delivered_by_phone", name: "delivered_by_phone"},
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
            });

            $('#addDelivery').on('click', function () {
                $('#deliveryModal').modal('show');
            });

            $('.js-delete').on('click', function () {
                $(this).closest('tr').remove();
            });


        });
    </script>

@endsection
