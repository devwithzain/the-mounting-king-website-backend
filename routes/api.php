<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AdvantageController;
use App\Http\Controllers\Api\HomeServiceController;
use App\Http\Controllers\Api\ContactFormController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/contact', [FormController::class, 'sendContactForm']);
Route::post('/contact-us', [ContactFormController::class, 'sendForm']);

Route::get('/home', [HomeController::class, 'index']);
Route::post('/home', [HomeController::class, 'store']);
Route::get('/home/{id}', [HomeController::class, 'show']);
Route::patch('/home/{id}', [HomeController::class, 'update']);
Route::delete('/home/{id}', [HomeController::class, 'destroy']);

Route::get('/homeService', [HomeServiceController::class, 'index']);
Route::post('/homeService', [HomeServiceController::class, 'store']);
Route::get('/homeService/{id}', [HomeServiceController::class, 'show']);
Route::patch('/homeService/{id}', [HomeServiceController::class, 'update']);
Route::delete('/homeService/{id}', [HomeServiceController::class, 'destroy']);

Route::get('/advantage', [AdvantageController::class, 'index']);
Route::post('/advantage', [AdvantageController::class, 'store']);
Route::get('/advantage/{id}', [AdvantageController::class, 'show']);
Route::patch('/advantage/{id}', [AdvantageController::class, 'update']);
Route::delete('/advantage/{id}', [AdvantageController::class, 'destroy']);