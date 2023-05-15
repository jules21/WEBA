<div class="container">
    <h4 class="mb-4 text-white">
        Check Bills
    </h4>
    <p class="tw-text-gray-300">
        Check your bills here and pay with MTN Mobile Money
    </p>
    <div class="card card-body rounded-lg">
        <form wire:submit.prevent="fetchBillDetails">
            <div class="row form-group">
                <div class="col-lg-6">
                    <label for="billNumber">Bill Number</label>
                    <div class="d-flex tw-gap-2">
                        <input type="text" class="form-control @error('billNumber') is-invalid @enderror"
                               id="billNumber" wire:model.defer="billNumber"
                               placeholder="Bill Number">
                        <button class="btn btn-primary text-uppercase flex-shrink-0" type="submit"
                                wire:loading.attr="disabled">
                            Check
                        </button>
                    </div>
                    @error('billNumber') <span class="text-danger tw-text-xs mt-2">{{ $message }}</span> @enderror
                </div>
            </div>
        </form>

        @if(empty($billNumber))
            <div class="alert alert-info d-flex align-items-center tw-gap-2">
                <i class="ti ti-circle-check tw-text-[24px]"></i>
                Enter your bill number to check your bill details and pay with MTN Mobile Money
            </div>
        @elseif(is_null($paymentDetails))
            <div class="alert alert-danger d-flex align-items-center tw-gap-2">
                <i class="ti ti-circle-check tw-text-[24px]"></i>
                No payment details found for bill number <strong>{{ $billNumber }}</strong> provided, please check your
                bill number and try again
            </div>
        @endif

        @if($billType==\App\Http\Livewire\CheckBills::WATER_BILL && $paymentDetails)
            @include('water_payment_details')
        @endif
        @if($billType==\App\Http\Livewire\CheckBills::OTHER_BILL && $paymentDetails)
            @include('other_payment_details')
        @endif

        <x-alerts/>

    </div>
</div>
