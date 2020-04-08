<?php

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

// Route::get('/', function () {
//     return view('auth.login');
// });
Auth::routes();



// home
Route::get('/home', 'HomeController@index')->name('employee.home');
Route::get('/', 'HomeController@index')->name('employee.home');

// cores
Route::get('/cores', 'CoresController@index');

// employee
Route::resource('/employee', 'EmployeeController');

// plantilla casual start
Route::resource('/casual/plantilla', 'CasualPlantillaController');
Route::get('/casual/plantilla-generate_report', 'CasualPlantillaController@generateReport');
Route::get('/casual/plantilla-generate_ataf', 'CasualPlantillaController@generateAtaf');
// plantilla casual end

// appointment
Route::resource('/appointment', 'AppointmentController');
Route::put('/appointment/{id}/updatePerEmployee', 'AppointmentController@updatePerEmployee');

Route::get('admin/employee','EmployeeController@index')->middleware('is_admin');
Route::post('admin/employee/action', 'EmployeeController@action')->name('full-text-search.action')->middleware('is_admin');
Route::get('admin/employee/','EmployeeController@index')->middleware('is_admin');

Route::resource('admin/department','DepartmentController');
Route::resource('admin/position','PositionController')->middleware('is_admin');



// datatables test
Route::get('users', 'UsersController@index');
Route::get('users-list', 'UsersController@usersList');



// listers
Route::get('plantilla_permanents/data-table', 'PlantillaPermanentController@getPlantillaPermanentsForDataTable')->name('plantilla_permanents.table');
Route::get('departments-list', 'DepartmentController@listDepartment');
Route::get('employees-list', 'EmployeeController@listEmployee');


//geters
Route::get('getAppointmentWithPlantillaId', 'AppointmentPermanentController@getAppointmentPermanents');
