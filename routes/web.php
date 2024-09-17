<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Manager\AuthManagerController;
use \App\Http\Controllers\Manager\DepartmentController;
use \App\Http\Controllers\Manager\EmployeeController;
use \App\Http\Controllers\Manager\TaskController;
use \App\Http\Controllers\Employee\AuthEmployeeController;


Route::group(["prefix" => "manager"],function (){
    Route::group(["prefix" => "auth","middleware" => "manager.guest"],function (){
        Route::get("login",[AuthManagerController::class,"indexLogin"])->name("manager.index.login");
        Route::post("login",[AuthManagerController::class,"login"])->name("manager.login");
    });

    Route::group(["prefix" => "dashboard","middleware" => "manager.auth"],function (){
        Route::get("/",[AuthManagerController::class,"dashboard"])->name("manager.dashboard");
        Route::get("logout",[AuthManagerController::class,"logout"])->name("manager.logout");
    });

    Route::group(["prefix" => "departments","middleware" => "manager.auth"],function (){
        Route::get("/",[DepartmentController::class,"index"])->name("manager.department.index");
        Route::post("/",[DepartmentController::class,"index"])->name("manager.department.index.search");
        Route::get("create",[DepartmentController::class,"create"])->name("manager.department.create");
        Route::post("store",[DepartmentController::class,"store"])->name("manager.department.store");
        Route::get("show/{id}",[DepartmentController::class,"show"])->name("manager.department.show");
        Route::post("update/{id}",[DepartmentController::class,"update"])->name("manager.department.update");
        Route::get("delete/{id}",[DepartmentController::class,"destroy"])->name("manager.department.delete");
    });

    Route::group(["prefix" => "employees","middleware" => "manager.auth"],function (){
        Route::get("/",[EmployeeController::class,"index"])->name("manager.employee.index");
        Route::post("/",[EmployeeController::class,"index"])->name("manager.employee.index.search");
        Route::get("create",[EmployeeController::class,"create"])->name("manager.employee.create");
        Route::post("store",[EmployeeController::class,"store"])->name("manager.employee.store");
        Route::get("show/{id}",[EmployeeController::class,"show"])->name("manager.employee.show");
        Route::post("update/{id}",[EmployeeController::class,"update"])->name("manager.employee.update");
        Route::get("delete/{id}",[EmployeeController::class,"destroy"])->name("manager.employee.delete");
    });

    Route::group(["prefix" => "tasks","middleware" => "manager.auth"],function (){
        Route::get("/",[TaskController::class,"index"])->name("manager.task.index");
        Route::post("/",[TaskController::class,"index"])->name("manager.task.index.search");
        Route::get("create",[TaskController::class,"create"])->name("manager.task.create");
        Route::post("store",[TaskController::class,"store"])->name("manager.task.store");
    });
});


//-------------------------------------------------------?

Route::group(["prefix" => "employee"],function (){
    Route::group(["prefix" => "auth","middleware" => "guest"],function (){
        Route::get("login",[AuthEmployeeController::class,"indexLogin"])->name("employee.index.login");
        Route::post("login",[AuthEmployeeController::class,"login"])->name("employee.login");
    });

    Route::group(["prefix" => "dashboard","middleware" => "auth"],function (){
        Route::get("/",[AuthEmployeeController::class,"dashboard"])->name("employee.dashboard");
        Route::get("logout",[AuthEmployeeController::class,"logout"])->name("employee.logout");
    });

    Route::group(["prefix" => "tasks","middleware" => "auth"],function (){
        Route::get("/",[\App\Http\Controllers\Employee\TaskController::class,"index"])->name("employee.task.index");
        Route::get("edit-status",[\App\Http\Controllers\Employee\TaskController::class,"editStatus"])->name("employee.task.edit-status");
    });
});


