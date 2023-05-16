@extends('client.layout.auth')
@section('title','Request Details')

@section('breadcrumbs')
    <x-layouts.breadcrumb page-title="Request Details">

        <x-layouts.breadcrumb-item>
            Request Details
        </x-layouts.breadcrumb-item>
    </x-layouts.breadcrumb>
@endsection
@section('content')
    <div class="card card-body tw-rounded-lg">
        <h4 class="mb-4">
            Request Details
        </h4>
        @if($request->status==\App\Constants\Status::PENDING && $request->customer_initiated)
            <div
                class="alert alert-warning d-flex justify-content-between tw-rounded-lg align-items-center border-warning">
                <div class="flex-grow-1 font-weight-bold text-dark mr-3">
                    {{ $lastReview->comment }}
                </div>
                <a href="{{ route('client.requests.edit', encryptId($request->id)) }}"
                   class="btn  bg-accent font-weight-bolder align-self-start flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="tw-w-4 tw-h-4">
                        <path
                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                    </svg>
                    Edit
                </a>
            </div>

        @endif

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
                    <label for="name" class="font-weight-bold">Water Usage:</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->waterUsage->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Number of Meters Requested:
                    </label>
                    <div class="form-control-plaintext py-0">
                        <span class="tw-bg-accent/20 py-1 px-2 tw-text-primary font-weight-bold rounded-pill">{{ $request->meter_qty }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">UPI:</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->upi }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">UPI Attachment:</label>
                    <div>
                        <a href="{{ $request->upi_attachment_url }}" class="btn btn-sm btn-accent"
                           target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download"
                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                <path d="M7 11l5 5l5 -5"></path>
                                <path d="M12 4l0 12"></path>
                            </svg>
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
                    <span class="tw-bg-accent/20 font-weight-bold tw-text-accent px-2 py-1 rounded-pill">
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
                    <span class="tw-bg-accent/20 font-weight-bold tw-text-accent px-2 py-1 rounded-pill">
                                        {{ $request->equipment_payment? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        Will you dig the pipeline by yourself?
                    </div>
                    <span class="tw-bg-accent/20 font-weight-bold tw-text-accent px-2 py-1 rounded-pill">
                                        {{ $request->digging_pipeline? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Address:
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
                           <span class="svg-icon tw-text-accent">
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
                <label class="font-weight-bold d-block">Operator:</label>
                <div>
                    {{ $request->operator->name }}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="font-weight-bold">Description:</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->description }}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
