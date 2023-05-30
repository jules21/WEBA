<div class="container">
    <h4 class="mb-4 text-white">
        @lang('app.Check_bills')
    </h4>
    <p class="tw-text-gray-300">
        @lang('app.check_your_bills_here_and_pay_with_MTN_mobile_money')
    </p>
    <div class="card card-body rounded-lg">
        <form wire:submit.prevent="fetchBillDetails">
            <div class="row form-group">
                <div class="col-lg-6">
                    <label for="billNumber">@lang('app.bill_number')</label>
                    <div class="d-flex tw-gap-2">
                        <input type="text" class="form-control @error('billNumber') is-invalid @enderror"
                               id="billNumber" wire:model.defer="billNumber"
                               placeholder="@lang('app.bill_number')">
                        <button class="btn btn-primary text-uppercase flex-shrink-0" type="submit"
                                wire:loading.attr="disabled">
                            @lang('app.check')
                        </button>
                    </div>
                    @error('billNumber') <span class="text-danger tw-text-xs mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </form>

        @if(empty($billNumber))
            <div class="alert alert-info d-flex align-items-center tw-gap-2">
                <i class="ti ti-circle-check tw-text-[24px]"></i>
                @lang('app.enter_your_bill_number')
            </div>
        @endif

        @if($billType==\App\Http\Livewire\CheckBills::WATER_BILL)
            @include('water_payment_details')
        @endif
        @if($billType==\App\Http\Livewire\CheckBills::OTHER_BILL)
            @include('other_payment_details')
        @endif

        <x-alerts/>

    </div>
</div>
