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

        Auth::login($user);
       // Send email verification link
       auth()->user()->sendEmailVerificationNotification();

        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        // Send the welcome email
        $name = auth()->user()->name ?? 'User';

        Mail::to(auth()->user()->email)->send(new WelcomeMail($name));
        return 'Welcome email sent successfully!';

        return response()->json([
        'message' => 'Registration successful! Please check your email for a verification link.',
        'user' => $user,
        ], 201);

        //return redirect('http://localhost:3000/login')->with('success', 'Registration successful!');
    }
}
