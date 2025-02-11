<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\FormCheckoutController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\RequestServiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::delete("/deleteUser/{id}", [AuthController::class, "deleteUser"]);
Route::get("/getAllUsers", [AuthController::class, "getAllUsers"]);
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    // Route::get("/getAllUsers", [AuthController::class, "getAllUsers"]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::get("/profile", [AuthController::class, "profile"]);
    Route::put('/profile/update/{id}', [AuthController::class, 'updateProfile']);
    Route::delete('/profile/delete', [AuthController::class, 'deleteAccount']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    Route::delete('/cart', [CartController::class, 'deleteAll']);
});

Route::post('/password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::post('/contact', [FormController::class, 'sendContactForm']);
Route::post('/contact-us', [ContactFormController::class, 'sendForm']);

Route::get('/products', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/service', [ServiceController::class, 'store']);
Route::get('/service/{id}', [ServiceController::class, 'show']);
Route::put('/service/{id}', [ServiceController::class, 'update']);
Route::delete('/service/{id}', [ServiceController::class, 'destroy']);

Route::get('/requestServices', [RequestServiceController::class, 'index']);
Route::post('/requestService', [RequestServiceController::class, 'store']);
Route::get('/requestService/{id}', [RequestServiceController::class, 'show']);
Route::post('/requestService/{id}', [RequestServiceController::class, 'update']);
Route::delete('/requestService/{id}', [RequestServiceController::class, 'destroy']);

Route::post('/checkout', [CheckoutController::class, 'createSession']);
Route::post('/formCheckout', [FormCheckoutController::class, 'createSession']);