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

        $routesWithUserTypes = [
            'api/admin/*'      => [2, 1], // Try type 2 first, then 1
            'api/student/*'    => [3],
            'api/data-entry/*' => [4],
        ];

        foreach ($routesWithUserTypes as $pattern => $userTypes) {
            if ($request->is($pattern)) {
                foreach ($userTypes as $type) {
                    $credentials['user_type_id'] = $type;
                    if ($auth = Auth::attempt($credentials)) {
                        break 2; // Break both loops on success
                    }
                }
            }
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
