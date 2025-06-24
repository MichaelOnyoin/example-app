<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\WelcomeMail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testroute', function(){
    $name="John Doe";
    Mail::to('mikeokello2023@gmail.com',)->send(new SendMail($name));
});

Route::get('/mail', function () {
    //return view('welcome');
    $name = "Jack Hammer";
    Mail::to('moonyoin@gmail.com')->send(new WelcomeMail($name));

});