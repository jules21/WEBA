@if(session()->has('success'))
    <div
        class="alert alert-custom  my-3 alert-light-success border-success fade show rounded-sm"
        role="alert">
        <div class="alert-icon">
            <i class="la la-check-circle"></i>
        </div>
        <div class="alert-text">
            <span>{!! session()->get('success') !!}</span>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif
@if(session()->has('error'))
    <div
        class="alert alert-custom  my-3 alert-light-danger border-danger fade show rounded-sm"
        role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">
            <span>{{ session()->get('error') }}</span>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if(session()->has('warning'))
    <div
        class="alert alert-custom   my-3 alert-light-warning border-warning fade show rounded-sm"
        role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">
            <span>{{ session()->get('warning') }}</span>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if(session()->has('info'))
    <div
        class="alert alert-custom alert-notice  my-3 alert-outline-info bg-white fade show rounded-sm"
        role="alert">
        <div class="alert-icon">
            <i class="flaticon-information"></i>
        </div>
        <div class="alert-text">
            <span>{{ session()->get('info') }}</span>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger rounded">
        <div class="alert-icon">
            <p>
                <strong>Whoops!</strong> There were some problems with your input.
            </p>
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
