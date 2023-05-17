<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Api_Login_EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\Import_EcxelController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;
use Illuminate\Routing\Router;



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
// Route::get('login', function () {
//     return view('loginPage');
// });
// Route::get('sidebar', function () {
//     return view('sidebar');
// });
// Route::get('footer', function () {
//     return view('footer');
// });

// Route::get('index', function () {
//     return view('index');
// });
// Route::get('create_employee', function () {
//     return view('create_employee');
// });
Route::get('import_data_excel', function () {
    return view('import');
});
//  Route::middleware(['web'])->group(function () {


Route::get('download_excel', [DataController::class, 'download_excel']);
Route::get('download_pdf', [DataController::class, 'download_pdf']);


Route::get('login', [DataController::class, 'indexIogin']);
Route::post('/dashboard', [DataController::class, 'login'])->name('dashboard');
Route::get('logout',[DataController::class,'logout']);
Route::get('dashboard',[DataController::class,'dashboard']);

Route::get('view_employee', [DataController::class, 'index'])->name('view_employee');
Route::post('insert_employee', [DataController::class, 'insert'])->name('insert_employee');
Route::get('edit_employee/{id}', [DataController::class, 'designationChange']);
Route::post('edit', [DataController::class, 'update']);
Route::get('/delete/{id}',[DataController::class,'destroy'] );

Route::get('/designationGet/{id}',[DesignationController::class,'designationEmp'] );
Route::get('/designation',[DesignationController::class,'designation'] );
Route::post('/designation_Edit',[DesignationController::class,'designation_Edit'] );
Route::post('/designation_insert',[DesignationController::class,'designation_insert'] );
Route::get('/designation_Delete/{id}',[DesignationController::class,'designation_Delete'] );


Route::get('department',[DepartmentController::class,'department'] );
Route::post('/department_insert',[DepartmentController::class,'department_insert'] );
Route::post('/department_Edit',[DepartmentController::class,'department_Edit'] );
Route::get('/department_Delete/{id}',[DepartmentController::class,'department_Delete'] );


Route::get('employee_leave_request', [DataController::class, 'leave']);
Route::get('login_api_employee', [Api_Login_EmployeeController::class, 'login_api_employee']);

Route::get('file/{id}', [FileController::class, 'file']);
Route::get('pdf_download', [DataController::class, 'download_pdf']);

Route::post('ecxel_import', [Import_EcxelController::class, 'ecxel_import']);
//Route::get('/designationChange/{id}',[DataController::class,'designationChange'] );
//Route::get('/designationUpdate/{id}',[DataController::class,'designationUpdatE'] );
// });
Route::get('table', [TableController::class, 'table']);
Route::post('table_insert', [TableController::class, 'table_insert']);