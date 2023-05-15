<div class="my-3">
    <!--begin::Card body-->
    <div>
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                Customer Name:
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
                        <span class="tw-text-sm text-gray-800">
                            {{ $paymentDetails->request->customer->name??'' }}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
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
                           {{ $paymentDetails->payment_reference??'' }}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                Payment type:
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                        <span class="tw-text-sm text-gray-800">
                            {{$paymentDetails->paymentConfig->paymentType->name??''}}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                Amount:
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
                        <span class="tw-text-sm text-gray-800">
                            {{ number_format($paymentDetails->amount??0) }}
                        </span>
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Row-->
        <div class="row mb-3">
            <!--begin::Label-->
            <label class="col-lg-4 tw-font-semibold text-muted">
                Status:
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8">
                            <span
                                    class="badge rounded-pill tw-py-1 tw-px-2 badge-{{$paymentDetails->status_color}}">
                                {{ strtoupper($paymentDetails->status) }}
                            </span>
            </div>
            <!--end::Col-->
        </div>
        @if(strtolower($paymentDetails->status)=='paid')
            <div class="alert alert-success d-flex align-items-center tw-gap-2">
                <i class="ti ti-circle-check tw-text-[24px]"></i>
                The bill number provided has been paid already and no further action is required.
            </div>
        @elseif(strtolower($paymentDetails->status)=='active')
            <div class="alert alert-info d-flex align-items-center tw-gap-2">
                <i class="ti ti-info-circle tw-text-[24px]"></i>
                The bill number provided is active and can be paid. Please proceed to make payment below to
                complete the process.
            </div>

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
        @endif
    </div>
    <!--end::Card body-->
</div>
