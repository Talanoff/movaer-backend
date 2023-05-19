<?php

namespace App\Http\Controllers\Api;

use App\Events\Order\OrderCreated;
use App\Events\Vendor\VendorCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Questionnaire\CustomerBookingRequest;
use App\Http\Requests\Questionnaire\VendorJoinRequest;
use App\Services\AuthService;
use App\Services\OrderService;
use App\Services\VendorService;
use Auth;
use Illuminate\Http\JsonResponse;
use Response;

class QuestionnaireController extends Controller
{
    public function order(
        CustomerBookingRequest $request,
        OrderService $orderService,
        AuthService $authService
    ): JsonResponse {
        $order = $orderService->store($request->collect());

        event(new OrderCreated($order));

        if ($request->boolean('registrationRequired')) {
            Auth::login($order->user);

            return $authService->login($order->user, $request->userAgent());
        }

        return Response::json(null, 201);
    }

    public function vendor(
        VendorJoinRequest $request,
        VendorService $vendorService,
        AuthService $authService
    ): JsonResponse {
        $vendorService->store($request->collect());

        event(new VendorCreated($vendorService->getVendor()));

        Auth::login($vendorService->getUser());

        return $authService->login($vendorService->getUser(), $request->userAgent());
    }
}
