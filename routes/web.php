<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {

    Mail::raw('This is testing from khizer', function ($message) {
        $message->to('ZainSoftwear11@gmail.com')->subject('Test Email');
    });
    return view('welcome');
});