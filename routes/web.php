<?php

use App\Http\Controllers\Invoice;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get("/test",function(){
   return view("test");
});
Route::get("/invoice", [Invoice::class, "ShowInvoice"]);

Route::get("/user", [UserController::class, "index"])->name("userall");
Route::get("/user/create", [UserController::class, "create"]);
Route::post("/user/save", [UserController::class, "save"]);
Route::get("/user/edit/{id}", [UserController::class, "edit"]);
Route::put("/user/update/{id}", [UserController::class, "update"]);
Route::delete("/user/delete/{id}", [UserController::class, "delete"]);

Route::get("/roles/test" , [RoleController::class, "test"])->name("testRoute");
Route::resource("/roles", RoleController::class); 


