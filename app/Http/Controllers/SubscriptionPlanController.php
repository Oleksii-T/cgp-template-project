<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $plansByIntervals = [];
        $plansByIntervals = SubscriptionPlan::orderBy('price')->get()->groupBy('interval');
        $activeSub = $user?->activeSubscription();

        return view('subscription-plans.index', compact('plansByIntervals', 'activeSub'));
    }

    public function show(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        return view('subscription-plans.show', compact('subscriptionPlan'));
    }
}
