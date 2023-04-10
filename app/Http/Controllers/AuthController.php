<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        $maxAttempts = 5;
        $lockoutTime = 1; // minutes
        $key = $this->throttleKey($request);

        return RateLimiter::tooManyAttempts($key, $maxAttempts, $lockoutTime);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $key = $this->throttleKey($request);

        RateLimiter::hit($key, 1);
    }

    protected function clearLoginAttempts(Request $request)
    {
        $key = $this->throttleKey($request);

        RateLimiter::clear($key);
    }

    protected function throttleKey(Request $request)
    {
        return mb_strtolower($request->input('email')) . '|' . $request->ip();
    }

    protected function fireLockoutEvent(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        $message = __('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]);

        throw ValidationException::withMessages([
            'email' => [$message],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        return response()->json([
            'message' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])
        ], Response::HTTP_TOO_MANY_REQUESTS);
    }
}

