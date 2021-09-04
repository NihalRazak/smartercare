<?php

namespace App\Http\Controllers\Frontend;

require_once('../vendor/autoload.php');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;

class SubscriptionController
{
    public function __construct() {
        // $this->middleware('auth');
    }

    public function retrievePlans() {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        
        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return $plans;
    }
    
    public function showSubscription() {
        $plans = $this->retrievePlans();
        $user = Auth::user();

        return view('frontend.subscribe.subscribe', [
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'plans' => $plans
        ]);
    }

    public function processSubscription(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->post('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        $quantity = $request->input('quantity');
        try {
            $user->newSubscription('default', $plan)
                ->quantity($quantity)
                ->create($paymentMethod, [
                'email' => $user->email
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        
        return redirect()->route('frontend.additionalinfo.index');
    }
}
