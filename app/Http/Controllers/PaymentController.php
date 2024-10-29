<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function checkout()
    {
        // Set your Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Create a new Checkout Session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $this->getLineItems(),
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        // Redirect the user to the Stripe Checkout page
        return redirect($session->url);
    }

    public function handlePaymentSuccess()
{
    // Retrieve user and cart details
    $user = Auth::user(); // Get the authenticated user
    $cartItems = Cart::where('user_id', $user->id)->with('package')->get();
    $totalAmount = 0; // Initialize total amount

    foreach ($cartItems as $cartItem) {
        $amount = $cartItem->package->price * $cartItem->selected_pax; // Calculate amount for this cart item
        $totalAmount += $amount; // Add to total amount

        // Create a new payment for the cart item
        $payment = Payment::create([
            'user_id' => $user->id,
            'payment_method' => 'card', // You may get this information from the Stripe response
            'cart_id' => $cartItem->id, // Link this payment to the specific cart item
            'amount' => $amount, // Store the amount for the payment
        ]);

        // Create a new booking for this cart item
        Booking::create([
            'user_id' => $user->id,
            'cart_id' => $cartItem->id,
            'booking_date' => now(),
        ]);
    }

    // After processing payments, dissociate the user from the cart
    foreach ($cartItems as $cartItem) {
        $cartItem->user_id = null; // Set user_id to NULL after payment
        $cartItem->save(); // Save changes
    }

    return view('user.payment.success', compact('totalAmount'));
}

    public function handlePaymentCancel()
    {
        return view('user.payment.cancel');
    }

    private function getLineItems()
    {
        // Retrieve cart items for the authenticated user
        $cartItems = Cart::where('user_id', auth()->id())->with('package')->get();

        // Prepare line items for Stripe Checkout
        $lineItems = [];
        foreach ($cartItems as $cartItem) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr', // Replace with your actual currency code
                    'product_data' => [
                        'name' => $cartItem->package->title,
                    ],
                    'unit_amount' => $cartItem->package->price * 100, // Stripe uses amounts in cents
                ],
                'quantity' => $cartItem->selected_pax,
            ];
        }

        return $lineItems;
    }
}

