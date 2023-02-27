<ul class="menu-nav">
    <li class="menu-item nav-dashboard">
        <a href="{{route('admin.dashboard')}}" class="menu-link">
           <span class="svg-icon menu-icon">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
            </svg>

           </span>
            <span class="menu-text">Dashboard</span>
        </a>
    </li>
    <li class="menu-item nav-operators">
        <a href="{{route('admin.operator.index')}}" class="menu-link">
           <span class="svg-icon menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
           </span>
            <span class="menu-text">Operators</span>
        </a>
    </li>
    {{--    @can('Manage System Users')--}}

    <li class="menu-section">
        <h4 class="menu-text">System Settings</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item menu-item-submenu nav-settings" aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:;" class="menu-link menu-toggle">
            <i class="menu-icon flaticon-settings"></i>
            <span class="menu-text">Settings</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">User Management</span>
                            </span>
                </li>
                <li class="menu-item nav-request-type" aria-haspopup="true">
                    <a href="{{ route('admin.request.type.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Request Type</span>
                    </a>
                </li>
                <li class="menu-item nav-payment-type" aria-haspopup="true">
                    <a href="{{ route('admin.payment.type.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Payment Type</span>
                    </a>
                </li>
                <li class="menu-item nav-request-duration-configuration" aria-haspopup="true">
                    <a href="{{ route('admin.request.duration.configuration.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Request Duration Configuration</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="menu-section">
        <h4 class="menu-text">System Users Section</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item menu-item-submenu nav-user-managements" aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:;" class="menu-link menu-toggle">
            <i class="menu-icon flaticon-users"></i>
            <span class="menu-text">User Management</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">User Management</span>
                            </span>
                </li>
                <li class="menu-item nav-all-users" aria-haspopup="true">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Users</span>
                    </a>
                </li>
                <li class="menu-item nav-roles" aria-haspopup="true">
                    <a href="{{ route('admin.roles.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Roles</span>
                    </a>
                </li>
                <li class="menu-item nav-all-permissions" aria-haspopup="true">
                    <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Permissions</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{--    @endcan--}}
</ul>

