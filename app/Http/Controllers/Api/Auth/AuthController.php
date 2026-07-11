<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        $minutes = 60 * 24 * 7; // 7 days

        $cookie = cookie('auth_token', $token, $minutes, '/', null, false, true, false, 'lax');

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
                'phone' => $user->phone,
            ],
        ], 201)->withCookie($cookie);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        $remember = $request->boolean('remember');
        $minutes  = $remember ? 60 * 24 * 30 : 60 * 24 * 7; // 30d or 7d

        $cookie = cookie(
            'auth_token',        // name
            $token,              // value
            $minutes,            // lifetime (minutes)
            '/',                 // path
            null,                // domain (null = current)
            false,               // secure (true in production over HTTPS)
            true,                // httpOnly — JS cannot read this
            false,               // raw
            'lax'                // sameSite
        );

        return response()->json([
            'token' => $token,   // still returned so the frontend can store nothing if it wants
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
                'phone' => $user->phone,
            ],
        ])->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        // Expire the httpOnly cookie
        $expired = cookie('auth_token', '', -1, '/', null, false, true, false, 'lax');

        return response()->json(['message' => 'Logged out successfully.'])->withCookie($expired);
    }

    public function user(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id'      => $user->id,
            'name'    => $user->name,
            'email'   => $user->email,
            'role'    => $user->role,
            'phone'   => $user->phone,
            'address' => $user->address,
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No user found with this email address.',
        ]);

        $status = Password::sendResetLink($validated);

        if ($status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent successfully to your email.',
                'email' => $validated['email']
            ], 200);
        }

        $errorMessages = [
            \Illuminate\Support\Facades\Password::INVALID_USER => 'No user found with this email address.',
            \Illuminate\Support\Facades\Password::RESET_THROTTLED => 'Too many password reset attempts. Please try again later.',
        ];

        $message = $errorMessages[$status] ?? 'Unable to send password reset link. Please try again.';

        return response()->json([
            'message' => $message,
            'status' => $status
        ], 422);
    }

   /**
     * Public password reset via email token.
     * Matches: POST /api/user/reset-password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Use Laravel's password broker to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                
                // Optional: Revoke tokens if you want to force logout everywhere
                $user->tokens()->delete();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Your password has been reset successfully.'
            ], 200);
        }

        // Return error message if token or email is invalid/expired
        return response()->json([
            'message' => __($status)
        ], 422);
    }
}