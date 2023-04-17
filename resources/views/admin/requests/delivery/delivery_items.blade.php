@extends('layouts.master')
@section('title',"Delivery Items")

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none mb-4" id="kt_subheader">
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
                        <a href="{{ route('admin.requests.delivery-request.index',encryptId($request->id)) }}"
                           class="text-muted">
                            Item Delivery
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                          Items
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
                <a href="{{ route('admin.requests.print-delivery',encryptId($delivery->id)) }}" target="_blank"
                   class="btn btn-light-success rounded-sm btn-sm font-weight-bolder">
                    <i class="la la-print"></i>
                    Print Delivery Note
                </a>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>

    <div class="card tw-shadow-sm border tw-border-gray-300">
        <div class="card-body">
            <div class="mb-3">
                <div class="font-weight-bolder">
                    Customer Name:
                </div>
                <div>
                    {{ $request->customer->name }}
                </div>
            </div>

            <div class="mb-3">
                <div class="font-weight-bolder">
                    Customer Phone:
                </div>
                <div>
                    {{ $request->customer->phone }}
                </div>
            </div>

            <div class="table-responsive my-4">
                <table class="table table-head-custom table-head-solid">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delivery->details->where('quantity','>',0) as $item)
                        <tr>
                            <td>{{ $item->requestItem->item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->requestItem->unit_price) }}</td>
                            <td>{{  number_format($item->total ) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-weight-bold">Total</td>
                        <td class="font-weight-bold">{{ number_format($delivery->details->sum('total')) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mb-3">
                <div class="font-weight-bolder">
                    Delivered By Name:
                </div>
                <div>
                    {{ $delivery->delivered_by_name }}
                </div>
            </div>

            <div class="mb-3">
                <div class="font-weight-bolder">
                    Delivered By Phone:
                </div>
                <div>
                    {{ $delivery->delivered_by_phone }}
                </div>
            </div>

            <div class=" card-body mt-4 card border-success rounded-0" style="border-style: dashed;border-width: 2px;">
                <h4 class="mb-4">
                    Signed Delivery Note
                </h4>
                @if($delivery->delivery_note)
                    <a href="{{ $delivery->deliver_note_url }}" target="_blank"
                       class="btn btn-light-success align-self-start rounded-sm">
                       <span class="svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-download"
                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4"></path>
                            <path d="M12 13l0 9"></path>
                            <path d="M9 19l3 3l3 -3"></path>
                        </svg>
                       </span>
                        Download Delivery Note
                    </a>
                @elseif(auth()->user()->can(\App\Constants\Permission::ManageItemDelivery))
                    <form action="{{ route('admin.requests.upload-delivery-note',encryptId($delivery->id)) }}"
                          enctype="multipart/form-data" method="post" id="uploadDeliveryForm">
                        @csrf
                        <div class="form-group">
                            <label for="delivery_note">
                                Delivery Note
                            </label>

                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Please upload signed delivery note, this must be a pdf file or image file.
                            </small>
                            <div class="d-flex flex-column flex-md-row align-items-md-center w-100">
                                <div class="custom-file w-md-500px">
                                    <input type="file" class="custom-file-input" id="delivery_note"
                                           name="delivery_note"/>
                                    <label class="custom-file-label" for="delivery_note">
                                        Choose signed delivery note
                                    </label>
                                </div>
                                <button
                                    class="btn btn-light-primary w-md-250px font-weight-bold ml-md-3 mt-3 mt-md-0 rounded-ms"
                                    type="submit">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-cloud-upload" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                           <path
                                               d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path>
                                           <path d="M9 15l3 -3l3 3"></path>
                                           <path d="M12 12l0 9"></path>
                                        </svg>
                                </span>
                                    Upload Delivery Note
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateUploadDeliveryNote::class) !!}
    <script>
        $(function () {
            $('#uploadDeliveryForm').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                if (!form.valid())
                    return false;

                let formData = new FormData(this);
                let btn = form.find('button[type="submit"]');
                btn.addClass('spinner spinner-white spinner-right');
                btn.prop('disabled', true);
                e.target.submit();
            });
        });
    </script>
@endsection
