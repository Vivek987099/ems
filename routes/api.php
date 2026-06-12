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

Route::middleware(['auth:sanctum','role:admin'])->group(function (){
    // user routes
    Route::controller(UserController::class)->group(function(){
        Route::get('/users','allUsers');
        Route::get('/users/no-emp','userWithNoEmp');
        Route::get('/users/{id}','show');
        Route::put('/users/{id}','update');
        Route::delete('/users/{id}','destroy');
    });
    Route::apiResource('/employees',EmployeeController::class);
    Route::apiResource('/roles',RoleController::class);
    Route::apiResource('/departments',DepartmentController::class);

    // logout
    Route::post('/logout',[AuthController::class,'logout']);
});

?>
