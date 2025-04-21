<?php

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

if (!function_exists('authUser')) {
    function authUser(): ?User
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return null;
    }
}

if (!function_exists('formatResponse')) {
    function formatResponse(int $error, int $code, string $msg, mixed $data): JsonResponse
    {
        return response()->json([
            'error' => $error,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }
}
