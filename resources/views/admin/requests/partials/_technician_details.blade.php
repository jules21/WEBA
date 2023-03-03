@if($technician)
    <div class="card card-body ">
        <h6 class="mb-3">
            Technician Details
        </h6>

        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">Name:</label>
                    <div class="form-control-plaintext">
                        {{ $technician->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">Phone Number:</label>
                    <div class="form-control-plaintext">
                        {{ $technician->phone_number }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">Address:</label>
                    <div class="form-control-plaintext">
                        {{ $technician->address }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <button
                data-id="{{ $technician->id }}"
                data-name="{{ $technician->name }}"
                data-phone="{{ $technician->phone_number }}"
                data-address="{{ $technician->address }}"
                class="btn btn-sm btn-light-primary mr-3 rounded-pill px-5 font-weight-bold js-edit-tech">
                <i class="flaticon2-edit"></i>
                Edit
            </button>
            <button type="button"
                    data-href="{{ route('admin.requests.technician.delete',encryptId($technician->id)) }}"
                    class="btn btn-sm btn-light-danger rounded-pill px-5 font-weight-bold js-delete">
                <i class="flaticon2-trash"></i>
                Delete
            </button>
        </div>
    </div>
@else
    <div
        class="alert alert-light-info flex-column alert-custom justify-content-center align-items-center">
        <h1 class="display-6 mb-4">
            No technicians assigned yet
        </h1>
        @if( $request->canAddTechnician())
            <button type="button" class="btn rounded-sm btn-info" id="addTechBtn">
                <i class="flaticon2-user"></i>
                Add Technician
            </button>
        @endif
    </div>
@endif
