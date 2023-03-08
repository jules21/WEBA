<div class="card card-body mb-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Meter Numbers</h6>
        @if($request->canAssignMeterNumber())
            <button type="button" class="btn btn-sm btn-primary" id="addMeterBtn">
                <i class="flaticon2-plus-1"></i>
                Add New
            </button>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-head-custom table-head-solid table-hover">
            <thead>
            <tr>
                <th>Subscription Number</th>
                <th>Meter Number></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($request->meterNumbers as $item)
                <tr>
                    <td>{{ $item->subscription_number }}</td>
                    <td>{{ $item->meter_number }}</td>
                    <td>
                        <button type="button"
                                data-id="{{ $item->id }}"
                                data-subscription_number="{{ $item->subscription_number }}"
                                data-meter_number="{{ $item->meter_number }}"
                                class="btn btn-sm btn-light-primary rounded-circle btn-icon mr-2"
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
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No meter numbers yet</td>
                </tr>
            @endforelse
            </tbody>
        </table>


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
                    <input type="hidden" value="0" id="tech_id" name="id"/>
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
