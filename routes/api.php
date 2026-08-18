<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Middleware\AdminMiddleware;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/testapi", function(){
    echo "api is working";
});

Route::post('register', [AuthController::class, 'register']);
Route::post("login", [AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){
   Route::post('logout', [AuthController::class, 'logout']);
   Route::get('profile', [AuthController::class, 'profile']);
});


Route::prefix("v1")->middleware(['throttle:10,1','auth:sanctum'])->group(function(){
   Route::apiResource("/students", StudentController::class);
});


Route::get("sendmail", function(){
     $user = User::find(30);
    //  Mail::to($user->email)->send(new WelcomeMail($user));
     Mail::to($user->email)->queue(new WelcomeMail($user));
    return response()->json([
            'message'      => 'email send successfully!',  
    ], 201);
});
