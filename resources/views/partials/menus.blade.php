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
    @can(\App\Constants\Permission::ManageOperators)
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
    @endcan
    @can(\App\Constants\Permission::ManageCustomers)
        <li class="menu-item nav-customers">
            <a href="{{route('admin.customers.index')}}" class="menu-link">
           <span class="svg-icon menu-icon">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
</svg>

           </span>
                <span class="menu-text">Customers</span>
            </a>
        </li>
    @endcan
    @if(auth()->user()->can(\App\Constants\Permission::ManageOperationAreas) && auth()->user()->operator_id)
        <li class="menu-item nav-operation-areas">
            <a href="{{route('admin.operator.area-of-operation.index',encryptId(auth()->user()->operator_id))}}"
               class="menu-link">
                <span class="menu-icon">
                    <i class="fas fa-map"></i>
                </span>
                <span class="menu-text">
                    Operation Areas
                </span>
            </a>
        </li>
    @endif


    @canany([\App\Constants\Permission::CreateRequest,\App\Constants\Permission::ApproveRequest,\App\Constants\Permission::AssignMeterNumber,\App\Constants\Permission::ReviewRequest])
        <li class="menu-item menu-item-submenu nav-request-management" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:" class="menu-link menu-toggle">
           <span class="svg-icon menu-icon">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
           </span>
                <span class="menu-text">Requests</span>
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
                    @can(\App\Constants\Permission::CreateRequest)
                        <li class="menu-item nav-all-users" aria-haspopup="true">
                            <a href="{{route('admin.requests.create')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Create New Request</span>
                            </a>
                        </li>
                    @endcan

                    @can(\App\Constants\Permission::AssignRequest)
                        <li class="menu-item nav-all-users" aria-haspopup="true">
                            <a href="{{route('admin.requests.new')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Pending Requests</span>
                            </a>
                        </li>

                        <li class="menu-item nav-roles" aria-haspopup="true">
                            <a href="{{route('admin.requests.assigned')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Assigned Requests</span>
                            </a>
                        </li>
                    @endcan


                    <li class="menu-item nav-all-permissions" aria-haspopup="true">
                        <a href="{{ route('admin.requests.my-tasks') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">My Tasks</span>
                        </a>
                    </li>

                    <li class="menu-item nav-all-permissions" aria-haspopup="true">
                        <a href="{{route('admin.requests.index')}}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">All Requests</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcanany

    @canany([\App\Constants\Permission::CreatePurchase,\App\Constants\Permission::ApproveRequest])
        <li class="menu-item menu-item-submenu nav-purchases" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:" class="menu-link menu-toggle">
           <span class="svg-icon menu-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="24" height="24"
                   viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round"
                   stroke-linejoin="round">
               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
               <path
                   d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z"></path>
               <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
               <path d="M6 9h-.01"></path>
            </svg>
           </span>
                <span class="menu-text">Purchases</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    @can(\App\Constants\Permission::CreatePurchase)
                        <li class="menu-item nav-create-purchase" aria-haspopup="true">
                            <a href="{{route('admin.purchases.create')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Create New</span>
                            </a>
                        </li>
                    @endcan


                    <li class="menu-item nav-my-purchases" aria-haspopup="true">
                        <a href="{{route('admin.purchases.index')}}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">
                                 My Tasks
                            </span>
                        </a>
                    </li>
                    <li class="menu-item nav-all-purchases" aria-haspopup="true">
                        <a href="{{route('admin.purchases.index',['type'=>'all'])}}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">
                                All Purchases
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcanany
    {{--    @can('Manage Stock')--}}
    <li class="menu-section">
        <h4 class="menu-text">Stock Management Section</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item menu-item-submenu nav-user-managements" aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:;" class="menu-link menu-toggle">
            <i class="menu-icon flaticon2-cube"></i>
            <span class="menu-text">Stock Management</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">Stock Management</span>
                            </span>
                </li>
                <li class="menu-item nav-all-users" aria-haspopup="true">
                    <a href="{{ route('admin.stock.item-categories.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Item Categories</span>
                    </a>
                </li>
                <li class="menu-item nav-roles" aria-haspopup="true">
                    <a href="{{route('admin.stock.items.index')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Items</span>
                    </a>
                </li>
                <li class="menu-item nav-all-permissions" aria-haspopup="true">
                    <a href="{{ route('admin.stock.stock-items.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Stock</span>
                    </a>
                </li>
                <li class="menu-item nav-all-permissions" aria-haspopup="true">
                    <a href="{{ route('admin.stock.stock-items.movements') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Stock Movements</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{--    @endcan--}}

    {{--    @can('Manage System Users')--}}
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
                @can('Manage Request Type')
                    <li class="menu-item nav-request-type" aria-haspopup="true">
                        <a href="{{ route('admin.request.types') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Request Type</span>
                        </a>
                    </li>
                @endcan
                @can('Manage Payment Type')
                    <li class="menu-item nav-payment-type" aria-haspopup="true">
                        <a href="{{ route('admin.payment.types') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Payment Type</span>
                        </a>
                    </li>
                @endcan
                @can('Manage Document Types')
                    <li class="menu-item nav-document-types" aria-haspopup="true">
                        <a href="{{ route('admin.document.types') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Document Type</span>
                        </a>
                    </li>
                @endcan
                @can('Manage Packaging Units')
                    <li class="menu-item nav-packaging-units" aria-haspopup="true">
                        <a href="{{ route('admin.packaging.units') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Packaging Units</span>
                        </a>
                    </li>
                @endcan
                @can('Manage Road Cross Types')
                    <li class="menu-item nav-road-cross-types" aria-haspopup="true">
                        <a href="{{ route('admin.road.cross.types') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Road Cross Types</span>
                        </a>
                    </li>
                @endcan
                @can('Manage Water Usages')
                    <li class="menu-item nav-water-usages" aria-haspopup="true">
                        <a href="{{ route('admin.water.usages') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Water Usages</span>
                        </a>
                    </li>
                @endcan
                <li class="menu-item nav-request-duration-configuration" aria-haspopup="true">
                    <a href="{{ route('admin.request.duration.configurations') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Request Duration Configuration</span>
                    </a>
                </li>

                <li class="menu-item nav-payment-configurations" aria-haspopup="true">
                    <a href="{{ route('admin.payment.configurations') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">Payment Configuration</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

</ul>

