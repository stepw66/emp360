<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//lgoin
Route::get( '/', array( 'uses' => 'UsersController@showLogin' ) );
Route::post( 'login', array( 'uses' => 'UsersController@doLogin' ) );
Route::get( 'logout', array( 'uses' => 'UsersController@doLogout' ) );

//admin/home
Route::get( 'admin/home', array( 'uses' => 'HomeController@index' ) );

//admin/users
Route::get( 'admin/users', array( 'uses' => 'UsersController@home' ) );

Route::get( 'admin/users/create', array( 'uses' => 'UsersController@create' ) );
Route::post( 'admin/users/create', array( 'uses' => 'UsersController@post_new_user' ) );

Route::get( 'admin/users/search', array( 'uses' => 'UsersController@home' ) );
Route::post( 'admin/users/search', array( 'uses' => 'UsersController@post_search' ) );

Route::get( 'admin/users/edit/{id}', array( 'uses' => 'UsersController@edit' ) );
Route::post( 'admin/users/edit/{id}', array( 'uses' => 'UsersController@post_edit_user' ) );


//admin/departments
Route::get( 'admin/departments', array( 'uses' => 'DepartmentController@home' ) );

Route::get( 'admin/departments/search', array( 'uses' => 'DepartmentController@home' ) );
Route::post( 'admin/departments/search', array( 'uses' => 'DepartmentController@post_search' ) );

Route::get( 'admin/departments/create', array( 'uses' => 'DepartmentController@create' ) );
Route::post( 'admin/departments/create', array( 'uses' => 'DepartmentController@post_new_department' ) );

Route::get( 'admin/departments/edit/{id}', array( 'uses' => 'DepartmentController@edit' ) );
Route::post( 'admin/departments/edit/{id}', array( 'uses' => 'DepartmentController@post_edit_department' ) );

Route::get( 'admin/departments/delete/{id}', array( 'uses' => 'DepartmentController@delete' ) );

//admin/header_dep
//--หัวหน้า แผนก
Route::get( 'admin/header_dep', array( 'uses' => 'DepartmentController@header_dep' ) );
Route::post( 'admin/header_dep/create', array( 'uses' => 'DepartmentController@header_dep_create' ) );
Route::get( 'admin/header_dep/delete/{cid}', array( 'uses' => 'DepartmentController@header_dep_delete' ) );



//admin/positions
Route::get( 'admin/positions', array( 'uses' => 'PositionController@home' ) );

Route::get( 'admin/positions/search', array( 'uses' => 'PositionController@home' ) );
Route::post( 'admin/positions/search', array( 'uses' => 'PositionController@post_search' ) );

Route::get( 'admin/positions/create', array( 'uses' => 'PositionController@create' ) );
Route::post( 'admin/positions/create', array( 'uses' => 'PositionController@post_new_position' ) );

Route::get( 'admin/positions/edit/{id}', array( 'uses' => 'PositionController@edit' ) );
Route::post( 'admin/positions/edit/{id}', array( 'uses' => 'PositionController@post_edit_position' ) );

Route::get( 'admin/positions/delete/{id}', array( 'uses' => 'PositionController@delete' ) );


//admin/leaves
Route::get( 'admin/leaves', array( 'uses' => 'LeaveController@home' ) );

Route::get( 'admin/leaves/search', array( 'uses' => 'LeaveController@home' ) );
Route::post( 'admin/leaves/search', array( 'uses' => 'LeaveController@post_search' ) );

Route::get( 'admin/leaves/create', array( 'uses' => 'LeaveController@create' ) );
Route::post( 'admin/leaves/create', array( 'uses' => 'LeaveController@post_new_leave' ) );

Route::get( 'admin/leaves/edit/{id}', array( 'uses' => 'LeaveController@edit' ) );
Route::post( 'admin/leaves/edit/{id}', array( 'uses' => 'LeaveController@post_edit_leave' ) );

Route::get( 'admin/leaves/delete/{id}', array( 'uses' => 'LeaveController@delete' ) );

//admin/locations
Route::get( 'admin/locations', array( 'uses' => 'LocationController@home' ) );

Route::get( 'admin/locations/search', array( 'uses' => 'LocationController@home' ) );
Route::post( 'admin/locations/search', array( 'uses' => 'LocationController@post_search' ) );

Route::get( 'admin/locations/create', array( 'uses' => 'LocationController@create' ) );
Route::post( 'admin/locations/create', array( 'uses' => 'LocationController@post_new_location' ) );

Route::get( 'admin/locations/edit/{id}', array( 'uses' => 'LocationController@edit' ) );
Route::post( 'admin/locations/edit/{id}', array( 'uses' => 'LocationController@post_edit_location' ) );

Route::get( 'admin/locations/delete/{id}', array( 'uses' => 'LocationController@delete' ) );


//admin/emps
Route::get( 'admin/emps', array( 'uses' => 'EmpController@home' ) );
Route::get( 'admin/emps/position/{id}', array( 'uses' => 'EmpController@home_list' ) );

Route::get( 'admin/emps/search', array( 'uses' => 'EmpController@home' ) );
Route::post( 'admin/emps/search', array( 'uses' => 'EmpController@post_search' ) );

Route::get( 'admin/emps/view/{id}', array( 'uses' => 'EmpController@view' ) );

Route::get( 'admin/emps/create', array( 'uses' => 'EmpController@create' ) );
Route::post( 'admin/emps/create', array( 'uses' => 'EmpController@post_new_emp' ) );

Route::get( 'admin/emps/create/{id}', array( 'uses' => 'EmpController@create' ) );

Route::get( 'admin/emps/edit/{id}', array( 'uses' => 'EmpController@edit' ) );
Route::post( 'admin/emps/edit/{id}', array( 'uses' => 'EmpController@post_edit_emp' ) );

Route::post( 'admin/emps/creatework/{id}', array( 'uses' => 'EmpController@post_new_work' ) );
Route::post( 'admin/emps/createstudy/{id}', array( 'uses' => 'EmpController@post_new_study' ) );
Route::post( 'admin/emps/createsalary/{id}', array( 'uses' => 'EmpController@post_new_salary' ) );
Route::post( 'admin/emps/createleave/{id}', array( 'uses' => 'EmpController@post_new_leave' ) );

Route::get( 'admin/emps/delete/{id}', array( 'uses' => 'EmpController@delete' ) );
Route::get( 'admin/emps/edit/del_datawork/{id}/{cid}', array( 'uses' => 'EmpController@del_datawork' ) );
Route::get( 'admin/emps/edit/del_datastudy/{id}/{cid}', array( 'uses' => 'EmpController@del_datastudy' ) );
Route::get( 'admin/emps/edit/del_datasalary/{id}/{cid}', array( 'uses' => 'EmpController@del_datasalary' ) );



