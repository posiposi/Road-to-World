<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Reservation;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function index($time, $price, $bikeId, $startTime, $endTime)
    {
        $amount = $time * $price;
        return view('payments.index')
        ->with(['amount' => $amount, 'bikeId' => $bikeId, 'startTime' => $startTime, 'endTime' => $endTime]);
    }
    
    public function payment(Request $request, $amount, $bikeId, $startTime, $endTime)
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
            
            /**
             * 決済完了、DBへカラム変更の指示
             * 
             * @var int $id ログイン中ユーザのid
             * @var string $reservation 該当の予約
             */ 
            $id = Auth::id();
            $reservation = \App\Reservation::where([
            ['user_id', $id], ['bike_id', $bikeId], ['start_at', $startTime], ['end_at', $endTime]
            ])->first();
            /* 決済完了時はpaymentカラムに1を代入 */
            $reservation->payment = 1;
            $reservation->save();

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
