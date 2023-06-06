<?php

use App\Constants\Permission;
use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\AuditingController;
use App\Http\Controllers\CashMovementController;
use App\Http\Controllers\CellController;
use App\Http\Controllers\ChartAccountController;
use App\Http\Controllers\Client\ClientIssuesController;
use App\Http\Controllers\Client\ClientRequestsController;
use App\Http\Controllers\Client\ClientsController;
use App\Http\Controllers\ClientAuth\ForgotPasswordController;
use App\Http\Controllers\ClientAuth\LoginController;
use App\Http\Controllers\ClientAuth\RegisterController;
use App\Http\Controllers\ClientAuth\ResetPasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IssueReportController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\LedgerMigrationController;
use App\Http\Controllers\MeterRequestController;
use App\Http\Controllers\OperationAreaController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\OperatorUserController;
use App\Http\Controllers\PaymentServiceProviderAccountController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReplyIssueReportController;
use App\Http\Controllers\RequestAssignmentController;
use App\Http\Controllers\RequestDeliveryController;
use App\Http\Controllers\RequestReviewController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\RequestTechnicianController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\UserManualController;
use App\Http\Livewire\CheckBills;
use App\Http\Livewire\Client\IssuesReported;
use App\Http\Livewire\Client\Payments;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [ClientsController::class, 'home'])->name('home')->middleware('auth:client');

Route::get('/help', [ClientsController::class, 'help'])->name('help');
Route::get('/faq', [ClientsController::class, 'faq'])->name('faq');
Route::get('/set-language/{locale}', [HomeController::class, 'setLanguage'])->name('lang.switch');
Route::get('/get-operator-by-district', [HomeController::class, 'getOperatorsByDistrict'])->name('get-operators-by-district');
Route::get('/check-bills', CheckBills::class)->name('check-bills');


Route::get('/cells/{sector}', [CellController::class, 'getCells'])->name('cells');
Route::get('/villages/{cell}', [CellController::class, 'getVillages'])->name('villages');
Route::get('/districts/{province}', [DistrictController::class, 'getByProvince'])->name('districts.province');
Route::get('/sectors/{district}', [SectorController::class, 'getByDistrict'])->name('sectors.district');
Route::get('/documents-types/{legalType}', [DocumentTypeController::class, 'getByLegalType'])->name('type-document.get-by-legal-type');
Route::get('/fetch-nida-id', [RegisterController::class, 'fetchIdentificationFromNIDA'])->name('fetch-identification-from-nida');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/profile/{user_id}', [App\Http\Controllers\UserController::class, 'userProfile'])->name('users.profile');
    Route::group(['prefix' => 'operators', 'as' => 'operator.'], function () {

        Route::get('/', [OperatorController::class, 'index'])->name('index');
        Route::post('/store', [OperatorController::class, 'store'])->name('store');
        Route::get('/edit/{operator}', [OperatorController::class, 'edit'])->name('edit');
        Route::put('/update/{operator}', [OperatorController::class, 'update'])->name('update');
        Route::delete('/delete/{operator}', [OperatorController::class, 'destroy'])->name('delete');
        Route::get('/show/{operator}', [OperatorController::class, 'show'])->name('show');
        Route::get('/operator-details', [OperatorController::class, 'operatorDetails'])->name('details');
        Route::get('/{operator}/details-page', [OperatorController::class, 'details'])->name('details-page');

        Route::get('/{operator}/operation-areas', [OperationAreaController::class, 'index'])->name('area-of-operation.index');
        Route::post('/{operator}/operation-areas', [OperationAreaController::class, 'store'])->name('area-of-operation.store');
        Route::delete('/operation-areas/{operationArea}', [OperationAreaController::class, 'destroy'])->name('area-of-operation.destroy');
        Route::get('/operation-areas/{operationArea}', [OperationAreaController::class, 'show'])->name('area-of-operation.show');

        Route::get('/operation-areas/{id}/get', [OperationAreaController::class, 'getAreaOfOperations'])->name('get-area-of-operations');

        Route::get('/{operator}/users', [OperatorUserController::class, 'index'])->name('users');

        Route::get('operating-area/{operator_area}/users', [OperatorUserController::class, 'operatorAreaUsers'])->name('operator-area-users');

        Route::get('/export', [OperatorController::class, 'exportToExcel'])->name('export-to-excel');

    });
    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/get-nida-id-details', [CustomerController::class, 'fetchIdentificationFromNIDA'])->name('fetch-identification-from-nida');
        Route::post('/store', [CustomerController::class, 'store'])->name('store');
        Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::delete('/delete/{customer}', [CustomerController::class, 'destroy'])->name('delete');
        Route::get('/{customer}/connections', [CustomerController::class, 'connections'])->name('connections');
    });
    Route::group(['prefix' => 'requests', 'as' => 'requests.'], function () {
        Route::get('/', [RequestsController::class, 'index'])->name('index');
        Route::post('/', [RequestsController::class, 'store'])->name('store');
        Route::get('/create', [RequestsController::class, 'create'])->name('create')->can(Permission::CreateRequest);
        Route::get('/{request}/show', [RequestsController::class, 'show'])->name('show');
        Route::get('/{request}/edit', [RequestsController::class, 'edit'])->name('edit');
        Route::put('/{appRequest}/update', [RequestsController::class, 'update'])->name('update');
        Route::delete('/{request}/delete', [RequestsController::class, 'destroy'])->name('delete');

        Route::group(['middleware' => 'can:' . Permission::AssignRequest], function () {
            Route::get('/new', [RequestsController::class, 'newRequests'])->name('new');
            Route::post('/requests/assign', [RequestAssignmentController::class, 'assignRequests'])->name('assign');
            Route::post('/requests/re-assign', [RequestAssignmentController::class, 'reAssign'])->name('re-assign');
            Route::get('/assigned', [RequestsController::class, 'assignedRequests'])->name('assigned');
        });

        Route::get('/my-tasks', [RequestsController::class, 'myTasks'])->name('my-tasks');

        Route::post('/{request}/save-item', [RequestReviewController::class, 'storeItem'])->name('save-item');
        Route::delete('/{request}/item/{id}/delete', [RequestReviewController::class, 'deleteRequestItem'])->name('delete-request-item');
        Route::post('/{req}/add-water-network', [RequestReviewController::class, 'addWaterNetwork'])->name('add-water-network');
        Route::post('/{request}/reviews/save', [RequestReviewController::class, 'saveReview'])->name('reviews.save');

        Route::post('/{request}/technician/save', [RequestTechnicianController::class, 'store'])->name('technician.save');
        Route::delete('/technician/{id}/delete', [RequestTechnicianController::class, 'destroy'])->name('technician.delete');

        Route::post('/{request}/assign-meter-number', [MeterRequestController::class, 'store'])->name('assign-meter-number');
        Route::delete('/meter-number/{id}/destroy', [MeterRequestController::class, 'destroy'])->name('meter-number.destroy');

        Route::get('/to-be-delivered', [RequestsController::class, 'toBeDelivered'])->name('to-be-delivered');
        Route::get('/{request}/item-delivery', [RequestDeliveryController::class, 'index'])->name('delivery-request.index');
        Route::post('/{request}/item-delivery', [RequestDeliveryController::class, 'store'])->name('delivery-request.store');
        Route::get('/delivery/{id}/items', [RequestDeliveryController::class, 'items'])->name('delivery.items');
        Route::get('/delivery/{id}/print-delivery', [RequestDeliveryController::class, 'deliveryNote'])->name('print-delivery');
        Route::post('/delivery/{id}/upload-delivery-note', [RequestDeliveryController::class, 'uploadDeliveryNote'])->name('upload-delivery-note');
        Route::get('/delivery/{request}/print-receipt', [RequestDeliveryController::class, 'printDelivery'])->name('print-receipt');

        Route::get('/export', [RequestsController::class, 'exportDataToExcel'])->name('export-data-to-excel');

    });
    Route::group(['prefix' => 'purchases', 'as' => 'purchases.'], function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('index');
        Route::get('/new', [PurchaseController::class, 'index'])->name('new');
        Route::get('/pending', [PurchaseController::class, 'index'])->name('pending');
        Route::post('/store', [PurchaseController::class, 'store'])->name('store');
        Route::get('/create', [PurchaseController::class, 'create'])->name('create');
        Route::patch('/{purchase}/submit', [PurchaseController::class, 'submit'])->name('submit');

        Route::get('/{purchase}/show', [PurchaseController::class, 'show'])->name('show');
        Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('edit');
        Route::put('/{purchase}/update', [PurchaseController::class, 'update'])->name('update');
        Route::delete('/{purchase}/delete', [PurchaseController::class, 'destroy'])->name('destroy');
        Route::post('/{purchase}/submit-review', [PurchaseController::class, 'submitReview'])->name('submit-review');

        Route::get('/export', [PurchaseController::class, 'exportDataToExcel'])->name('export-data-to-excel');
    });
    Route::group(['prefix' => 'accounting', 'as' => 'accounting.'], function () {
        Route::get('/chart-of-accounts', [ChartAccountController::class, 'index'])->name('chart-of-accounts');
        Route::get('/bank-accounts', [PaymentServiceProviderAccountController::class, 'index'])->name('bank-accounts.index');
        Route::post('/bank-accounts/store', [PaymentServiceProviderAccountController::class, 'store'])->name('bank-accounts.store');
        Route::delete('/bank-accounts/{id}/delete', [PaymentServiceProviderAccountController::class, 'destroy'])->name('bank-accounts.delete');
        Route::get('/bank-accounts/{paymentServiceProviderAccount}/show', [PaymentServiceProviderAccountController::class, 'show'])->name('bank-accounts.show');
        Route::get('/bank-accounts/{paymentServiceProviderAccount}/edit', [PaymentServiceProviderAccountController::class, 'accountsByServiceProvider'])
            ->name('provider-service-by-accounts');

        Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
        Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('/expenses/{expense}/show', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::delete('/expenses/{expense}/delete', [ExpenseController::class, 'destroy'])->name('expenses.delete');
        Route::get('/expenses/{id}/expense-ledgers', [ExpenseController::class, 'getExpenseLedgers'])->name('expense-ledgers');

        Route::get('/cash-movements', [CashMovementController::class, 'index'])->name('cash-movements.index');
        Route::post('/cash-movements/store', [CashMovementController::class, 'store'])->name('cash-movements.store');
        Route::delete('/cash-movements/{id}/delete', [CashMovementController::class, 'destroy'])->name('cash-movements.delete');
        Route::get('/cash-movements/{cashMovement}/show', [CashMovementController::class, 'show'])->name('cash-movements.show');

        Route::get('/journal-entries', [JournalEntryController::class, 'index'])->name('journal-entries');
        Route::post('/journal-entries/store', [JournalEntryController::class, 'store'])->name('journal-entries.store');
        Route::get('/journal-entries/{journalEntry}/show', [JournalEntryController::class, 'show'])->name('journal-entries.show');
        Route::delete('/journal-entries/{journalEntry}/delete', [JournalEntryController::class, 'destroy'])->name('journal-entries.delete');

        Route::get('/ledger-migration', [LedgerMigrationController::class, 'index'])->name('ledger-migration.index');
        Route::post('/ledger-migration', [LedgerMigrationController::class, 'store'])->name('ledger-migration.store');
        Route::get('/ledger-migration/{ledgerMigration}/show', [LedgerMigrationController::class, 'show'])->name('ledger-migration.show');
        Route::delete('/ledger-migration/{ledgerMigration}/delete', [LedgerMigrationController::class, 'destroy'])->name('ledger-migration.delete');
        Route::post('/ledger-migration/validate', [LedgerMigrationController::class, 'validateData'])->name('ledger-migration.validate');

    });
    Route::prefix('user-management')->group(function () {
        //roles routes
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles/update/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/add-permissions-to-role/{role_id}', [RoleController::class, 'addPermissionToRole'])->name('roles.add.permissions');
        Route::get('/add-roles-to-user/{user_id}', [RoleController::class, 'addRoleToUser'])->name('user.add.roles');
        Route::post('/add-roles-to-user/store', [RoleController::class, 'storeRoleToUser'])->name('user.add.roles.store');
        Route::post('/add-permissions-to-role/store', [RoleController::class, 'storePermissionToRole'])->name('permissions_to_role.store');
        Route::delete('/roles/{role}/delete', [RoleController::class, 'destroy'])->name('roles.delete');

        Route::get('/permissions/add-permission-to-user/{user_id}', [App\Http\Controllers\PermissionController::class, 'addPermissionToUser'])->name('user.add.permissions');
        Route::post('/permissions/add-permissions-to-user/store', [App\Http\Controllers\PermissionController::class, 'storePermissionToUser'])->name('permissions_to_user.store');

        //end here

        //permission routes
        Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/permissions/update/{permission_id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
        Route::post('/permissions/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
        //
        Route::get('/permissions/add-permission-to-user/{user_id}', [App\Http\Controllers\PermissionController::class, 'addPermissionToUser'])->name('user.add.permissions');
        Route::post('/permissions/add-permissions-to-user/store', [App\Http\Controllers\PermissionController::class, 'storePermissionToUser'])->name('permissions_to_user.store');

        //users routes
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::post('/users/update/{user_id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::get('/users/profile/{user_id}', [App\Http\Controllers\UserController::class, 'userProfile'])->name('users.profile');
        Route::get('/users/delete/{user_id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('users.delete');
        //user permissions
        Route::get('/users/permissions/{user_id}', [App\Http\Controllers\UserController::class, 'userPermissions'])->name('users.permissions');

        //Profile URL
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('update.profile');

        //Reset user password
        Route::get('/users/reset-password/{user_id}', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset.password');
        Route::get('/users/change-password', [App\Http\Controllers\ProfileController::class, 'changePasswordForm'])->name('user.change.password');
        Route::post('/users/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('user.update.password');

        //assign district to user
        Route::post('/users/assign-district/{user_id}', [App\Http\Controllers\UserController::class, 'assignDistrict'])->name('users.assign.district.store');

        //user manual
        Route::get('/users/user-manual/', [App\Http\Controllers\UserManualController::class, 'userManualForAdmins'])->name('user.manual.admin');

    });
    Route::prefix('settings')->group(function () {
        //request types
        Route::get('/request_types', [App\Http\Controllers\RequestTypeController::class, 'index'])->name('request.types');
        Route::post('/request_type/store', [App\Http\Controllers\RequestTypeController::class, 'store'])->name('request.type.store');
        Route::post('/request_type/update', [App\Http\Controllers\RequestTypeController::class, 'update'])->name('request.type.edit');
        Route::get('/request_type/delete/{id}', [App\Http\Controllers\RequestTypeController::class, 'destroy'])->name('request.type.delete');

        //payment types
        Route::get('/payment_types', [App\Http\Controllers\PaymentTypeController::class, 'index'])->name('payment.types');
        Route::post('/payment_type/store', [App\Http\Controllers\PaymentTypeController::class, 'store'])->name('payment.type.store');
        Route::post('/payment_type/update', [App\Http\Controllers\PaymentTypeController::class, 'update'])->name('payment.type.edit');
        Route::get('/payment_type/delete/{id}', [App\Http\Controllers\PaymentTypeController::class, 'destroy'])->name('payment.type.delete');

        //request duration configurations
        Route::get('/request_duration_configurations', [App\Http\Controllers\RequestDurationConfigurationController::class, 'index'])->name('request.duration.configurations');
        Route::post('/request_duration_configuration/store', [App\Http\Controllers\RequestDurationConfigurationController::class, 'store'])->name('request.duration.configuration.store');
        Route::post('/request_duration_configuration/update', [App\Http\Controllers\RequestDurationConfigurationController::class, 'update'])->name('request.duration.configuration.edit');
        Route::get('/request_duration_configuration/delete/{id}', [App\Http\Controllers\RequestDurationConfigurationController::class, 'destroy'])->name('request.duration.configuration.delete');
        Route::get('/export_request_duration_configuration/', [App\Http\Controllers\RequestDurationConfigurationController::class, 'export'])->name('export.request.duration.configuration');

        //payment configurations
        Route::get('/payment_configurations', [App\Http\Controllers\PaymentConfigurationController::class, 'index'])->name('payment.configurations');
        Route::post('/payment_configuration/store', [App\Http\Controllers\PaymentConfigurationController::class, 'store'])->name('payment.configuration.store');
        Route::post('/payment_configuration/update', [App\Http\Controllers\PaymentConfigurationController::class, 'update'])->name('payment.configuration.edit');
        Route::get('/payment_configuration/delete/{id}', [App\Http\Controllers\PaymentConfigurationController::class, 'destroy'])->name('payment.configuration.delete');
        Route::get('/operation_areas/{id}', [App\Http\Controllers\PaymentConfigurationController::class, 'loadAreaOperation']);
        Route::get('/export_payment_configuration', [App\Http\Controllers\PaymentConfigurationController::class, 'export'])->name('export.payment.configuration');

        Route::get('/operation_areas/{id}', [App\Http\Controllers\PaymentConfigurationController::class, 'loadAreaOperation']);
        //payment mappings
        Route::get('/payment_mappings/{id}', [App\Http\Controllers\PaymentMappingController::class, 'index'])->name('payment.mappings');
        Route::post('/payment_mapping/store/{payment_configuration_id}', [App\Http\Controllers\PaymentMappingController::class, 'store'])->name('payment.mapping.store');
        Route::post('/payment_mapping/update', [App\Http\Controllers\PaymentMappingController::class, 'update'])->name('payment.mapping.edit');
        Route::get('/payment_mapping/delete/{id}', [App\Http\Controllers\PaymentMappingController::class, 'destroy'])->name('payment.mapping.delete');
        Route::get('/psp_account_number/{id}', [App\Http\Controllers\PaymentMappingController::class, 'loadPspAccount']);

        //packaging units
        Route::get('/packaging_units', [App\Http\Controllers\PackagingUnitController::class, 'index'])->name('packaging.units');
        Route::post('/packaging_unit/store/', [App\Http\Controllers\PackagingUnitController::class, 'store'])->name('packaging.unit.store');
        Route::post('/packaging_unit/update', [App\Http\Controllers\PackagingUnitController::class, 'update'])->name('packaging.unit.edit');
        Route::get('/packaging_unit/delete/{id}', [App\Http\Controllers\PackagingUnitController::class, 'destroy'])->name('packaging.unit.delete');

        //document types
        Route::get('/document_types', [App\Http\Controllers\DocumentTypeController::class, 'index'])->name('document.types');
        Route::post('/document_type/store', [App\Http\Controllers\DocumentTypeController::class, 'store'])->name('document.type.store');
        Route::post('/document_type/update', [App\Http\Controllers\DocumentTypeController::class, 'update'])->name('document.type.edit');
        Route::get('/document_type/delete/{id}', [App\Http\Controllers\DocumentTypeController::class, 'destroy'])->name('document.type.delete');

        //road cross types
        Route::get('/road_cross_types', [App\Http\Controllers\RoadCrossTypeController::class, 'index'])->name('road.cross.types');

        //water usages
        Route::get('/water_usages', [App\Http\Controllers\WaterUsageController::class, 'index'])->name('water.usages');

        //water network types
        Route::get('/water_network_types', [App\Http\Controllers\WaterNetworkTypeController::class, 'index'])->name('water.network.types');
        Route::post('/water_network_type/store', [App\Http\Controllers\WaterNetworkTypeController::class, 'store'])->name('water.network.type.store');
        Route::post('/water_network_type/update', [App\Http\Controllers\WaterNetworkTypeController::class, 'update'])->name('water.network.type.edit');
        Route::get('/water_network_type/delete/{id}', [App\Http\Controllers\WaterNetworkTypeController::class, 'destroy'])->name('water.network.type.delete');

        //water networks

        Route::get('/water_networks', [App\Http\Controllers\WaterNetworkController::class, 'index'])->name('water.networks');
        Route::post('/water_network/store', [App\Http\Controllers\WaterNetworkController::class, 'store'])->name('water.network.store');
        Route::post('/water_network/update', [App\Http\Controllers\WaterNetworkController::class, 'update'])->name('water.network.edit');
        Route::get('/water_network/delete/{id}', [App\Http\Controllers\WaterNetworkController::class, 'destroy'])->name('water.network.delete');
        Route::get('/operation_areas/{id}', [App\Http\Controllers\WaterNetworkController::class, 'loadAreaOperation']);
        Route::get('/export_water_networks', [App\Http\Controllers\WaterNetworkController::class, 'export'])->name('export.water.networks');

        //institutions
        Route::get('/institutions/', [App\Http\Controllers\InstitutionController::class, 'index'])->name('institutions');
        Route::post('/institution/store', [App\Http\Controllers\InstitutionController::class, 'store'])->name('institution.store');
        Route::post('/institution/update', [App\Http\Controllers\InstitutionController::class, 'update'])->name('institution.edit');
        Route::get('/institution/delete/{id}', [App\Http\Controllers\InstitutionController::class, 'destroy'])->name('institution.delete');

        //assign user to institution
        Route::get('/assign-user/{user_id}', [App\Http\Controllers\AssignUserToInstitutionController::class, 'index'])->name('assign.user');
        Route::post('/assign-user/store/', [App\Http\Controllers\AssignUserToInstitutionController::class, 'store'])->name('assign.user.store');
        Route::post('/assign-user/update', [App\Http\Controllers\AssignUserToInstitutionController::class, 'update'])->name('assign.user.edit');
        Route::get('/assign-user/delete/{id}', [App\Http\Controllers\AssignUserToInstitutionController::class, 'destroy'])->name('assign.user.delete');

        //water network statuses
        Route::get('/water_network_statuses', [App\Http\Controllers\WaterNetworkStatusController::class, 'index'])->name('water.network.statuses');
        Route::post('/water_network_status/store', [App\Http\Controllers\WaterNetworkStatusController::class, 'store'])->name('water.network.status.store');
        Route::post('/water_network_status/update', [App\Http\Controllers\WaterNetworkStatusController::class, 'update'])->name('water.network.status.edit');
        Route::get('/water_network_status/delete/{id}', [App\Http\Controllers\WaterNetworkStatusController::class, 'destroy'])->name('water.network.status.delete');

        //suppliers
        Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers');
        Route::post('/supplier/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
        Route::post('/supplier/update', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.edit');
        Route::get('/supplier/delete/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('supplier.delete');

        //bill charges
        Route::get('/bill_charges', [App\Http\Controllers\BillChargeController::class, 'index'])->name('bill.charges');
        Route::post('/bill_charge/store', [App\Http\Controllers\BillChargeController::class, 'store'])->name('bill.charge.store');
        Route::post('/bill_charge/update', [App\Http\Controllers\BillChargeController::class, 'update'])->name('bill.charge.edit');
        Route::get('/bill_charge/delete/{id}', [App\Http\Controllers\BillChargeController::class, 'destroy'])->name('bill.charge.delete');
        Route::get('/operation_areas/{id}', [App\Http\Controllers\BillChargeController::class, 'loadAreaOperation']);
        Route::get('/export_bill_charges/', [App\Http\Controllers\BillChargeController::class, 'export'])->name('export.bill.charges');

        //faqs
        Route::get('/faqs', [App\Http\Controllers\FaqController::class, 'index'])->name('faq');
        Route::post('/faq/store', [App\Http\Controllers\FaqController::class, 'store'])->name('faq.store');
        Route::post('/faq/update', [App\Http\Controllers\FaqController::class, 'update'])->name('faq.edit');
        Route::get('/faqs/delete/{id}', [App\Http\Controllers\FaqController::class, 'destroy'])->name('faq.delete');

        //user manuals
        Route::get('/user_manuals', [App\Http\Controllers\UserManualController::class, 'index'])->name('user.manuals');
        Route::post('/user_manual/store', [App\Http\Controllers\UserManualController::class, 'store'])->name('user.manual.store');
        Route::post('/user_manual/update', [App\Http\Controllers\UserManualController::class, 'update'])->name('user.manual.edit');
        Route::get('/user-manuals/{id}/destroy', [UserManualController::class, 'destroy'])->name('user.manual.delete');
        Route::get('/user-manuals/{slug}/download', [UserManualController::class, 'download'])->name('user.manuals.download');

        Route::get('/operation-areas/by-water-network-type', [App\Http\Controllers\BillChargeController::class, 'loadAreaOperationAreas'])->name('bill-charge.load-area-operation-areas');

        Route::get('/banks', [App\Http\Controllers\PaymentServiceProviderController::class, 'index'])->name('banks');
        Route::get('/banks/sync', [App\Http\Controllers\PaymentServiceProviderController::class, 'syncBanks'])->name('banks.sync');
        Route::post('/banks/add', [App\Http\Controllers\PaymentServiceProviderController::class, 'addBank'])->name('banks.add');
        Route::get('/banks/delete/{bankId}', [App\Http\Controllers\PaymentServiceProviderController::class, 'deleteBank'])->name('banks.destroy');
        Route::post('/banks/update/{bankId}', [App\Http\Controllers\PaymentServiceProviderController::class, 'updateBank'])->name('banks.update');

    });
    Route::prefix('stock-management')->name('stock.')->group(function () {
        Route::resource('item-categories', ItemCategoryController::class);
        Route::get('/item-categories/{itemCategory}/items', [App\Http\Controllers\ItemCategoryController::class, 'items'])->name('item-categories.items');
        Route::resource('items', ItemController::class);
        Route::get('/items-by-category/{categoryId}', [ItemController::class, 'itemsByCategory'])->name('items.by-category');
        Route::get('/stock-items', [App\Http\Controllers\StockController::class, 'index'])->name('stock-items.index');
        Route::get('/stock-items/{item}', [App\Http\Controllers\StockController::class, 'show'])->name('stock-items.show');
        Route::get('/stock-movements', [App\Http\Controllers\StockMovementController::class, 'index'])->name('stock-items.movements');
        Route::get('/stock-movements/{movement}', [App\Http\Controllers\StockMovementController::class, 'show'])->name('stock-items.movements.show');
        Route::get('/stock-movements/{movement}/history', [App\Http\Controllers\StockMovementController::class, 'history'])->name('stock-items.movements.history');

        //stock adjustment
        Route::resource('/adjustments', AdjustmentController::class);
        Route::get('/adjustments/{adjustment}/items', [App\Http\Controllers\AdjustmentController::class, 'items'])->name('stock-adjustments.items');
        Route::post('/adjustments/add/items', [App\Http\Controllers\AdjustmentController::class, 'addItem'])->name('stock-adjustments.items.add');
        Route::delete('/adjustments/{adjustment}/items/{item}', [App\Http\Controllers\AdjustmentController::class, 'removeItem'])->name('stock-adjustments.items.remove');

        Route::get('/adjustment/my-tasks', [App\Http\Controllers\AdjustmentController::class, 'myTasks'])->name('stock-adjustments.tasks');
        //submit adjustment
        Route::post('/adjustments/{adjustment}/submit', [App\Http\Controllers\AdjustmentController::class, 'submit'])->name('stock-adjustments.submit');
        //submit review
        Route::post('/adjustments/{adjustment}/review', [App\Http\Controllers\AdjustmentController::class, 'review'])->name('stock-adjustments.review');
        //adjustment new
        Route::get('/new-adjustment', [App\Http\Controllers\AdjustmentController::class, 'createNewAdjustment'])->name('stock-adjustments.new');

    });
    Route::group(['prefix' => 'billings', 'as' => 'billings.'], function () {
        Route::get('/', [App\Http\Controllers\BillingController::class, 'index'])->name('index');
        //show details
        Route::get('/{billing}', [App\Http\Controllers\BillingController::class, 'show'])->name('show');
        //customer billings
        Route::get('/customer/{customer}', [App\Http\Controllers\BillingController::class, 'customerBillings'])->name('customer');
        //download bill
        Route::get('/{billing}/download', [App\Http\Controllers\BillingController::class, 'download'])->name('download');

        //bill history
        Route::get('/{billing}/history', [App\Http\Controllers\BillingController::class, 'history'])->name('history');
        //meter billings
        Route::get('/meter/{meter}/subscription/{subscription}', [App\Http\Controllers\BillingController::class, 'meterBillings'])->name('meter');
    });
    Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
        Route::get('/', [App\Http\Controllers\PaymentDeclarationController::class, 'index'])->name('index');
        //payment history
        Route::get('/{payment_declaration}/history', [App\Http\Controllers\PaymentDeclarationController::class, 'history'])->name('history');
    });

    //    audits routes
    Route::group(['prefix' => 'audits'], function () {
        Route::get('/audits', [AuditingController::class, 'index'])->name('audits.index');
        Route::get('/audits-from/{start}/to/{end}', [AuditingController::class, 'customAudits'])->name('audits.custom');
    });

    Route::group(['prefix' => 'issues', 'as' => 'issues.'], function () {
        Route::get('/reported', [IssueReportController::class, 'reportedIssues'])
            ->name('reported');
        Route::put('/{issueReport}/reply', [ReplyIssueReportController::class, 'replyIssue'])
            ->name('reply');
        Route::get('/issue-reporting', [App\Http\Controllers\IssuesReportingContrller::class, 'reportingIssues'])->name('issues.reporting');
        Route::post('/issue-reporting/store', [App\Http\Controllers\IssuesReportingContrller::class, 'store'])->name('issue.reporting.store');
    });

});

Auth::routes(['register' => false]);

//ajax routes
Route::get('/operation-area', [OperationAreaController::class, 'getOperationAreasByOperators'])->name('get-operation-areas');
Route::get('/Operator-operation-areas', [OperationAreaController::class, 'getOperationAreasByOperator'])->name('operator-operation-areas');
//officers by operation area
Route::get('/operation-area-officers', [OperationAreaController::class, 'getOfficersByOperationArea'])->name('get-operation-area-officers');
Route::get('/operation-areas-by-district', [OperationAreaController::class, 'getAreasByDistrict'])->name('get-operation-areas-by-district');
//get items by categories
Route::get('/items-by-categories', [ItemController::class, 'getItemsByCategories'])->name('get-items-by-categories');
//get items by categories
Route::get('item-unit-price/{item}', [ItemController::class, 'getItemUnitPrice'])->name('items.get-unit-price');

Route::get('/user-manuals/{slug}/download', [UserManualController::class, 'download'])->name('user.manuals.download');

Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.attempt');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.email');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);

    Route::group(['middleware' => 'auth:client'], function () {
        Route::get('/profile', [ClientsController::class, 'profile'])->name('profile');
        Route::put('/profile/{client}/update', [ClientsController::class, 'updateProfile'])
            ->name('profile.update');
        Route::get('/new-connection/request', [ClientRequestsController::class, 'newConnection'])->name('connection-new');
        //client change password
        Route::post('/change-password', [ClientsController::class, 'updatePassword'])->name('update-password');

        Route::post('/new-connection/{operator}', [ClientRequestsController::class, 'requestNewConnection'])
            ->name('request-new-connection');
        Route::get('/requests/{request}/details', [ClientRequestsController::class, 'details'])->name('request-details');
        Route::get('/requests/{request}/edit', [ClientRequestsController::class, 'edit'])->name('requests.edit');
        Route::put('/requests/{appRequest}/update', [ClientRequestsController::class, 'update'])->name('requests.update');

        Route::get('/billings', App\Http\Livewire\Client\ClientBilling::class)->name('billings');
        Route::get('/payments', Payments::class)->name('payments');

        Route::get('/requests', [ClientsController::class, 'requests'])->name('requests');
        Route::get('/issues', [ClientIssuesController::class, 'index'])->name('issues-reported');
        Route::post('/issues', [ClientIssuesController::class, 'store'])->name('client-issues.store');

    });


});
