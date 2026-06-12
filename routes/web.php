<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Role
Route::view('/roles','roles')->name('web.roles.index');
Route::view('/roles/add-role','add-role')->name('web.role.add');

// User
Route::view('/users','users')->name('web.users.index');
Route::view('/users/add-user','add-user')->name('web.users.add');


// employee
Route::view('/employees','employees')->name('web.employees.index');
Route::view('/employees/add-employee','add-employee')->name('web.employee.add');
Route::get('/employees/{user}',function(){
    return view('employee-profile');
})->name('web.employee.profile');

// departments
Route::view('/departments','departments')->name('web.departments.index');
Route::view('/departments/add-department','add-department')->name('web.departments.add');
