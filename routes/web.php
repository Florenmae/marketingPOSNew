<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//login
Route::post("/login", [LoginController::class, "login"]);
Route::post("/signup", [SignupController::class, "signup"]);
Route::get("/checkUser", [LoginController::class, "checkLogin"]);
Route::post("/logout", [LoginController::class, "logout"]);

//User
Route::post("/submit-user", [UserController::class, 'createUser'])->name("createUser");
Route::get("/get-users", [UserController::class, "getUsers"]);
Route::post("/update-user/{id}", [UserController::class, "updateUser"]);
Route::post("/delete-user", [UserController::class, "deleteUser"]);



//
Route::get('/{vue?}', function(){
    return view('app');
})->where('vue', '[\/\w\.-]*');

