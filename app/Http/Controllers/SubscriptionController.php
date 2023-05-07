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
        if ($plan != null) {
            $stripe = Cashier::stripe();
            foreach ($stripe->prices->all() as $price) {
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
        $user = User::find(Auth::id());
        if ($user->isSubscribed()) {
            return back()->with("error", "Attendez la fin de votre abonnement actuel pour vous réabonnez.");
        }
        $request->validate([
            "plan" => "required|in:starter,pro",
            "payment-method-id" => "required",
        ]);
        $subscriptionName = $request->get("plan") . (($request->get("recurring") == "year") ? "_annual" : "");
        $user->newSubscription($subscriptionName, env(strtoupper($subscriptionName) . "_PLAN_ID"))->create($request->get("payment-method-id"));
        return redirect("/")->with("success", "Vous vous êtes abonné.");
    }
}
