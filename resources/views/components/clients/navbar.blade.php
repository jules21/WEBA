<nav {{ $attributes->class(['navbar navbar-expand-lg navbar-light bg-white']) }}>
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item active">
                    <a class="nav-link tw-text-lg" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tw-text-lg" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notification"
                             width="28" height="28" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 6h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                            <path d="M17 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        </svg>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link tw-text-lg dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ asset('assets/media/users/100_5.jpg') }}" class="tw-h-10 rounded-circle" alt=""/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right tw-shadow tw-rounded-xl">
                        <a class="dropdown-item py-2" href="#">Action</a>
                        <a class="dropdown-item py-2" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item py-2" href="#">Something else here</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link tw-text-lg" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="28"
                             height="28" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
