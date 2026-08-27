<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Invoice;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TopicController;

Route::get("/test", function () {
    return view("test");
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get("/invoice", [Invoice::class, "ShowInvoice"]);

Route::get("/user", [UserController::class, "index"])->name("users.index");
Route::get("/user/create", [UserController::class, "create"])->name("users.create");
Route::post("/user/save", [UserController::class, "save"])->name("users.store");
Route::get("/user/edit/{id}", [UserController::class, "edit"])->name("users.edit");
Route::get("/user/show/{id}", [UserController::class, "show"])->name("users.show");
Route::put("/user/update/{id}", [UserController::class, "update"])->name("users.update");
Route::delete("/user/delete/{id}", [UserController::class, "delete"])->name("users.destroy");

Route::get("/roles/test", [RoleController::class, "test"])->name("testRoute");
Route::resource("/roles", RoleController::class);


// Route::middleware(['auth'])->prefix("students")->group(function (){
//     Route::get("/deleted", [StudentController::class, "deletedStudents"]);
//     Route::get("/delete/{id}", [StudentController::class, "forceDelete"])->name("student.delete");
//     Route::get("/restore/{id}", [StudentController::class, "restore"])->name("student.restore");
//     });
// Route::resource("/students", StudentController::class);

 Route::get("/students/sample/export", [StudentController::class, "sampleExport"]);
 Route::get("/students/export", [StudentController::class, "studentExport"]);
 Route::get("/students/import", [StudentController::class, "importview"]);
 Route::post("/students/import", [StudentController::class, "inportStore"]);

Route::get("/topic", [TopicController::class, "index"])->name("topic");
Route::get("/topic/chapter/{id}", [TopicController::class, "subject_chapter"])->name("chapter");
Route::get("/topic/topic/{id}", [TopicController::class, "chapter_topic"])->name("topic");



Route::middleware(['auth'])->prefix('access-control')->name('access.')->group(function () {

    // Main page
    Route::get('/', [RolePermissionController::class, 'index'])
        ->name('index');

    // Create role
    Route::post('/roles', [RolePermissionController::class, 'storeRole'])
        ->name('roles.store');

    // Create permission
    Route::post('/permissions', [RolePermissionController::class, 'storePermission'])
        ->name('permissions.store');

    // Assign role to user
    Route::post('/users/role', [RolePermissionController::class, 'assignRoleToUser'])
        ->name('users.role');

    // Assign permission directly to user
    Route::post('/users/permission', [RolePermissionController::class, 'assignPermissionToUser'])
        ->name('users.permission');

    // Assign permissions to role
    Route::post('/roles/permissions', [RolePermissionController::class, 'assignPermissionsToRole'])
        ->name('roles.permissions');
});


 Route::get("product/export", [ProductController::class,"export"]);
 Route::get("product/import", [ProductController::class,"importview"]);
 Route::post("product/import", [ProductController::class,"import"]);


 use App\Http\Controllers\QuestionImportController;

Route::get('/questions/import', [QuestionImportController::class, 'showForm'])->name('questions.import.form');
Route::get('/questions/template', [QuestionImportController::class, 'downloadTemplate'])->name('questions.template');
Route::post('/questions/import', [QuestionImportController::class, 'import'])->name('questions.import.submit');


require __DIR__ . '/auth.php';
