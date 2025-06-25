<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    //
    public function show(Request $request): Response
    {
        $user = $request->user();
        return response()->json($user);
    }

    public function update(Request $request): Response
    {
        $user = $request->user();
        $user->update($request->only('name', 'email'));
        return response()->json($user);
    }
    public function destroy(Request $request): Response
    {
        $user = $request->user();
        $user->delete();
        return response()->noContent();
    }
    public function changePassword(Request $request): Response
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = $request->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 403);
        }

        $user->password = \Hash::make($request->new_password);
        $user->save();

        return response()->noContent();
    }
    
    public function getUserById($id): Response
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    public function getAllUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }
    public function deleteUserById($id): Response
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->noContent();
    }
    //identify user by email and password
    public function getUserByEmailAndPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json($user, 200);
    }
}
