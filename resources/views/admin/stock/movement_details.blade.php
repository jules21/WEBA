@extends('layouts.master')
@section('title',"Stock movement details")

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Details
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
                        <a href="{{ route('admin.stock.stock-items.movements') }}" class="text-muted">
                            Stock Movements
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            Details
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
              <span class="badge badge-info rounded-pill">
                  {{ $movement->type }}
              </span>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>



    <div class="card card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <strong class="d-block">Operator:</strong>
                        <input readonly value=" {{ optional(optional($movement->operationArea)->operator)->name }}" class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        <strong class="d-block">Operation Area:</strong>
                        <input readonly value=" {{ $movement->operationArea->name }}" class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        <strong class="d-block">Total Items:</strong>
                        <input readonly value=" {{ $movement->details->count() }}" class="form-control-plaintext"/>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <strong class="d-block">Quantity In:</strong>
                        <input readonly value=" {{ $movement->qty_in }}" class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        <strong class="d-block">Quantity Out:</strong>
                        <input readonly value=" {{ $movement->qty_out }}" class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        <strong class="d-block">Creation Date:</strong>
                        <input readonly value=" {{ $movement->created_at }}" class="form-control-plaintext"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <strong class="d-block">Description:</strong>
                        <p readonly class="form-control-plaintext">{{ $movement->description }}</p>
                    </div>
                </div>

                <h6>
                    Items
                </h6>

                <table class="table table-head-custom table-head-solid border">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity In</th>
                        <th>Quantity Out</th>
                        <th>Unit Price</th>
{{--                        <th>Sub Total</th>--}}
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-weight-bolder">Sub Total:</td>
                        <td>{{ number_format($movement->subtotal) }}</td>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($movement->movements as $item)
                        <tr>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->qty_in }}</td>
                            <td>{{ $item->qty_out }}</td>
                            <td>{{ number_format($item->unit_price) }}</td>
{{--                            <td>{{ number_format($item->total) }}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                {{--                review form--}}

                @if( $movement->canBeReviewed())

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h4 class="text-center my-4">
                                Review
                            </h4>

                            <form action="{{ route("admin.purchases.submit-review",encryptId($movement->id)) }}"
                                  method="post" id="formSaveReview">
                                @csrf
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Mark Purchase As</option>
                                        @foreach($movement->getApprovalStatuses() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class=" form-group">
                                    <label for="comment">Description:</label>
                                    <textarea name="comment" id="comment" rows="5"
                                              class="form-control"></textarea>
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="svg-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-circle-check" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                                 fill="none" stroke-linecap="round"
                                                 stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                               <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                        </span>
                                        Submit Review
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                @endif


    </div>

@endsection
