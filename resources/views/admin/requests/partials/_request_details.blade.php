<div class="card mb-3">
    <div class="card-body">
        <h5 class="mb-4">
            Request Details
        </h5>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">Type</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->requestType->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Water Usage</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->waterUsage->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Number of Meters Requested
                    </label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->meter_qty }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">UPI</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->upi }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        Will the new connection cross a road?
                    </div>
                    <span class="label label-light-info label-inline rounded-pill">
                                        {{ $request->new_connection_crosses_road? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">Road Type:</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->road_type }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        Will you buy the equipments by yourself?
                    </div>
                    <span class="label label-light-info label-inline rounded-pill">
                                        {{ $request->equipment_payment? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        Will you dig the pipeline by yourself?
                    </div>
                    <span class="label label-light-info label-inline rounded-pill">
                                        {{ $request->digging_pipeline? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Address
                    </label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->address }}
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="font-weight-bold">Description</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
