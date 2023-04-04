<div class="card mb-3">
    <div class="card-body">
        <h5 class="mb-4">
            Request Details
        </h5>
        <div class="row">
      {{--      <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">Type</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->requestType->name }}
                    </div>
                </div>
            </div>--}}
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

        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="">
                    <h4>
                        Water Network & Connection Fee
                    </h4>
                    @if($request->canAddConnectionFee())
                        <form action="{{ route('admin.requests.add-water-network', encryptId($request->id)) }}"
                              method="post" id="saveWaterNetworkForm">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 my-2">
                                    <div class="form-group">
                                        <label for="water_network_id">
                                            <span class="font-weight-bold">Water Network</span>
                                        </label>
                                        <select name="water_network_id" id="water_network_id" class="form-control">
                                            <option value="">
                                                Please Select Water Network
                                            </option>
                                            @foreach($waterNetworks as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $request->water_network_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2">
                                    <div class="form-group">
                                        <div style="visibility: hidden" class="mb-2">
                                            Save Button
                                        </div>
                                        <button type="submit"
                                                class="btn btn-light-primary" id="addWaterNetwork">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @elseif(!is_null($request->water_network_id))
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label for="">
                                    <span class="font-weight-bold">Water Network</span>
                                </label>
                                <div class="form-control-plaintext py-0">
                                    {{ $request->waterNetwork->name }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="">
                                    <span class="font-weight-bold">Connection Fee</span>
                                </label>
                                <div class="form-control-plaintext py-0">
                                    RWF {{ number_format($request->connection_fee,0) }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info mb-0 mt-3 alert-custom ">
                            <div class="alert-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9"/>
                                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                                    <polyline points="11 12 12 12 12 16 13 16"/>
                                </svg>
                            </div>
                            <div class="alert-text">
                                No Water Network & Connection Fee Added Yet !
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        @if(is_null($request->water_network_id))
            <div class="alert alert-light-warning alert-custom alert-notice my-3 p-2 rounded-0">
                <div class="alert-icon text-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-exclamation"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M15.04 19.745c-.942 .551 -1.964 .976 -3.04 1.255a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 .195 6.015"></path>
                        <path d="M19 16v3"></path>
                        <path d="M19 22v.01"></path>
                    </svg>
                </div>
                <div class="alert-text">
                    Please add the water network to proceed.
                </div>
            </div>
        @endif

    </div>
</div>
