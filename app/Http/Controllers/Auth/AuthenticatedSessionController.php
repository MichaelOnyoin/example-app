<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;
// use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    // public function create(): Response
    // {
    //     return Inertia::render('Auth/Login', [
    //         'canResetPassword' => Route::has('password.request'),
    //         'status' => session('status'),
    //     ]);
    // }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Handle an incoming authentication request via API.
     */
    public function loginApi(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $session = $request->session()->regenerate();
        // Store user ID in session (if needed)
        // This is not necessary for API, but you can store it if needed
        session()->put('user_id', Auth::id());

        $user = Auth::user();
        // Optionally, you can store the user ID in the session
        // This is not necessary for API, but you can store it if needed
        //session()->put('user_id', $user->id)= $session;
        //$request->session()->store('user_id', $user->id);

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'session' => $session, // Include session data if needed
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();


        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Handle an incoming authentication request via API.
     */
    public function logoutApi(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        //$request->session()->invalidate();
        // Optionally, you can invalidate the session token if you're using session-based authentication
        // This is not necessary for API, but you can store it if needed
        session()->invalidate();
        // Optionally, you can regenerate the session token
        session()->regenerateToken();

        //$request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
