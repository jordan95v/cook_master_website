<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    public function showSubscription(Request $request, string $plan = null)
    {
        $stripe = Cashier::stripe();
        $prices = $stripe->prices->all(); // here you get all prices
        if ($plan != null) {
            foreach ($prices as $price) {
                $recurring = ($price->recurring->interval == "year") ? "_ANNUAL_PLAN_ID" : "_PLAN_ID";
                if ($price->id == env(strtoupper($plan) . $recurring)) {
                    $items[$price->recurring->interval] = $price->unit_amount / 100;
                }
            }
        }
        return ($plan != null) ? view("subscription.subscribe-plan", ["plan" => $plan, "subscriptions" => $items]) : view("subscription.subscribe");
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            "plan" => "required|in:starter,pro",
            "payment-method-id" => "required",
        ]);
        $user = User::find(Auth::id());
        $paymentMethod = $request->get("payment-method-id");
        $subscriptionName = $request->get("plan") . (($request->get("recurring") == "year") ? "_annual" : "");
        foreach (["starter", "pro"] as $plan) {
            if ($user->subscribed($plan) || $user->subscribed($plan . "_annual")) {
                return back()->with("error", "Attendez la fin de votre abonnement actuel pour vous réabonnez.");
            }
        }
        $user->newSubscription($subscriptionName, env(strtoupper($subscriptionName) . "_PLAN_ID"))->create($paymentMethod);
        return redirect("/")->with("success", "Vous vous êtes abonné.");
    }
}
