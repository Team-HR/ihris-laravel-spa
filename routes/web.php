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

// Auth::routes([
//   'register' => true,
//   'verify' => false,
//   'reset' => false
// ]);


Route::get('users/data-table', 'UsersController@getUsersForDataTable')->name('users.table');


// plantilla permanent start
Route::get('plantilla_permanents/data-table', 'PlantillaPermanentController@getPlantillaPermanentsForDataTable')->name('plantilla_permanents.table');
Route::post('plantilla_permanents', 'PlantillaPermanentController@store');
Route::delete('plantilla_permanents', 'PlantillaPermanentController@destroy');
// Route::delete('api/users/{id}', 'UserController@destroy');


Route::get('dev_plantilla_permanent', function(){
	return view('plantilla_permanent_dev');
});
// plantilla permanent end


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

//  test
Route::resource('ajax-crud','AjaxController');
Route::resource('shows', 'ShowController');




// datatables test
Route::get('users', 'UsersController@index');
Route::get('users-list', 'UsersController@usersList');


// listers
Route::get('departments-list', 'DepartmentController@listDepartment');
Route::get('employees-list', 'EmployeeController@listEmployee');