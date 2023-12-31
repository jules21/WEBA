<div class="card card-body">
    <h5>Billing Details</h5>
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="customer_name">Customer Name</label>
                <div class="form-control-plaintext"> {{ $billing->meterRequest->request->customer->name ?? '-' }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="starting_index">Previous Index</label>
                <div class="form-control-plaintext"> {{ $billing->starting_index }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="last_index">Current Index</label>
                <div class="form-control-plaintext"> {{ $billing->last_index }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="last_index">Consumption</label>
                <div class="form-control-plaintext"> {{ $billing->last_index - $billing->starting_index }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="user_id">Officer</label>
                <div class="form-control-plaintext"> {{ $billing->user->name ?? '-' }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="unit_price">Unit Price</label>
                <div class="form-control-plaintext"> {{ $billing->unit_price }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="meter_number">Meter Number</label>
                <div class="form-control-plaintext"> {{ $billing->meter_number }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="subscription_number">Subscription Number</label>
                <div class="form-control-plaintext"> {{ $billing->subscription_number }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="amount">Amount</label>
                <div class="form-control-plaintext"> {{ $billing->amount .'RWF' }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="balance">Outstanding</label>
                <div class="form-control-plaintext"> {{ $billing->balance .'RWF' }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="created_at">Created At</label>
                <div class="form-control-plaintext"> {{ $billing->created_at }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="comment">Comment</label>
                <div class="form-control-plaintext"> {{ $billing->comment ?? '-' }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="attachment">Attachment</label>
                <div class="form-control-plaintext">
                    @if($billing->attachment)
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.billings.download', encryptId($billing->id)) }}" target="_blank">View Attachment</a>
                    @else
                        -
                    @endif
            </div>
        </div>
    </div>
</div>
