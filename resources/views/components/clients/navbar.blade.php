<nav
    {{ $attributes->class(['navbar navbar-expand-lg navbar-dark  border-bottom tw-bg-no-repeat tw-bg-center tw-bg-cover m-0']) }}
    style="background-image: url({{ asset('images/aside_bg.png') }})">
    <div class="lg:tw-px-20 container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
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
                        <span>@lang('app.home')</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold {{ request()->routeIs('help')?'active-link':'' }}"
                       href="{{ route('help') }}">
                        <span>@lang('app.help')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold {{ request()->routeIs('faq')?'active-link':'' }}"
                       href="{{ route('faq') }}">
                        <span>FAQ</span>
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
                        {{ app()->getLocale()=='en'?__('app.English'):__('app.Kinyarwanda') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        @if(app()->getLocale()=='en')
                            <a class="dropdown-item {{ app()->getLocale()=='rw'?'active':'' }}"
                               href="{{ route('lang.switch', 'rw') }}">
                                {{ __('app.Kinyarwanda') }}
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">
                                {{ __('app.English') }}
                            </a>

                        @endif

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center btn btn-accent btn-sm text-white px-4 tw-rounded-sm tw-font-semibold " target="_blank"
                       href="{{ route('check-bills') }}">
                        <span>
                            @lang('app.pay_now')
                        </span>
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
                                @lang('app.profile')
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="ti ti-logout tw-text-[20px]"></span>
                                @lang('app.logout')
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
