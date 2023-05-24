<div class="my-3">

    @if(is_null($billingSummary))
        <div class="alert alert-danger d-flex align-items-center tw-gap-2">
            <i class="ti ti-circle-check tw-text-[24px]"></i>
            No payment required for bill number <strong>{{ $billNumber }}</strong> provided, please check your
            bill number and try again
        </div>
    @else
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                @lang('app.owner_name:')
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                        <span class="tw-text-sm text-gray-800">
                            {{ $billingSummary->customer_name??'' }}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Row-->
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                @lang('app.bill_number')
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
                        <span class=" tw-text-sm text-gray-800">
                           {{ $billingSummary->subscription_number??'' }}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                @lang('app.amount:')
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                        <span class=" tw-text-sm text-gray-800">
                         RWF  {{ number_format($billingSummary->total_balance_due) }}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        @if($billingSummary->total_balance_due>0)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">@lang('app.phone_number')</label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" wire:model="phone"
                                   placeholder="{{__('app.phone_number')}}">
                            <button
                                class="flex-nowrap flex-shrink-0 ml-2 btn btn-accent font-weight-bold d-inline-flex align-items-center tw-gap-2 text-white"
                                wire:click="payBill">
                                @lang('app.make_payment')
                            </button>
                        </div>
                        @error('phone') <span
                            class="text-danger tw-text-xs mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif
    @endif


</div>
