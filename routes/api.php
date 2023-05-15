<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api_Login_EmployeeController;
use App\Http\Controllers\Api_DataController;
use App\Http\Controllers\Api_DepartmentController;
use App\Http\Controllers\Api_DesignationController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('login', [Api_DataController::class, 'indexIogin']);
Route::post('dashboard', [Api_DataController::class, 'login'])->name('dashboard');
Route::post('api_logout',[Api_DataController::class,'logout']);
Route::get('dashboard',[Api_DataController::class,'dashboard']);
Route::get('employee_leave_request', [Api_DataController::class, 'leave']);

Route::get('view_employee', [Api_DataController::class, 'index'])->name('view_employee');
Route::post('insert_employee', [Api_DataController::class, 'insert'])->name('insert_employee');
Route::get('edit_employee/{id}', [Api_DataController::class, 'designationChange']);
Route::post('edit', [Api_DataController::class, 'update']);
// Route::get('delete/{id}',[Api_DataController::class,'destroy'] );

Route::get('department',[Api_DepartmentController::class,'department'] );
Route::post('/department_insert',[Api_DepartmentController::class,'department_insert'] );
Route::post('/department_Edit',[Api_DepartmentController::class,'department_Edit'] );
Route::get('/department_Delete/{id}',[Api_DepartmentController::class,'department_Delete'] );


Route::get('/designation',[Api_DesignationController::class,'designation'] );
Route::get('/designationGet/{id}',[Api_DesignationController::class,'designationEmp'] );
Route::post('/designation_insert',[Api_DesignationController::class,'designation_insert'] );
Route::post('/designation_Edit',[Api_DesignationController::class,'designation_Edit'] );
Route::get('/designation_Delete/{id}',[Api_DesignationController::class,'designation_Delete'] );


// Route::post('/api_logout',[Api_DesignationController::class,''] );
Route::get('login_api_employee', [Api_Login_EmployeeController::class, 'login_api_employee']);
Route::post('add_login_api_employee', [Api_Login_EmployeeController::class, 'add_login_api_employee']);
