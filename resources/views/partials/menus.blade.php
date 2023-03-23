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
                      stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
               </span>
                <span class="menu-text">Operators</span>
            </a>
        </li>
    @endcan
    @if( auth()->user()->can(\App\Constants\Permission::ManageCustomers) && auth()->user()->operator_id)
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
    @endif
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
    @if(auth()->user()->can(\App\Constants\Permission::ManageBillings))
        <li class="menu-item nav-billings">
            <a href="{{route('admin.billings.index')}}"
               class="menu-link">
                    <span class="menu-icon">
                        <i class="la la-file-invoice-dollar" style="font-size: 22px"></i>
                    </span>
                <span class="menu-text">
                        Billing
                    </span>
            </a>
        </li>
    @endif
    @if(auth()->user()->can(\App\Constants\Permission::ManagePayment))
        <li class="menu-item nav-payments">
            <a href="{{route('admin.payments.index')}}"
               class="menu-link">
                    <span class="menu-icon">
                        <i class="la la-money-check-alt" style="font-size: 22px"></i>
                    </span>
                <span class="menu-text">
                        Payments
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
                <span class="menu-text">Requests</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">Requests</span>
                            </span>
                    </li>
                    @if(auth()->user()->operation_area)
                        @can(\App\Constants\Permission::CreateRequest)
                            <x-menu-item title="Create New Request" item-class="nav-create-request"
                                         :route="route('admin.requests.create')"/>
                        @endcan
                        @can(\App\Constants\Permission::AssignRequest)
                            <x-menu-item title="Pending Requests" item-class="nav-pending-requests"
                                         :route="route('admin.requests.new')"/>
                            <x-menu-item title="Assigned Requests" item-class="nav-assigned-requests"
                                         :route="route('admin.requests.assigned')"/>
                        @endcan
                        <x-menu-item title="My Tasks" item-class="nav-my-tasks"
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




    @if(auth()->user()->canAny(accountingAllPermissions()) && auth()->user()->operation_area)
        {{--    @can('Manage Stock')--}}
        <li class="menu-section">
            <h4 class="menu-text">
                Accounting & Finance
            </h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>

        @if(auth()->user()->canAny(accountingPermissions()) && auth()->user()->operation_area)
            <li class="menu-item menu-item-submenu nav-accounting-settings" aria-haspopup="true"
                data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                       <span class="svg-icon menu-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-tax"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <path d="M9 14l6 -6"></path>
                       <circle cx="9.5" cy="8.5" r=".5" fill="currentColor"></circle>
                       <circle cx="14.5" cy="13.5" r=".5" fill="currentColor"></circle>
                       <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path>
                    </svg>
                       </span>
                    <span class="menu-text">
                        Accounting
                    </span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        @can(\App\Constants\Permission::ManageExpenses)
                            <x-menu-item title="Expenses" item-class="nav-expenses"
                                         :route="route('admin.accounting.expenses')"/>
                        @endcan

                        @can(\App\Constants\Permission::ManageCashMovements)
                            <x-menu-item title="Cash Movements" item-class="nav-cash-movements"
                                         :route="route('admin.accounting.cash-movements.index')"/>
                        @endcan

                        @can(\App\Constants\Permission::ManageJournalEntries)
                            <x-menu-item title="Journal Entries" item-class="nav-journal-entries"
                                         :route="route('admin.accounting.journal-entries')"/>
                        @endcan

                        @can(\App\Constants\Permission::ViewGeneralLedger)
                            <x-menu-item title="General Ledger" item-class="nav-chart-accounts"
                                         :route="route('admin.purchases.index')"/>
                        @endcan

                        @can(\App\Constants\Permission::ViewLedgerBalance)
                            <x-menu-item title="Ledger Balances" item-class="nav-chart-accounts"
                                         :route="route('admin.purchases.index')"/>
                        @endcan


                    </ul>
                </div>
            </li>
        @endif

        @if(auth()->user()->canAny(accountingSettingsPermissions()) && auth()->user()->operation_area)
            <li class="menu-item menu-item-submenu nav-accounting-settings" aria-haspopup="true"
                data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                       <span class="svg-icon menu-icon">
                                       <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-coins"
                                            width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                               <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                               <path
                                   d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                               <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                               <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                            </svg>
                       </span>
                    <span class="menu-text">
                        Accounting Settings
                    </span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">

                        <x-menu-item title="Assign Chart Of Accounts" item-class="nav-assign-chart-accounts"
                                     :route="route('admin.purchases.index')"/>
                        <x-menu-item title="Ledger Migration" item-class="nav-ledger-migration"
                                     :route="route('admin.accounting.ledger-migration.index')"/>
                        <x-menu-item title="Chart Of Accounts" item-class="nav-chart-accounts"
                                     :route="route('admin.accounting.chart-of-accounts')"/>
                        <x-menu-item title="Bank Accounts" item-class="nav-bank-accounts"
                                     :route="route('admin.accounting.bank-accounts.index')"/>

                    </ul>
                </div>
            </li>
        @endif
    @endif

    @if(Helper::isOperator())
        @canany([\App\Constants\Permission::ManageItemCategories, \App\Constants\Permission::ManageItems,
        \App\Constants\Permission::ManageStocks,
        \App\Constants\Permission::ManageStockMovements, \App\Constants\Permission::CreateAdjustment,
        \App\Constants\Permission::ApproveAdjustment,
        \App\Constants\Permission::ViewAdjustment,
        \App\Constants\Permission::ManageSuppliers,
        \App\Constants\Permission::StockInItems,\App\Constants\Permission::ApproveStockIn])
            <li class="menu-section">
                <h4 class="menu-text">Stock Management Section</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
            @canany([\App\Constants\Permission::StockInItems,\App\Constants\Permission::ApproveStockIn])
                <li class="menu-item menu-item-submenu nav-purchases" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z">
                            </path>
                            <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
                            <path d="M6 9h-.01"></path>
                        </svg>
                    </span>
                        <span class="menu-text">
                        Stock In
                    </span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            @can(\App\Constants\Permission::StockInItems)
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
                        All
                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcanany

            @canany([\App\Constants\Permission::ManageItemCategories, \App\Constants\Permission::ManageItems,
            \App\Constants\Permission::ManageStocks,
            \App\Constants\Permission::ManageStockMovements, \App\Constants\Permission::CreateAdjustment,
            \App\Constants\Permission::ApproveAdjustment,
            \App\Constants\Permission::ViewAdjustment])
                <li class="menu-item menu-item-submenu nav-stock-managements" aria-haspopup="true" data-menu-toggle="hover">
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
                            @can(\App\Constants\Permission::ManageItemCategories)
                                <li class="menu-item nav-item-categories" aria-haspopup="true">
                                    <a href="{{ route('admin.stock.item-categories.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Item Categories</span>
                                    </a>
                                </li>
                            @endcan
                            @can(\App\Constants\Permission::ManageItems)
                                <li class="menu-item nav-items" aria-haspopup="true">
                                    <a href="{{route('admin.stock.items.index')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Items</span>
                                    </a>
                                </li>
                            @endcan
                            @can(\App\Constants\Permission::ManageStocks)
                                <li class="menu-item nav-stock" aria-haspopup="true">
                                    <a href="{{ route('admin.stock.stock-items.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Stock</span>
                                    </a>
                                </li>
                            @endcan
                            @can(\App\Constants\Permission::ManageStockMovements)
                                <li class="menu-item nav-stock-movements" aria-haspopup="true">
                                    <a href="{{ route('admin.stock.stock-items.movements') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Stock Movements</span>
                                    </a>
                                </li>
                            @endcan
                            @canany([\App\Constants\Permission::CreateAdjustment,\App\Constants\Permission::ApproveAdjustment,\App\Constants\Permission::ViewAdjustment])
                                <li class="menu-item menu-item-submenu nav-stock-adjustments" aria-haspopup="true"
                                    data-menu-toggle="hover">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Stock Adjustments</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu" kt-hidden-height="120"
                                         style="display: none; overflow: hidden;">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            @can(\App\Constants\Permission::ApproveAdjustment)
                                                <li class="menu-item nav-adjustments-my-tasks" aria-haspopup="true">
                                                    <a href="{{ route('admin.stock.stock-adjustments.tasks') }}"
                                                       class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">My Tasks</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can(\App\Constants\Permission::CreateAdjustment)
                                                <li class="menu-item nav-adjustments-create" aria-haspopup="true">
                                                    <a href="{{ route('admin.stock.adjustments.create') }}"
                                                       class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Create New</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can(\App\Constants\Permission::ViewAdjustment)
                                                <li class="menu-item nav-adjustments-all" aria-haspopup="true">
                                                    <a href="{{ route('admin.stock.adjustments.index') }}"
                                                       class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">All Adjustments</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                            @endcanany
                        </ul>
                    </div>
                </li>
            @endcanany

            @can('Manage Suppliers')
                <li class="menu-item nav-suppliers">
                    <a href="{{route('admin.suppliers')}}"
                       class="menu-link">

                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo6\dist/../src/media/svg/icons\Communication\Group.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">
                        Suppliers
                    </span>
                    </a>
                </li>
            @endcan
        @endif

    @endcanany
    @canany([\App\Constants\Permission::ManageSystemUsers, \App\Constants\Permission::ManageRoles, \App\Constants\Permission::ManagePermissions])
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
                </ul>
            </div>
        </li>
    @endcanany
    @canany([\App\Constants\Permission::ManageBanks, \App\Constants\Permission::ManageBillCharges, \App\Constants\Permission::ManageRequestType,
    \App\Constants\Permission::ManagePaymentType, \App\Constants\Permission::ManageDocumentTypes, \App\Constants\Permission::ManagePackagingUnits,
    \App\Constants\Permission::ManageRoadCrossTypes, \App\Constants\Permission::ManageWaterUsages, \App\Constants\Permission::ManageWaterNetworks,
     \App\Constants\Permission::ManageWaterNetworkTypes, \App\Constants\Permission::ManageWaterNetwork,
     \App\Constants\Permission::ManageRequestDurationConfigurations, \App\Constants\Permission::ManagePaymentConfigurations])
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
                                <span class="menu-text">System Settings Management</span>
                            </span>
                    </li>
                    @can('Manage Banks')
                        <li class="menu-item nav-banks" aria-haspopup="true">
                            <a href="{{ route('admin.banks') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Banks</span>
                            </a>
                        </li>
                    @endcan
                    @can('Manage Bill Charges')
                        <li class="menu-item nav-bill-charges" aria-haspopup="true">
                            <a href="{{ route('admin.bill.charges') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Bill Charges</span>
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
                    @if(auth()->user()->operator_id)
                        @can('Manage Water Networks')
                            <li class="menu-item nav-water-networks" aria-haspopup="true">
                                <a href="{{ route('admin.water.networks') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Water Networks</span>
                                </a>
                            </li>
                        @endcan
                    @endif
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
                                <span class="menu-text">Water Network</span>
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
                </ul>
            </div>
        </li>
    @endcanany

</ul>

