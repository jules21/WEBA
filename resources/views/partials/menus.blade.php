@php
    $data=badgesCounts();
@endphp

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
            <span class="menu-text">@lang('backend.dashboard')</span>
        </a>
    </li>
    @if( auth()->user()->can(\App\Constants\Permission::ManageCustomers))
        <li class="menu-item nav-customers">
            <a href="{{route('admin.customers.index')}}" class="menu-link">
               <span class="svg-icon menu-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
                    </svg>
               </span>
                <span class="menu-text">@lang('backend.customers')</span>
            </a>
        </li>
    @endif
   @if(auth()->user()->can(\App\Constants\Permission::ManageBillings))
        <li class="menu-item nav-billings">
            <a href="{{route('admin.billings.index')}}"
               class="menu-link">
                    <span class="menu-icon svg-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2" width="24"
                           height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path>
   <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5"></path>
</svg>
                    </span>
                <span class="menu-text">
                        @lang('backend.billing')
                    </span>
            </a>
        </li>
    @endif

    @if(auth()->user()->canAny(requestPermissions()))
        <li class="menu-item menu-item-submenu nav-request-management" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:" class="menu-link menu-toggle">
               <span class="svg-icon menu-icon">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
               </span>
                <span class="menu-text">@lang('backend.requests')</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">@lang('backend.requests')</span>
                            </span>
                    </li>
                    @if(auth()->user()->operation_area)
                        @can(\App\Constants\Permission::CreateRequest)
                            <x-menu-item title="New Connection" item-class="nav-create-request"
                                         :route="route('admin.requests.create')"/>
                        @endcan
                        @can(\App\Constants\Permission::AssignRequest)
                            <x-menu-item title="Pending Requests" item-class="nav-pending-requests"
                                         :count="$data['pending_requests']"
                                         :route="route('admin.requests.new')"/>
                            <x-menu-item title="Assigned Requests" item-class="nav-assigned-requests"
                                         :route="route('admin.requests.assigned')"/>
                        @endcan
                        <x-menu-item title="My Tasks" item-class="nav-my-tasks" :count="$data['requests_tasks']"
                                     :route="route('admin.requests.my-tasks')"/>
                        @can(\App\Constants\Permission::ManageItemDelivery)
                            <x-menu-item title="Item Delivery" item-class="nav-item-delivery"
                                         :route="route('admin.requests.to-be-delivered')"/>
                        @endcan
                    @endif
                    <x-menu-item title="All Requests" item-class="nav-all-requests"
                                 :route="route('admin.requests.index')"/>


                </ul>
            </div>
        </li>
    @endif

    @canany([\App\Constants\Permission::ManageSystemUsers, \App\Constants\Permission::ManageRoles,
    \App\Constants\Permission::ManagePermissions, \App\Constants\Permission::ManageDistrictUsers,])
        <li class="menu-section">
            <h4 class="menu-text">System Users Section</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>
        <li class="menu-item menu-item-submenu nav-user-managements" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <span class="menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                       <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                       <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                       <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                </span>
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
                    @can(\App\Constants\Permission::ManageSystemUsers)
                        <li class="menu-item nav-all-users" aria-haspopup="true">
                            <a href="{{ route('admin.users.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Users</span>
                            </a>
                        </li>
                    @endcan
                    @can(\App\Constants\Permission::ManageRoles)
                        <li class="menu-item nav-roles" aria-haspopup="true">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Roles</span>
                            </a>
                        </li>
                    @endcan
                    @can(\App\Constants\Permission::ManagePermissions)
                        <li class="menu-item nav-all-permissions" aria-haspopup="true">
                            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Permissions</span>
                            </a>
                        </li>
                    @endcan
                    @can(\App\Constants\Permission::ManageDistrictUsers)
                        <li class="menu-item nav-district-users" aria-haspopup="true">
                            <a href="{{ route('admin.users.index') }}?type=district" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">District Users</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany
    @canany(settingsPermissions())
        <li class="menu-section">
            <h4 class="menu-text">System Settings</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>
        <li class="menu-item menu-item-submenu nav-settings" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <span class="menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-2" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path
                           d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z"></path>
                       <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                    </svg>
                </span>
                <span class="menu-text">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">System Settings Management</span>
                            </span>
                    </li>
                    @can('Manage banks')
                        <li class="menu-item nav-banks" aria-haspopup="true">
                            <a href="{{ route('admin.banks') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Banks</span>
                            </a>
                        </li>
                    @endcan

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
                    @if(auth()->user()->is_super_admin)
                        @can('Manage Institutions')
                            <li class="menu-item nav-institution" aria-haspopup="true">
                                <a href="{{ route('admin.institutions') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Institutions</span>
                                </a>
                            </li>
                        @endcan
                    @endif
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

                    @can('Manage Water Network Types')
                        <li class="menu-item nav-water-network-types" aria-haspopup="true">
                            <a href="{{ route('admin.water.network.types') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Water Network Types</span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Water Network')
                        <li class="menu-item nav-water-networks" aria-haspopup="true">
                            <a href="{{ route('admin.water.networks') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Water Supply Systems</span>
                            </a>
                        </li>
                    @endcan
                    @can(\App\Constants\Permission::ManageClusters)
                        <li class="menu-item nav-clusters" aria-haspopup="true">
                            <a href="{{ route('admin.clusters') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">
                                    Clusters
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Water Network Statuses')
                        <li class="menu-item nav-water-network-statuses" aria-haspopup="true">
                            <a href="{{ route('admin.water.network.statuses') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Water Network Statuses</span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Request Duration Configurations')
                        <li class="menu-item nav-request-duration-configuration" aria-haspopup="true">
                            <a href="{{ route('admin.request.duration.configurations') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Request Duration Configuration</span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Payment Configurations')
                        <li class="menu-item nav-payment-configurations" aria-haspopup="true">
                            <a href="{{ route('admin.payment.configurations') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Payment Configuration</span>
                            </a>
                        </li>
                    @endcan
                    @if(auth()->user()->is_super_admin)
                        @can('Manage Faqs')
                            <li class="menu-item nav-faqs" aria-haspopup="true">
                                <a href="{{ route('admin.faq') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">FAQs</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @can('Manage User Manual')
                        <li class="menu-item nav-faqs" aria-haspopup="true">
                            <a href="{{ route('admin.user.manuals') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">User Manuals</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        </li>
    @endcanany
</ul>

