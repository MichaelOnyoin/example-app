<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    public function create(): View
    {
        return view('mail.welcome-mail', [
            'greeting' => 'Welcome to our application!',
            'body' => 'We are excited to have you on board. Feel free to explore and let us know if you have any questions.',
        ]);

    }
}
