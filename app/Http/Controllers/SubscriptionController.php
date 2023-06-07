<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Exception\CardException;

class SubscriptionController extends Controller
{
    public function showSubscription(string $plan = null)
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
            return back()->with("error", "Wait the end of your subscription to subscribe again.");
        }
        $request->validate([
            "plan" => "required|in:starter,pro",
            "payment-method-id" => "required",
        ]);
        $subscriptionName = $request->get("plan") . (($request->get("recurring") == "year") ? "_annual" : "");
        try {
            $user->newSubscription($subscriptionName, env(strtoupper($subscriptionName) . "_PLAN_ID"))->create($request->get("payment-method-id"));
        } catch (CardException $th) {
            return back()->with("error", $th->getMessage());
        }

        if ($user->godfather_key != null) {
            User::where('key', $user->godfather_key)->first()->increment('key_used');
        }

        return redirect("/")->with("success", "Congrats, you subscribed.");
    }

    public function cancel()
    {
        $user = User::find(Auth::id());
        $user->subscriptions()->first()->cancel();
        return back()->with("success", "You unsubscribed :(.");
    }

    public function resume()
    {
        $user = User::find(Auth::id());
        $user->subscriptions()->first()->resume();
        return back()->with("success", "Very good, you are back. You resumed your subscription.");
    }
}
