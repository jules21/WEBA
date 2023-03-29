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
    @if( auth()->user()->can(\App\Constants\Permission::ManageCustomers) && auth()->user()->operator_id )
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
    @if(auth()->user()->can(\App\Constants\Permission::ManageOperationAreas) && auth()->user()->operator_id && is_null(auth()->user()->operation_area))
        <li class="menu-item nav-operation-areas">
            <a href="{{route('admin.operator.area-of-operation.index',encryptId(auth()->user()->operator_id))}}"
               class="menu-link">
                    <span class="menu-icon svg-icon">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                               <path d="M9 4v13"></path>
                               <path d="M15 7v5.5"></path>
                               <path
                                   d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                               <path d="M19 18v.01"></path>
                            </svg>
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
                        Billing
                    </span>
            </a>
        </li>
    @endif
    @if(auth()->user()->can(\App\Constants\Permission::ManagePayment))
        <li class="menu-item nav-payments">
            <a href="{{route('admin.payments.index')}}"
               class="menu-link">
                    <span class="menu-icon svg-icon">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
   <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
   <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path>
</svg>
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




    @if(auth()->user()->canAny(accountingAllPermissions()) && auth()->user()->operator_id)

        <li class="menu-section">
            <h4 class="menu-text">
                Accounting & Finance
            </h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>

        @if(auth()->user()->canAny(accountingPermissions()) )
            <li class="menu-item menu-item-submenu nav-accounting" aria-haspopup="true"
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
                                         route=""/>
                        @endcan

                        @can(\App\Constants\Permission::ViewLedgerBalance)
                            <x-menu-item title="Ledger Balances" item-class="nav-chart-accounts"
                                         route=""/>
                        @endcan


                    </ul>
                </div>
            </li>
        @endif

        @if(auth()->user()->canAny(accountingSettingsPermissions()))
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

                        @can(\App\Constants\Permission::ManageLedgerMigration)
                            <x-menu-item title="Ledger Migration" item-class="nav-ledger-migration"
                                         :route="route('admin.accounting.ledger-migration.index')"/>
                        @endcan
                        @can(\App\Constants\Permission::ManageChartOfAccounts)
                            <x-menu-item title="Chart Of Accounts" item-class="nav-chart-accounts"
                                         :route="route('admin.accounting.chart-of-accounts')"/>
                        @endcan

                        @can(\App\Constants\Permission::ManageBankAccounts)
                            <x-menu-item title="Bank Accounts" item-class="nav-bank-accounts"
                                         :route="route('admin.accounting.bank-accounts.index')"/>
                        @endcan

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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="24"
                             height="24"
                             viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round"
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
                            @if(Helper::hasOperationArea())
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
                            @endif
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
                <li class="menu-item menu-item-submenu nav-stock-managements" aria-haspopup="true"
                    data-menu-toggle="hover">
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
                                            @if(Helper::hasOperationArea())
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
                                            @endif
                                            @can(\App\Constants\Permission::ViewAdjustment)
                                                <li class="menu-item nav-adjustments-all" aria-haspopup="true">
                                                    <a href="{{ route('admin.stock.adjustments.index') }}"
                                                       class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">All </span>
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

                        <span class="svg-icon menu-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery"
                               width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                               fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                               <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                               <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                               <path d="M3 9l4 0"></path>
                            </svg>
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
{{--                    @if(auth()->user()->operator_id)--}}
{{--                        @can('Manage Water Networks')--}}
{{--                            <li class="menu-item nav-water-networks" aria-haspopup="true">--}}
{{--                                <a href="{{ route('admin.water.networks') }}" class="menu-link">--}}
{{--                                    <i class="menu-bullet menu-bullet-dot">--}}
{{--                                        <span></span>--}}
{{--                                    </i>--}}
{{--                                    <span class="menu-text">Water Networks</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    @endif--}}
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
                                <span class="menu-text">Water Networks</span>
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
                </ul>
            </div>
        </li>
    @endcanany
    <li class="menu-section">
        <h4 class="menu-text">Audits</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    @can('Manage System Audits')
        <li class="menu-item nav-audits">
            <a href="{{route('admin.audits.index')}}"
               class="menu-link">
                <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo6\dist/../src/media/svg/icons\Code\Time-schedule.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="icon icon-tabler icon-tabler-truck-delivery">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" fill="#000000"/>
                            <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
                <span class="menu-text">
                        System Audit
                    </span>
            </a>
        </li>
    @endcan
</ul>

