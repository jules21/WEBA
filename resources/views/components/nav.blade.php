
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white font-weight-bold" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-language" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 5h7"></path>
                            <path d="M9 3v2c0 4.418 -2.239 8 -5 8"></path>
                            <path d="M5 9c0 2.144 2.952 3.908 6.7 4"></path>
                            <path d="M12 20l4 -9l4 9"></path>
                            <path d="M19.1 18h-6.2"></path>
                        </svg>
                        {{ app()->getLocale()=='en'?__('app.English'):__('app.French') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        @if(app()->getLocale()=='en')
                            <a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">
                                {{ __('app.French') }}
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">
                                {{ __('app.English') }}
                            </a>

                        @endif

                    </div>
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
