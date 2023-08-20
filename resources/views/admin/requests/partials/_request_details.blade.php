<div class="card mb-3 tw-rounded-lg tw-h-full">
    <div class="card-body">
        <h5 class="mb-4">
            Request Details
        </h5>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">
                        Connection Type
                    </label>
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
                    <label class="font-weight-bold">UPI Attachment</label>
                    <div>
                        <a href="{{ $request->upi_attachment_url }}" class="btn btn-sm btn-light-danger"
                           target="_blank">
                            <i class="flaticon2-download-2"></i>
                            Download UPI
                        </a>
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
                        {{ $request->road_type??'N/A' }}
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
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Operator:
                    </label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->operator->name }}
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <label class="font-weight-bold d-block">Pipe will cross:</label>
                <div class="row">
                    @forelse($request->pipeCrosses as $item)
                        <div class="col-lg-6 my-2">
                           <span class="svg-icon text-success">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-circle-check" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                   <path d="M9 12l2 2l4 -4"></path>
                                </svg>
                           </span>
                            {{ $item->pipeCross->name }}
                        </div>
                    @empty

                        <div class="col-12">
                            <strong class="text-info"> No data found</strong>
                        </div>

                    @endforelse
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="font-weight-bold">Description</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->description }}
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="font-weight-bold">Form Attachment</label>
                    <div>
                        @if($request->form_attachment)
                            <a href="{{ $request->form_attachment_url }}" class="btn btn-sm btn-light-danger"
                               target="_blank">
                                <i class="flaticon2-download-2"></i>
                                Download Form
                            </a>
                        @else
                            N/A
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
