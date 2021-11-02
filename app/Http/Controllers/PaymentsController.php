<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PaymentsController extends Controller
{
    public function index($time, $price)
    {
        $amount = $time * $price;
        return view('payments.index')->with('amount', $amount);
    }
    
    public function payment(Request $request, $amount)
    {
        try
        {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $amount,
                'currency' => 'jpy'
            ));

            return redirect()->route('complete');
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function complete()
    {
        return view('payments.complete');
    }
}
