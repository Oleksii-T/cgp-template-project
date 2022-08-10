<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\Page;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $plansByIntervals = [];
        $plansByIntervals = SubscriptionPlan::orderBy('price')->get()->groupBy('interval');
        $activeSub = $user?->activeSubscription();
        $page = Page::get('subscription-plans');

        return view('subscription-plans.index', compact('plansByIntervals', 'activeSub', 'page'));
    }

    public function show(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        return view('subscription-plans.show', compact('subscriptionPlan'));
    }
}
