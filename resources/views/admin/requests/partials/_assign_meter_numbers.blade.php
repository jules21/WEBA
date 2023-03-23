<div class="card card-body mb-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Meter Numbers</h6>
        @if($request->canAssignMeterNumber())
            <button type="button" class="btn btn-sm btn-primary" id="addMeterBtn">
                <i class="flaticon2-plus"></i>
                Add New
            </button>
        @endif
    </div>

    <div class="table-responsive">
        @if($request->meterNumbers->isEmpty())
            <div class="alert alert-light-info alert-custom mb-0">
                No meter numbers assigned yet.
            </div>
        @else
            <table class="table table-head-custom table-head-solid table-hover">
                <thead>
                <tr>
                    <th>Subscription Number</th>
                    <th>Meter Number</th>
                    <th>Category</th>
                    <th>Item</th>
                    @if($request->canAssignMeterNumber())
                        <th>Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @forelse($request->meterNumbers as $item)
                    <tr>
                        <td>{{ $item->subscription_number }}</td>
                        <td>{{ $item->meter_number }}</td>
                        <td>{{ $item->itemCategory->name }}</td>
                        <td>{{ $item->item->name }}</td>
                        @if($request->canAssignMeterNumber())
                            <td>
                                <button type="button"
                                        data-id="{{ $item->id }}"
                                        data-item_category_id="{{ $item->item_category_id }}"
                                        data-item_id="{{ $item->item_id }}"
                                        data-subscription_number="{{ $item->subscription_number }}"
                                        data-meter_number="{{ $item->meter_number }}"
                                        data-last_index="{{ $item->last_index }}"
                                        class="btn btn-sm btn-light-primary rounded-circle btn-icon mr-2 js-edit-meter"
                                        title="Edit details">
                                    <i class="flaticon2-edit"></i>
                                </button>
                                <button type="button"
                                        data-href="{{ route('admin.requests.meter-number.destroy',encryptId($item->id)) }}"
                                        class="btn btn-sm  rounded-circle btn-icon btn-light-danger js-delete"
                                        title="Delete">
                                    <i class="flaticon2-trash"></i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        @endif


    </div>
</div>


{{--    add technician modal--}}

<div class="modal fade" tabindex="-1" id="addMeterModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>
                    Meter Number
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <form action="{{ route('admin.requests.assign-meter-number',encryptId($request->id)) }}" method="post"
                  id="saveMeterForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="0" name="id" id="meter_id"/>

                    <div class="form-group">
                        <label for="category_id">
                            Meter Category
                        </label>
                        <select name="item_category_id" id="category_id" class="form-control  select2"
                                style="width: 100%!important;">
                            <option value="">Select Category</option>
                            @foreach($itemCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="item_meter_id">
                            Meter
                        </label>
                        <select name="item_id" id="item_meter_id" class="form-control select2"
                                style="width: 100%!important;">
                            <option value="">Select Meter</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="meter_number">Meter Number</label>
                        <input type="text" name="meter_number" id="meter_number" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="last_index">Last Index</label>
                        <input type="number" step="0.1" name="last_index" id="last_index" class="form-control"/>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
