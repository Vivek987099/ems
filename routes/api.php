<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register-user',[UserController::class,'registerUser']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::controller(UserController::class)->group(function(){
        Route::get('/users','allUsers');
        Route::get('/users/no-emp','userWithNoEmp');
    });
    Route::apiResource('/employees',EmployeeController::class);
    Route::apiResource('/roles',RoleController::class);
    Route::apiResource('/departments',DepartmentController::class);
});

?>
