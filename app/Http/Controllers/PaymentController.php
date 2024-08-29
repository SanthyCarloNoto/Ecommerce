<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        // Configura la clave secreta de Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Crea un PaymentIntent con la cantidad y la moneda
        $paymentIntent = PaymentIntent::create([
            'amount' => round($request->amount * 100), // Monto en centavos
            'currency' => 'eur',
            'payment_method_types' => ['card'],
        ]);

        // Devuelve el client_secret del PaymentIntent
        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }
}
