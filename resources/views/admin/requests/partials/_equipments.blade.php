<div class="mb-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Materials</h5>
        @if($request->canAddMaterials())
            <button type="button" class="btn btn-sm rounded btn-light-primary" id="addBtn">
                <i class="flaticon2-add-1"></i>
                Add New
            </button>
        @endif

    </div>
    <div class="table-responsive border rounded">
        <table class="table table-head-solid table-head-custom">
            <thead>
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                @if($request->canAddMaterials())
                    <th></th>
                @endif

            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right font-weight-bold">Total:</td>
                <td class="font-weight-bolder">
                    RWF
                    <span id="total">{{ number_format($requestItems->sum('total')) }}</span>
                </td>
                @if($request->canAddMaterials())
                    <td></td>
            @endif
            </tfoot>
            <tbody>

            @forelse($requestItems as $item)
                <tr>
                    <td>{{ $item->item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price) }}</td>
                    <td>RWF {{ number_format($item->total) }}</td>
                    @if($request->canAddMaterials())
                        <td>
                            <button
                                data-id="{{ $item->id }}"
                                data-quantity="{{ $item->quantity }}"
                                data-unit_price="{{ $item->unit_price }}"
                                data-item_id="{{ $item->item_id }}"
                                class="btn btn-sm btn-light-primary btn-icon rounded-circle js-edit">
                                <i class="flaticon2-edit"></i>
                            </button>
                            <button type="button"
                                    data-href="{{ route('admin.requests.delete-request-item',[encryptId($request->id),encryptId($item->id)]) }}"
                                    class="btn btn-sm btn-light-danger btn-icon rounded-circle js-delete">
                                <i class="flaticon2-trash"></i>
                            </button>
                        </td>
                    @endif
                </tr>

            @empty
                {{--     <tr>
                         <td colspan="5">
                             <div class="alert alert-light-info alert-custom py-1">
                                 <div class="alert-icon">
                                     <i class="flaticon2-exclamation"></i>
                                 </div>
                                 <div class="alert-text">
                                     No items found, please add some items.
                                 </div>
                             </div>
                         </td>
                     </tr>--}}
            @endforelse

            </tbody>
        </table>
    </div>

</div>
