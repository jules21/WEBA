
<nav class="navbar navbar-expand-lg navbar-dark mt-3">
    <div class="lg:tw-px-20 container-fluid">
        <a class="navbar-brand" href="/">
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
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="/">
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                        <span>Pay with MOMO</span>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                        <span>Help</span>
                    </a>
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
