<div class="card mb-3">
    <div class="card-body">
        <h5 class="mb-4">
            Customer Details
        </h5>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Name</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->customer->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Phone</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->customer->phone }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Email</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->customer->email }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">ID Type</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->customer->documentType->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Doc Number</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->customer->doc_number }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Address</label>
                    <div class="form-control-plaintext py-0">
                        {{ $request->customer->address }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
