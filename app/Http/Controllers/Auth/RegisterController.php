<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail ; // Import the Mailable class

class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function registerUser(Request $request):JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        Mail::to($user->email)->send(new WelcomeMail($user->name)); // Send a welcome email using Mailable
       // $user->sendEmailVerificationNotification(new WelcomeMail($user->name)); // Send email verification notification
       //Auth::login($user);
        $request->user()->sendEmailVerificationNotification();

        return response()->json($user, 200);

        //return redirect('http://localhost:3000/login')->with('success', 'Registration successful!');
    }
}
