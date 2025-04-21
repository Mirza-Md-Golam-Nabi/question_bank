<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $credentials = $request->only('phone', 'password');

        $auth = null;
        if ($request->is('api/admin/*')) {
            $credentials['user_type_id'] = 2;

            $auth = Auth::attempt($credentials);

            if (!$auth) {
                $credentials['user_type_id'] = 1;

                $auth = Auth::attempt($credentials);
            }
        } elseif ($request->is('api/student/*')) {
            $credentials['user_type_id'] = 3;

            $auth = Auth::attempt($credentials);
        }

        if ($auth) {
            $user = Auth::user();

            $user['api_token'] = $user->createToken('QuestionBank')->accessToken;
            $user['token_type'] = "Bearer";

            return formatResponse(0, 200, 'You are logged in', $user);
        } else {
            return formatResponse(1, 200, 'Password and Phone number do not match', null);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return formatResponse(0, 200, "Successfully logged out", null);
    }
}
