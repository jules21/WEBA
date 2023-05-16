<nav
    {{ $attributes->class(['navbar navbar-expand-lg navbar-dark  border-bottom tw-bg-no-repeat tw-bg-center tw-bg-cover m-0']) }}
    style="background-image: url({{ asset('images/aside_bg.png') }})">
    <div class="lg:tw-px-20 container-fluid">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{ asset('images/logo.png') }}" class="tw-h-10" alt=""/>
        </a>
        <button x-data="{open:false}" @click="open=!open" class="navbar-toggler shadow-none rounded-0 border-0"
                type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="ti ti-menu-2" x-show="!open"></span>
            <span class="ti ti-x" x-show="open"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto tw-gap-4">
                <li class="nav-item ">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold {{ request()->routeIs('home')?'active-link':'' }}"
                       href="{{ url('/home') }}">
                        <span>Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center btn btn-accent btn-sm text-dark px-4 rounded-sm tw-font-semibold "
                       href="{{ route('check-bills') }}">
                        <span>
                            Pay Now
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold {{ request()->routeIs('help')?'active-link':'' }}"
                       href="{{ route('help') }}">
                        <span>Help</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold {{ request()->routeIs('faq')?'active-link':'' }}"
                       href="{{ route('faq') }}">
                        <span>FAQ</span>
                    </a>
                </li>
                @auth('client')
                    <li class="nav-item dropdown">
                        <a class="nav-link tw-text-l tw-font-semibold dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown"
                           aria-expanded="false">
                            {{ auth('client')->user()->name ?? ''}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right tw-shadow tw-rounded">
                            <a class="dropdown-item tw-text-lg" href="{{route('client.profile')}}">
                                <span class="ti ti-user tw-text-[20px]"></span>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="ti ti-logout tw-text-[20px]"></span>
                                Logout
                            </a>
                            <form id="logout-form" action="{{route('client.logout')}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
