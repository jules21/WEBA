<div class="my-3">
    <!--begin::Row-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 tw-font-semibold text-muted">
            Owner Name:
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
            Bill Number:
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
            Amount:
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
                    <label for="phone">Phone Number</label>
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                               id="phone" wire:model="phone"
                               placeholder="Phone Number">
                        <button
                            class="flex-nowrap flex-shrink-0 ml-2 btn btn-accent font-weight-bold d-inline-flex align-items-center tw-gap-2 text-white"
                            wire:click="payBill">
                            Make Payment
                        </button>
                    </div>
                    @error('phone') <span
                        class="text-danger tw-text-xs mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-success d-flex align-items-center tw-gap-2">
            <i class="ti ti-circle-check tw-text-[24px]"></i>
            No payment required for bill number <strong>{{ $billNumber }}</strong> provided, please check your
            bill number and try again
        </div>
    @endif

</div>
