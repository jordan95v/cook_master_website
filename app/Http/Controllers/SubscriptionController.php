<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function showSubscription(Request $request)
    {
        return view("subscription.subscribe");
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            "plan" => "required|in:starter,pro",
            "payment-method-id" => "required",
        ]);
        $paymentMethod = $request->get("payment-method-id");
        if ($request->get("plan") == "starter") {
            $request->user()->newSubscription("starter", env("STARTER_PLAN_ID"))->create($paymentMethod);
        } elseif ($request->get("plan") == "pro") {
            $request->user()->newSubscription("pro", env("PRO_PLAN_ID"))->create($paymentMethod);
        }
        return redirect("/")->with("success", "Vous vous êtes abonné.");
    }
}
