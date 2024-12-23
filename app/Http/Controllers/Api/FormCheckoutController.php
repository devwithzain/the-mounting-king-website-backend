<?php

namespace App\Http\Controllers\Api;

use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Checkout\Session as CheckoutSession;

class FormCheckoutController extends Controller
{
    public function createSession(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'appointmentDate.day' => 'nullable|string',
            'appointmentDate.date' => 'nullable|string',
            'appointmentDate.time' => 'nullable|string',
            'address.address' => 'nullable|string',
            'address.aptUnitFloor' => 'nullable|string',
        ]);

        $items = $data['items'];

        $lineItems = array_map(function ($item) {
            return [
                'quantity' => $item['quantity'],
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => round($item['price'] * 100),
                ],
            ];
        }, $items);

        $appointmentDate = $data['appointmentDate'] ?? [];
        $address = $data['address'] ?? [];

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = CheckoutSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'billing_address_collection' => 'required',
                'metadata' => [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'appointmentDate' => sprintf(
                        "%s, %s, %s",
                        $appointmentDate['day'] ?? '',
                        $appointmentDate['date'] ?? '',
                        $appointmentDate['time'] ?? ''
                    ),
                    'address' => sprintf(
                        "%s, %s",
                        $address['address'] ?? '',
                        $address['aptUnitFloor'] ?? ''
                    ),
                ],
                'success_url' => env('FRONTEND_WEBSITE_URL') . '/?success=true',
                'cancel_url' => env('FRONTEND_WEBSITE_URL') . '/request-a-demo?canceled=true',
            ]);

            return response()->json(['url' => $session->url], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}