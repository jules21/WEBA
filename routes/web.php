<?php

use App\Constants\Permission;
use App\Http\Controllers\AreaOfOperationController;
use App\Http\Controllers\CellController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MeterRequestController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RequestAssignmentController;
use App\Http\Controllers\RequestReviewController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\RequestTechnicianController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/cells/{sector}', [CellController::class, 'getCells'])->name('cells');
Route::get('/villages/{cell}', [CellController::class, 'getVillages'])->name('villages');
Route::get('/districts/{province}', [DistrictController::class, 'getByProvince'])->name('districts.province');
Route::get('/sectors/{district}', [SectorController::class, 'getByDistrict'])->name('sectors.district');
Route::get('/documents-types/{legalType}', [DocumentTypeController::class, 'getByLegalType'])->name('type-document.get-by-legal-type');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("/users/profile/{user_id}", [App\Http\Controllers\UserController::class, 'userProfile'])->name("users.profile");

    Route::group(['prefix' => 'operators', 'as' => 'operator.'], function () {

        Route::get('/', [OperatorController::class, 'index'])->name('index');
        Route::post('/store', [OperatorController::class, 'store'])->name('store');
        Route::get('/edit/{operator}', [OperatorController::class, 'edit'])->name('edit');
        Route::put('/update/{operator}', [OperatorController::class, 'update'])->name('update');
        Route::delete('/delete/{operator}', [OperatorController::class, 'destroy'])->name('delete');
        Route::get('/show/{operator}', [OperatorController::class, 'show'])->name('show');
        Route::get("/operator-details", [OperatorController::class, 'operatorDetails'])->name('details');

        Route::get("/{operator}/operation-areas", [AreaOfOperationController::class, 'index'])->name('area-of-operation.index');
        Route::post("/{operator}/operation-areas", [AreaOfOperationController::class, 'store'])->name('area-of-operation.store');
        Route::delete("/operation-areas/{areaOfOperation}", [AreaOfOperationController::class, 'destroy'])->name('area-of-operation.destroy');
        Route::get("/operation-areas/{areaOfOperation}", [AreaOfOperationController::class, 'show'])->name('area-of-operation.show');

        Route::get('/operation-areas/{id}/get', [AreaOfOperationController::class, 'getAreaOfOperations'])->name('get-area-of-operations');

    });

    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::post('/store', [CustomerController::class, 'store'])->name('store');
        Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::delete('/delete/{customer}', [CustomerController::class, 'destroy'])->name('delete');
        Route::get('/{customer}/connections',[CustomerController::class, 'connections'])->name('connections');
    });


    Route::group(['prefix' => 'requests', 'as' => 'requests.'], function () {
        Route::get('/', [RequestsController::class, 'index'])->name('index');
        Route::post('/', [RequestsController::class, 'store'])->name('store');
        Route::get('/create', [RequestsController::class, 'create'])->name('create')->can(Permission::CreateRequest);
        Route::get('/{request}/show', [RequestsController::class, 'show'])->name('show');
        Route::get('/{request}/edit', [RequestsController::class, 'edit'])->name('edit');
        Route::put('/{request}/update', [RequestsController::class, 'update'])->name('update');
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
        Route::post('/{request}/reviews/save', [RequestReviewController::class, 'saveReview'])->name('reviews.save');

        Route::post('/{request}/technician/save', [RequestTechnicianController::class, 'store'])->name('technician.save');
        Route::delete('/technician/{id}/delete', [RequestTechnicianController::class, 'destroy'])->name('technician.delete');

        Route::post('/{request}/assign-meter-number', [MeterRequestController::class, 'store'])->name('assign-meter-number');
        Route::delete('/meter-number/{id}/destroy', [MeterRequestController::class, 'destroy'])->name('meter-number.destroy');
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

    });


    Route::prefix('user-management')->group(function () {
        //roles routes
        Route::get("/roles", [RoleController::class, 'index'])->name("roles.index");
        Route::post("/roles/update/{role}", [RoleController::class, 'update'])->name("roles.update");
        Route::post("/roles/store", [RoleController::class, 'store'])->name("roles.store");
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
        Route::get("/users", [App\Http\Controllers\UserController::class, 'index'])->name("users.index");
        Route::post("/users/store", [App\Http\Controllers\UserController::class, 'store'])->name("users.store");
        Route::post("/users/update/{user_id}", [App\Http\Controllers\UserController::class, 'update'])->name("users.update");
        Route::get("/users/profile/{user_id}", [App\Http\Controllers\UserController::class, 'userProfile'])->name("users.profile");

        //Profile URL
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('update.profile');

        //Reset user password
        Route::get('/users/reset-password/{user_id}', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset.password');
        Route::get('/users/change-password', [App\Http\Controllers\ProfileController::class, 'changePasswordForm'])->name('user.change.password');
        Route::post('/users/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('user.update.password');

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

        //payment configurations
        Route::get('/payment_configurations', [App\Http\Controllers\PaymentConfigurationController::class, 'index'])->name('payment.configurations');
        Route::post('/payment_configuration/store', [App\Http\Controllers\PaymentConfigurationController::class, 'store'])->name('payment.configuration.store');
        Route::post('/payment_configuration/update', [App\Http\Controllers\PaymentConfigurationController::class, 'update'])->name('payment.configuration.edit');
        Route::get('/payment_configuration/delete/{id}', [App\Http\Controllers\PaymentConfigurationController::class, 'destroy'])->name('payment.configuration.delete');

        //packaging units
        Route::get('/packaging_units', [App\Http\Controllers\PackagingUnitController::class, 'index'])->name('packaging.units');
        Route::post('/packaging_unit/store', [App\Http\Controllers\PackagingUnitController::class, 'store'])->name('packaging.unit.store');
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

        //water networks

        Route::get('/water_networks',[App\Http\Controllers\WaterNetworkController::class,'index'])->name('water.networks');
        Route::post('/water_network/store',[App\Http\Controllers\WaterNetworkController::class,'store'])->name('water.network.store');
        Route::post('/water_network/update',[App\Http\Controllers\WaterNetworkController::class,'update'])->name('water.network.edit');
        Route::get('/water_network/delete/{id}',[App\Http\Controllers\WaterNetworkController::class,'destroy'])->name('water.network.delete');

        //suppliers
        Route::get('/suppliers',[App\Http\Controllers\SupplierController::class,'index'])->name('suppliers');
        Route::post('/supplier/store',[App\Http\Controllers\SupplierController::class,'store'])->name('supplier.store');
        Route::post('/supplier/update',[App\Http\Controllers\SupplierController::class,'update'])->name('supplier.edit');
        Route::get('/supplier/delete/{id}',[App\Http\Controllers\SupplierController::class,'destroy'])->name('supplier.delete');

        Route::get('/water_networks', [App\Http\Controllers\WaterNetworkController::class, 'index'])->name('water.networks');
        Route::post('/water_network/store', [App\Http\Controllers\WaterNetworkController::class, 'store'])->name('water.network.store');
        Route::post('/water_network/update', [App\Http\Controllers\WaterNetworkController::class, 'update'])->name('water.network.edit');
        Route::get('/water_network/delete/{id}', [App\Http\Controllers\WaterNetworkController::class, 'destroy'])->name('water.network.delete');

    });

    Route::prefix('stock-management')->name('stock.')->group(function () {
        Route::resource('item-categories', ItemCategoryController::class);
        Route::resource('items', ItemController::class);
        Route::get('/stock-items', [App\Http\Controllers\StockController::class, 'index'])->name('stock-items.index');
        Route::get('/stock-items/{stock}', [App\Http\Controllers\StockController::class, 'show'])->name('stock-items.show');
        Route::get('/stock-movements', [App\Http\Controllers\StockMovementController::class, 'index'])->name('stock-items.movements');
        Route::get('/stock-movements/{movement}', [App\Http\Controllers\StockMovementController::class, 'show'])->name('stock-items.movements.show');
    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//ajax routes
Route::get('/operation-area', [App\Http\Controllers\AreaOfOperationController::class, 'getOperationAreasByOperators'])->name('get-operation-areas');

