<?php

namespace App\Services;

use App\Http\Resources\User\MeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Response;

class AuthService
{
    public function login(User $user, ?string $userAgent): JsonResponse
    {
        return Response::json([
            'token' => $user->createToken($userAgent)->plainTextToken,
            'user' => new MeResource($user),
        ]);
    }

    public function logout(User $user, ?string $userAgent): void
    {
        $user->tokens()->where('name', $userAgent)->delete();
    }
}
