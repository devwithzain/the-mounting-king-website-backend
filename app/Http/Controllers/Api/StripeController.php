<?php

namespace App\Http\Controllers\Api;

use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'source' => $request->stripeToken,
                'description' => 'Payment From Customer',
                'amount' => 50000, // Amount in cents (e.g., $500.00)
                'currency' => 'usd',
            ]);

            // Payment was successful
            return redirect()->back()->with('success', 'Your payment was successful. Thank you for your purchase!');
        } catch (CardException $e) {
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}