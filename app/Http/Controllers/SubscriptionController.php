<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isEmployer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    const WEEKLY_AMOUNT = 20;
    const MONTHLY_AMOUNT = 80;
    const YEARLY_AMOUNT = 200;
    const CURRENCY = 'usd';

    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
    }

    public function subscribe()
    {
        return view('subscription.index');
    }

    public function initiatePayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $price = null;
            $billingEnds = null;

            if ($request->is('pay/weekly')) {
                $price = self::WEEKLY_AMOUNT;
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();
            } elseif ($request->is('pay/monthly')) {
                $price = self::MONTHLY_AMOUNT;
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            } elseif ($request->is('pay/yearly')) {
                $price = self::YEARLY_AMOUNT;
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }

            if ($price !== null) {
                $successURL = URL::signedRoute('payment.success', [
                    'plan' => $request->segment(2),
                    'billing_ends' => $billingEnds,
                ]);

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => self::CURRENCY,
                                'unit_amount' => $price * 100,
                                'product_data' => [
                                    'name' => $request->segment(2),
                                    'description' => $request->segment(2),
                                ],
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment', // Specify the payment mode
                    'success_url' => $successURL,
                    'cancel_url' => route('payment.cancel'),
                ]);
                return redirect($session->url);
//                dd($session);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Update the database with the successful payment information.
        $plan = $request->plan;
        $billingEnds = $request->billing_ends;
        User::where('id',auth()->user()->id)->update([
            'plan'=>$plan,
            'billing_ends'=>$billingEnds,
            'status'=>'paid'
        ]);
        return redirect()->route('dashboard')->with('success','Payment was successfully processed');
    }
    public function cancel()
    {
        // Redirect or handle cancellation logic.
        return redirect()->route('dashboard')->with('error','Payment was unsuccessfully');
    }
}
