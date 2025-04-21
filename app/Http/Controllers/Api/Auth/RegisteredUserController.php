<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', new PhoneNumber, 'unique:'.User::class],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user_type_id = 0;
        if ($request->is('api/admin/*')) {
            $user_type_id = 2;
        } elseif ($request->is('api/student/*')) {
            $user_type_id = 3;
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_type_id' => $user_type_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user['api_token'] = $user->createToken('QuestionBank')->accessToken;
        $user['token_type'] = "Bearer";

        return formatResponse(0, 200, 'You are logged in', $user);
    }
}
