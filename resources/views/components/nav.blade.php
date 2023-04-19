
<nav {{ $attributes->class(['navbar navbar-expand-lg navbar-dark']) }}>
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" class="" alt="Logo">
        </a>
        <button class="navbar-toggler tw-rounded-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto d-flex tw-gap-4">
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold" href="{{ route('login') }}">
                        Staff Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold" href="#">
                        Pay with MOMO
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold" href="#">
                        Help
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-accent tw-rounded-sm font-weight-bolder px-4 text-white hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary focus:tw-ring-2">
                        Check Bills
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
