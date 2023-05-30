@extends('client.layout.auth')
@section('title','Request Details')

@section('breadcrumbs')
    <x-layouts.breadcrumb page-title="Request Details">

        <x-layouts.breadcrumb-item>
            Request Details
        </x-layouts.breadcrumb-item>
        <x-slot name="actions">
        </x-slot>
    </x-layouts.breadcrumb>
@endsection
@section('content')
    <div class="card card-body tw-rounded-lg">
        <div class="d-flex justify-content-between mb-4 align-items-center">
            <h4 class="mb-0">@lang('app.request_details')</h4>
            <span
                class="badge badge-{{ $request->status_color }} rounded-pill tw-py-1.5 tw-px-2">{{ $request->status }}</span>

        </div>
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
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">@lang('app.water_usage'):</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->waterUsage->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        @lang('app.number_of_meters_requested:')
                    </label>
                    <div class="form-control-plaintext py-0">
                        <span
                            class="tw-bg-accent/20 py-1 px-2 tw-text-primary font-weight-bold rounded-pill">{{ $request->meter_qty }}</span>
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
                    <label class="font-weight-bold">@lang('app.UPI_attachment:')</label>
                    <div>
                        <a href="{{ $request->upi_attachment_url }}" class="btn btn-sm btn-accent"
                           target="_blank">
                            @lang('app.download_UPI')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        @lang('app.will_the_new_connection_cross_a_road?')
                    </div>
                    <span class="tw-bg-accent/20 font-weight-bold tw-text-primary px-2 py-1 rounded-pill">
                                        {{ $request->new_connection_crosses_road? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">@lang('app.road_type:')</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->road_type??'N/A' }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        @lang('app.will_you_buy_the_equipments_by_yourself?')
                    </div>
                    <span class="tw-bg-accent/20 font-weight-bold tw-text-primary px-2 py-1 rounded-pill">
                                        {{ $request->equipment_payment? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <div class="font-weight-bold">
                        @lang('app.will_you_dig_the_pipeline_by_yourself?')
                    </div>
                    <span class="tw-bg-accent/20 font-weight-bold tw-text-primary px-2 py-1 rounded-pill">
                                        {{ $request->digging_pipeline? 'Yes' : 'No' }}
                                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        @lang('app.address'):
                    </label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->address }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        @lang('app.operator'):
                    </label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->operator->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label class="font-weight-bold">
                        @lang('app.operating_area:')
                    </label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->operationArea->name }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <label class="font-weight-bold d-block">@lang('app.pipe_will_cross:')</label>
                <div class="row">
                    @forelse($request->pipeCrosses as $item)
                        <div class="col-lg-4 my-2">
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
                            <strong class="text-info"> @lang('app.no_data_found')</strong>
                        </div>

                    @endforelse
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="font-weight-bold">@lang('app.description:')</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->description }}
                    </div>
                </div>
            </div>
        </div>

        @if(!$request->equipment_payment)
            <h6 class="text-primary font-weight-bold mt-4">@lang('app.materials')</h6>
            <div class="table-responsive border rounded-lg">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.name')</th>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.price')</th>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.qty')</th>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.total')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($request->items as $meter)
                        <tr>
                            <td>{{ $meter->item->name }}</td>
                            <td>{{ number_format($meter->unit_price) }}</td>
                            <td>{{ $meter->quantity }}</td>
                            <td>{{ number_format($meter->total) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">@lang('app.no_data_found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-4">
            <h6 class="text-primary font-weight-bold">@lang('app.assigned_meters')</h6>
            <div class="table-responsive border rounded-lg">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.name')</th>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.meter_number')</th>
                        <th class="border-top-0 text-muted text-uppercase">@lang('app.subscription_number')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($request->meterNumbers as $meter)
                        <tr>
                            <td>{{ $meter->item->name }}</td>
                            <td>{{ $meter->meter_number }}</td>
                            <td>{{ $meter->subscription_number }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">@lang('app.no_data_found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
