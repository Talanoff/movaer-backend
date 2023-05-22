<?php

namespace App\Http\Controllers\Api;

use App\Events\Order\OrderCreated;
use App\Events\Vendor\VendorCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Questionnaire\CustomerBookingRequest;
use App\Http\Requests\Questionnaire\VendorJoinRequest;
use App\Repositories\OrderRepository;
use App\Repositories\VendorRepository;
use App\Services\AuthService;
use Auth;
use Illuminate\Http\JsonResponse;
use Response;

class QuestionnaireController extends Controller
{
    public function order(
        CustomerBookingRequest $request,
        OrderRepository $orderRepository,
        AuthService $authService
    ): JsonResponse {
        $order = $orderRepository->store($request->collect());

        event(new OrderCreated($order));

        if ($request->boolean('registrationRequired')) {
            Auth::login($order->user);

            return $authService->login($order->user, $request->userAgent());
        }

        return Response::json(null, 201);
    }

    public function vendor(
        VendorJoinRequest $request,
        VendorRepository $vendorRepository,
        AuthService $authService
    ): JsonResponse {
        $vendorRepository->store($request->collect());

        event(new VendorCreated($vendorRepository->getVendor()));

        Auth::login($vendorRepository->getUser());

        return $authService->login($vendorRepository->getUser(), $request->userAgent());
    }
}
