<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ConfigRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class ConfigController extends Controller
{
    public function __construct(
        protected readonly ConfigRepository $configRepository
    ) {
        //
    }

    public function services(): JsonResponse
    {
        return Response::json(
            $this->configRepository->services()
        );
    }

    public function vehicles(Request $request): JsonResponse
    {
        return Response::json(
            $this->configRepository->vehicles(
                array_filter(explode(',', $request->input('services')))
            )
        );
    }

    public function countries(): JsonResponse
    {
        return Response::json(
            $this->configRepository->countries()
        );
    }

    public function booking(): JsonResponse
    {
        return Response::json([
            'wishes' => $this->configRepository->wishes(),
            'locationTypes' => $this->configRepository->locationTypes(),
        ]);
    }
}
