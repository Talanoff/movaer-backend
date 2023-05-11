<?php

namespace App\Http\Controllers;

use App;
use App\Data\UserData;
use App\Data\VendorData;
use App\Data\VendorLocationData;
use App\Http\Requests\Questionnaire\CustomerBookingRequest;
use App\Http\Requests\Questionnaire\VendorJoinRequest;
use App\Services\UserService;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;
use Response;

class QuestionnaireController extends Controller
{
    public function customer(CustomerBookingRequest $request): JsonResponse
    {

        return Response::json();
    }

    public function vendor(
        VendorJoinRequest $request,
        UserService $userService,
        VendorService $vendorService,
    ): JsonResponse {
        App::setLocale($request->header('X-Locale', config('app.locale')));

        $user = $userService->register(UserData::from($request->validated()));
        $vendor = $vendorService->register(VendorData::from($request->validated()), $user);
        $vendorService->assignVehicles($vendor, $request->input('vehicles', []));
        $vendorService->assignLocations($vendor, VendorLocationData::collection($request->input('locations', [])));

        return Response::json(null, 201);
    }
}
