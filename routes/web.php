<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
Route::post("/update-user", [UserController::class, "updateUser"]);
Route::post("/delete-user", [UserController::class, "deleteUser"]);

//Product
Route::post("/submit-product", [ProductController::class, 'createProduct'])->name("createProduct");
Route::get("/get-products", [ProductController::class, 'getProducts']);
Route::post("/update-product", [ProductController::class, 'updateProduct']);
Route::post("/delete-product", [ProductController::class, 'deleteProduct']);


//Category
Route::post("/submit-category", [CategoryController::class, 'createCategory'])->name("createCategory");
Route::post("/get-categories", [CategoryController::class, 'getCategory']);
Route::post("/update-category", [CategoryController::class, 'updateCategory']);
Route::post("/delete-category", [CategoryController::class, 'deleteCategory']);

//
Route::get('/{vue?}', function(){
    return view('app');
})->where('vue', '[\/\w\.-]*');

