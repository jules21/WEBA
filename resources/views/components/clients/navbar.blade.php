
<nav  {{ $attributes->class(['navbar navbar-expand-lg navbar-dark bg-dark border-bottom tw-bg-no-repeat tw-bg-center tw-bg-cover m-0']) }}
     style="background-image: url({{ asset('images/aside_bg.png') }})">
    <div class="lg:tw-px-20 container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" class="tw-h-10" alt=""/>
        </a>
        <button x-data="{open:false}" @click="open=!open" class="navbar-toggler shadow-none rounded-0 border-0" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="ti ti-menu-2" x-show="!open"></span>
            <span class="ti ti-x" x-show="open"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                        <span>Pay with MOMO</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                        <span>Help</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link tw-text-l tw-font-semibold dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-expanded="false">
                        {{auth('client')->user() ? auth('client')->user()->name : ''}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right tw-shadow tw-rounded">
                        <a class="dropdown-item tw-text-lg" href="#">
                            <span class="ti ti-user tw-text-[20px]"></span>
                            Profile
                        </a>
{{--                        <a class="dropdown-item tw-text-lg" href="#">--}}
{{--                            <span class="ti ti-settings-2 tw-text-[20px]"></span>--}}
{{--                            Account--}}
{{--                        </a>--}}
{{--                        <a class="dropdown-item tw-text-lg" href="#">--}}
{{--                            <span class="ti ti-square-asterisk tw-text-[20px]"></span>--}}
{{--                            Change Password--}}
{{--                        </a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="ti ti-logout tw-text-[20px]"></span>
                            Logout
                        </a>
                        <form id="logout-form" action="{{route('client.logout')}}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center btn btn-accent btn-sm text-dark px-4 rounded-sm tw-font-semibold " href="#">
                        <span>Check Bills</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
