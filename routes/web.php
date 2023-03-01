<?php

use App\Http\Controllers\AreaOfOperationController;
use App\Http\Controllers\CellController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RequestAssignmentController;
use App\Http\Controllers\RequestsController;
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
    });


    Route::group(['prefix' => 'requests', 'as' => 'requests.'], function () {
        Route::get('/', [RequestsController::class, 'index'])->name('index');
        Route::post('/', [RequestsController::class, 'store'])->name('store');
        Route::get('/create', [RequestsController::class, 'create'])->name('create');
        Route::get('/{request}/show', [RequestsController::class, 'show'])->name('show');
        Route::get('/{request}/edit', [RequestsController::class, 'edit'])->name('edit');
        Route::put('/{request}/update', [RequestsController::class, 'update'])->name('update');
        Route::delete('/{request}/delete', [RequestsController::class, 'destroy'])->name('delete');


        Route::get('/new', [RequestsController::class, 'newRequests'])->name('new');
        Route::post('/requests/assign', [RequestAssignmentController::class, 'assignRequests'])->name('assign');

        Route::get('/assigned', [RequestsController::class, 'assignedRequests'])->name('assigned');
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
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

