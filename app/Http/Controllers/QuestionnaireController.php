<?php

namespace App\Http\Controllers;

use App\Data\OrderData;
use App\Data\OrderDetailsData;
use App\Data\UserData;
use App\Data\VendorData;
use App\Data\VendorLocationData;
use App\Events\VendorCreatedEvent;
use App\Http\Requests\Questionnaire\CustomerBookingRequest;
use App\Http\Requests\Questionnaire\VendorJoinRequest;
use App\Models\User;
use App\Services\OrderService;
use App\Services\UserService;
use App\Services\VendorService;
use Illuminate\Http\JsonResponse;
use Response;

class QuestionnaireController extends Controller
{
    public function order(
        CustomerBookingRequest $request,
        OrderService           $orderService
    ): JsonResponse
    {
        $order = $orderService->store($request->collect());

        return Response::json(compact('order'), 400);
    }

    public function vendor(
        VendorJoinRequest $request,
        VendorService     $vendorService,
    ): JsonResponse
    {
        $vendor = $vendorService->store($request->collect());

        event(new VendorCreatedEvent($vendor));

        return Response::json(null, 201);
    }
}
