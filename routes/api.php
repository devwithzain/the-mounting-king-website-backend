<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AdvantageController;
use App\Http\Controllers\Api\HeroServiceController;
use App\Http\Controllers\Api\HomeServiceController;
use App\Http\Controllers\Api\ContactFormController;

Route::post('/process-payment', [StripeController::class, 'processPayment'])->name('process.payment');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::get("/profile", [AuthController::class, "profile"]);
    Route::put('/profile/update', [AuthController::class, 'updateProfile']);
    Route::delete('/profile/delete', [AuthController::class, 'deleteAccount']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    Route::delete('/cart', [CartController::class, 'deleteAll']);
});

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::post('/contact', [FormController::class, 'sendContactForm']);
Route::post('/contact-us', [ContactFormController::class, 'sendForm']);

Route::get('/home', [HomeController::class, 'index']);
Route::post('/home', [HomeController::class, 'store']);
Route::get('/home/{id}', [HomeController::class, 'show']);
Route::put('/home/{id}', [HomeController::class, 'update']);
Route::delete('/home/{id}', [HomeController::class, 'destroy']);

Route::get('/homeService', [HomeServiceController::class, 'index']);
Route::post('/homeService', [HomeServiceController::class, 'store']);
Route::get('/homeService/{id}', [HomeServiceController::class, 'show']);
Route::put('/homeService/{id}', [HomeServiceController::class, 'update']);
Route::delete('/homeService/{id}', [HomeServiceController::class, 'destroy']);

Route::get('/advantage', [AdvantageController::class, 'index']);
Route::post('/advantage', [AdvantageController::class, 'store']);
Route::get('/advantage/{id}', [AdvantageController::class, 'show']);
Route::put('/advantage/{id}', [AdvantageController::class, 'update']);
Route::delete('/advantage/{id}', [AdvantageController::class, 'destroy']);

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

Route::get('/servicesHero', [HeroServiceController::class, 'index']);
Route::post('/serviceHero', [HeroServiceController::class, 'store']);
Route::get('/serviceHero/{id}', [HeroServiceController::class, 'show']);
Route::put('/serviceHero/{id}', [HeroServiceController::class, 'update']);
Route::delete('/serviceHero/{id}', [HeroServiceController::class, 'destroy']);