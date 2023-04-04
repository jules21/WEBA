@extends('layouts.master')

@section('title','Stock In')

@section('content')
    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none mb-4" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    New Stock In
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
                            Stock In
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


    <div class="card tw-shadow-sm border tw-border-gray-300">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    @if(isset($purchase))
                        Edit
                    @else
                        New
                    @endif

                    Stock In
                </h4>

                <a href="{{ route("admin.purchases.index") }}" class="btn btn-light-primary btn-sm" id="addButton">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                        </svg>
                       </span>
                    Go Back
                </a>
            </div>

            <form
                action="{{ isset($purchase)?route('admin.purchases.update',encryptId($purchase->id)): route('admin.purchases.store') }}"
                method="post" class="mt-4" id="submitForm">
                @csrf

                @if(isset($purchase))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="supplier_id">
                                Supplier
                            </label>
                            <select name="supplier_id" id="supplier_id" class="form-control select2" required
                                    style="width: 100%!important;">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ $supplier->id == (isset($purchase)?$purchase->supplier_id:'')?'selected':'' }}>
                                        {{ $supplier->name }} - {{ $supplier->phone_number }}
                                    </option>
                                @endforeach
                            </select>
                            <label id="supplier_id-error" class="error" for="supplier_id"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive rounded border  mb-3">
                            <table class="table  table-hea table-head-custom " id="itemsTable">
                                <thead>
                                <tr>
                                    <th style="width: 40%;">Item</th>
                                    <th>Qty</th>
                                    <th>VAT({{ config('services.VAT_RATE') }}%)</th>
                                    <th>Unit Price</th>
                                    <th>VAT Amount</th>
                                    <th>Total</th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($purchase))
                                    @foreach($purchase->movementDetails as $item)
                                        <tr>
                                            <td>
                                                <select name="items[]" class="form-control select2" required
                                                        style="width: 100%!important;">
                                                    <option value="">Select Item</option>
                                                    @foreach($items as $it)
                                                        <option value="{{ $it->id }}"
                                                                {{ $it->id== $item->item_id ?'selected':'' }}
                                                                data-price="{{ $it->selling_price }}"
                                                                data-vat="{{ $it->vat_rate }}"
                                                        >
                                                            {{ $it->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label id="items[]-error" class="error" for="items[]"
                                                       style="display: none;"></label>
                                            </td>
                                            <td>
                                                <input type="number" value="{{ $item->quantity }}" min="0.1"
                                                       required name="quantities[]"
                                                       class="form-control w-80px"/>
                                                <label id="quantities[]-error" class="error" for="quantities[]"
                                                       style="display: none;"></label>
                                            </td>
                                            <td>
                                                <input type="hidden" value="{{ $item->vat??0 }}" name="vat_values[]"/>
                                                <label class="checkbox">
                                                    <input type="checkbox" value="{{ config('services.VAT_RATE') }}"
                                                           {{ $item->vat!=0?"checked":"" }} name="vats[]"/>
                                                    <span class="rounded-0 mr-2"></span>
                                                    VAT
                                                </label>
                                                <label id="vats[]-error" class="error" for="vats[]"
                                                       style="display: none;"></label>
                                            </td>
                                            <td>
                                                <input type="number" value="{{ $item->unit_price }}" min="1"
                                                       required name="prices[]"
                                                       class="form-control w-120px"/>
                                                <label id="prices[]-error" class="error" for="prices[]"
                                                       style="display: none;"></label>
                                            </td>
                                            <td>
                                                <span class="vat_total">
                                                    {{ number_format($item->vatAmount) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="total">
                                                    {{ number_format($item->total) }}
                                                </span>
                                            </td>

                                            <td>
                                                <button type="button"
                                                        class="btn btn-sm btn-light-danger btn-icon font-weight-bold rounded-circle js-delete">
                                                    <i class="flaticon2-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-sm btn-light-primary font-weight-bold" id="btnAddNew">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                    </svg>
                    Add Item
                </button>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="form-group mt-4">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="3"
                                      class="form-control">{{ isset($purchase)?$purchase->description:'' }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <h4 class="my-3">
                            Summary:
                        </h4>
                        <ul class="list-group rounded">
                            {{--   <li class="list-group-item d-flex justify-content-between align-items-center">
                                   <span class="font-weight-bolder">SUBTOTAL</span>
                                   <span class="font-weight-bolder"><span id="sub_total">RWF 0.00</span></span>
                               </li>--}}
                            <li class="list-group-item" id="tax_list_item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bolder" id="tax_label_span">Total VAT</span>
                                    <span class="font-weight-bolder"><span id="includes_vat">RWF 0.00</span></span>
                                </div>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="font-weight-bolder">TOTAL</span>
                                <span class="font-weight-bolder"><span id="grand_total">RWF 0.00</span></span>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="tax_amount" id="tax_amount_input">
                    <input type="hidden" name="grand_total" id="grand_total_input">
                </div>

                <button type="submit" class="btn btn-primary font-weight-bold float-right mt-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M9 12l2 2l4 -4"></path>
                    </svg>
                    Submit Stock In
                </button>

            </form>

        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

    <script>

        let items = @json($items);

        // console.log(items);

        function addItem() {
            let tbody = $('#itemsTable tbody');
            // create a select element
            let select = $('<select required></select>');
            select.attr('name', 'items[]');
            select.addClass('form-control select2');
            select.css('width', '100% !important');
            select.append('<option value="">select</option>');
            // add required attribute
            select.attr('required', true);
            $.each(items, function (index, item) {
                select.append(`
                    <option
                        data-price="${item.price}"
                        data-vat="${item.vat_rate}"
                        value="${item.id}">
                        ${item.name}
                    </option>
                `);
            });

            // create a td element
            let td = $('<td></td>');
            td.append(select);
            td.append(`<label id="items[]-error" class="error" for="items[]" style="display: none;"></label>`);

            // create a tr element
            let tr = $('<tr></tr>');
            tr.append(td);

            // create a td element
            td = $('<td></td>');
            td.append('<input type="number" min="0.1"  required name="quantities[]" class="form-control w-80px"/>');
            td.append(`<label id="quantities[]-error" class="error" for="quantities[]" style="display: none;"></label>`);
            // append td to tr
            tr.append(td);

            // create a td element
            td = $('<td></td>');
            td.append(`
                    <input type="hidden" value="0" name="vat_values[]"/>
                    <label class="checkbox">
                            <input type="checkbox" value="{{ config('services.VAT_RATE') }}"  name="vats[]">
                            <span class="rounded-0 mr-2"></span>
                            VAT
                       </label>`);
            td.append(`<label id="vats[]-error" class="error" for="vats[]" style="display: none;"></label>`);

            // append td to tr
            tr.append(td);

            // create a td element
            td = $('<td></td>');
            td.append('<input type="number" min="1"  required name="prices[]" class="form-control  w-120px"/>');
            td.append(`<label id="prices[]-error" class="error" for="prices[]" style="display: none;"></label>`);

            // append td to tr
            tr.append(td);

            // create a td element
            td = $('<td></td>');
            td.append('<span class="vat_total"></span>');
            // append td to tr
            tr.append(td);

            // create a td element
            td = $('<td></td>');
            td.append('<span class="total"></span>');
            // append td to tr
            tr.append(td);


            // create a td element
            td = $('<td></td>');
            td.append('<button class="btn btn-icon btn-light-danger btn-sm rounded-circle js-delete">\n' +
                '                                            <i class="flaticon2-trash"></i>\n' +
                '                                        </button>');

            // append td to tr
            tr.append(td);

            // append tr to tbody
            tbody.append(tr);

            // initialize select2
            $('.select2').select2();
        }

        function hasDuplicatesItems(form) {
            let itemElements = $(form).find('select[name="items[]"]');
            let itemIds = [];
            itemElements.each(function (index, itemElement) {
                let itemId = $(itemElement).val();
                if (itemId !== '') {
                    itemIds.push(Number(itemId));
                }
            });

            // select all duplicates in itemIds
            itemIds = itemIds.filter((item, index) => itemIds.indexOf(item) !== index);
            // select all items with given itemIds
            if (itemIds.length > 0) {
                let duplicatedItems = items.filter(item => itemIds.includes(item.id));
                let itemNames = duplicatedItems.map(item => item.name);
                let message = 'The following items are duplicated: ' + itemNames.join(', ');
                Swal.fire({
                    title: 'Error!',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
                return true;
            }
            return false;
        }

        $(function () {
            $('.nav-purchases').addClass('menu-item-active menu-item-open');
            $('.nav-create-purchase').addClass('menu-item-active');
            $('body').addClass('aside-minimize');
            let $form = $('#submitForm');
            $form.validate();

            $('#btnAddNew').on('click', function () {
                addItem();
            });


            // initialize delete button
            $(document).on('click', '.js-delete', function () {
                $(this).closest('tr').remove();
                calculateTotal();
            });

            $(document).on('input', 'input[name="quantities[]"], input[name="prices[]"], input[name="vats[]"]', function () {
                calculateTotal();
            });

            $(document).on('change', 'select[name="items[]"]', function () {
                let itemElement = $(this);
                let itemId = itemElement.val();
                let item = items.find(item => item.id === parseInt(itemId));
                let tr = itemElement.closest('tr');
                // tr.find('input[name="prices[]"]').val(item.selling_price);
                let vatElement = tr.find('select[name="vats[]"]');
                vatElement.empty();
                vatElement.append(`<option value="${item.vat_rate}">VAT (${item.vat_rate}%)</option>`);
                vatElement.append(`<option value="0">NO VAT (0%)</option>`);

                calculateTotal();
            });

            $form.on('submit', function (e) {
                e.preventDefault();
                if (!$form.valid()) {
                    return;
                }

                if (hasDuplicatesItems(this))
                    return;


                let $btn = $(this).find('[type="submit"]');

                $btn.addClass('spinner spinner-right spinner-white pr-15').attr('disabled', true);

                e.target.submit();

            });


            @if(!isset($purchase))
            addItem();
            @else
            calculateTotal();
            @endif

        });

        function calculateTotal() {
            let tax = 0;
            let total = 0;
            $('#itemsTable tbody tr').each(function () {
                let itemElement = $(this).find('select[name="items[]"]');

                let itemId = itemElement.val();
                let quantity = $(this).find('input[name="quantities[]"]').val();
                let unit_price = $(this).find('input[name="prices[]"]').val();
                let vatElement = $(this).find('input[name="vats[]"]');
                let vat = vatElement.val();

                let item = items.find(item => item.id === parseInt(itemId));

                if (quantity && unit_price) {
                    let total_price = quantity * unit_price;
                    $(this).find('.total').text(total_price.toLocaleString());
                    let currentVat = 0;
                    let $vatValue = $(this).find('input[name="vat_values[]"]');
                    if (vatElement.prop('checked')) {
                        $vatValue.val(vat);
                        let basePrice = total_price / (1 + (vat / 100));
                        currentVat = total_price - basePrice;
                        tax += currentVat;
                    } else {
                        $vatValue.val(0);
                    }
                    total += total_price;
                    $(this).find('.vat_total').text(currentVat.toLocaleString("en-US", {
                        style: "currency",
                        currency: "RWF"
                    }));
                }
            });
            // $('#sub_total').text(total.toLocaleString("en-US", {style: "currency", currency: "RWF"}));
            $('#includes_vat').text(tax.toLocaleString("en-US", {style: "currency", currency: "RWF"}));
            $('#grand_total').text(total.toLocaleString("en-US", {style: "currency", currency: "RWF"}));

            // $('#sub_total_input').val(total);
            $('#tax_amount_input').val(tax);
            $('#grand_total_input').val(total);
        }

    </script>
@endsection
