<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ConfigController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return \Response::json([
            'contacts' => [],
        ]);
    }
}
