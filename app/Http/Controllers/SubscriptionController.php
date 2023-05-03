<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        return view("subscription.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "plan" => "required|in:starter,pro",
            "payment-method-id" => "required",
        ]);
        $paymentMethod = $request->get("payment-method-id");
        if ($request->get("plan") == "starter") {
            // $request->user()->newSubscription('default', 'price_1N3YaACBS6s70tEyPc49KAgU')->createAndSendInvoice();
            $request->user()->newSubscription("starter", env("STARTER_PLAN_ID"))->create($paymentMethod);
        } elseif ($request->get("plan") == "pro") {
            $request->user()->newSubscription("pro", env("PRO_PLAN_ID"))->create($paymentMethod);
        }
        return redirect("/")->with("success", "Vous vous êtes abonné.");
    }
}
