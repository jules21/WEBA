@extends('layouts.master')

@section('title','New Purchase')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    New Purchase
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
                        <a href="{{ route('admin.purchases.index') }}" class="text-muted">
                            Purchases
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            Create
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="card shadow-none">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    Create New Purchase
                </h4>

                <a href="" class="btn btn-light-primary btn-sm" id="addButton">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
</svg>
                       </span>
                    Go Back To Purchases
                </a>
            </div>

            <form action="" class="mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="supplier_id">
                                Supplier
                            </label>
                            <select name="supplier_id" id="supplier_id" class="form-control select2"
                                    style="width: 100%!important;">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">
                                        {{ $supplier->name }} - {{ $supplier->phone_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-">
                            <table class="table table-head-solid table-head-custom border" id="itemsTable">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>VAT</th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <select name="items[]" id="" class="form-control select2"
                                                    style="width: 100% !important;">
                                                <option value="">select</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="quantities[]" class="form-control w-150px"/>
                                    </td>
                                    <td>
                                        <input type="number" name="unit_prices[]" class="form-control w-150px"/>
                                    </td>
                                    <td>
                                        <span class="total"></span>
                                    </td>
                                    <td>
                                        <select name="vats[]" id="" class="form-control">
                                            <option value="1">VAT</option>
                                            <option value="0">NO VAT</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-icon btn-light-danger rounded-circle js-delete">
                                            <i class="flaticon2-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <button class="btn btn-sm btn-primary font-weight-bold" id="btnAddNew">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Add Item
                        </button>
                    </div>
                    <div class="col-lg-5">
                        <ul class="list-group rounded">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bolder">SUBTOTAL</span>
                                <span class="font-weight-bolder"><span id="total_span">0.00 RWF</span></span>
                            </li>
                            <li class="list-group-item" id="tax_list_item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bolder" id="tax_label_span">Includes VAT on 0.00 RWF</span>
                                    <span class="font-weight-bolder"><span id="tax_span">0.00 RWF</span></span>
                                </div>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bolder">TOTAL</span>
                                <span class="font-weight-bolder"><span id="total_net_span">0.00 RWF</span></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bolder">BALANCE DUE</span>
                                <span class="font-weight-bolder"><span id="total_amount_due">0.00 RWF</span></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary font-weight-bold float-right mt-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M9 12l2 2l4 -4"></path>
                    </svg>
                    Submit Purchase
                </button>

            </form>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $('.nav-purchases').addClass('menu-item-active menu-item-open');
            $('.nav-create-purchase').addClass('menu-item-active');

            $('#btnAddNew').on('click', function () {

            });

        });
    </script>
@endsection
