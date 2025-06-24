<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testroute', function(){
    $name="John Doe";
    Mail::to('mikeokello2023@gmail.com',)->send (new SendMail($name));
});