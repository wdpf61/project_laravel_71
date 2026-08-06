<?php

use App\Http\Controllers\Invoice;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get("/test",function(){
   return view("test");
});
Route::get("/invoice", [Invoice::class, "ShowInvoice"]);

Route::get("/user", [UserController::class, "index"])->name("users.index");
Route::get("/user/create", [UserController::class, "create"])->name("users.create");
Route::post("/user/save", [UserController::class, "save"])->name("users.store");
Route::get("/user/edit/{id}", [UserController::class, "edit"])->name("users.edit");
Route::get("/user/show/{id}", [UserController::class, "show"])->name("users.show");
Route::put("/user/update/{id}", [UserController::class, "update"])->name("users.update");
Route::delete("/user/delete/{id}", [UserController::class, "delete"])->name("users.destroy");

Route::get("/roles/test" , [RoleController::class, "test"])->name("testRoute");
Route::resource("/roles", RoleController::class); 



Route::get("/students/deleted", [StudentController::class,"deletedStudents"]); 
Route::get("/students/delete/{id}", [StudentController::class,"forceDelete"])->name("student.delete"); 
Route::get("/students/restore/{id}", [StudentController::class,"restore"])->name("student.restore"); 
Route::resource("/students", StudentController::class); 

