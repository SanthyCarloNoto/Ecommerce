<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StripePaymentController extends Controller
{
    public function stripe(Request $request): View
    {
        $amount = $request->input('amount', 1000); // Default amount if not provided
        return view('stripe', ['amount' => $amount]);
    }

    public function stripePost(Request $request): RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            Charge::create([
                "amount" => round($request->amount * 100),
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Test payment from your card"
            ]);

            return redirect('/stripe')
                ->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
