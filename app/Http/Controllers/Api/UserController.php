<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\MeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class UserController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return Response::json(new MeResource($request->user()));
    }
}
