<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Services\StripeService;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function show(Request $request, SubscriptionPlan $plan)
    {
        return view('dashboard.subscriptions.show', compact('plan'));
    }

    public function store(Request $request)
    {
        $stripeService = new StripeService();
        $user = auth()->user();
        $activeSub = $user->activeSubscription();

        if (!$user->paymentMethods()->count()) {
            return $this->jsonError('No payment method found');
        }

        if ($activeSub) {
            if ($activeSub->status != 'canceled') {
                // case when user manualy canceled previous sub
                $stripeService->cancelSubscription($activeSub->stripe_id);
                $activeSub->cancel();
            }
            $activeSub->cycle->deactivate();
        }

        $subscriptionPlan = SubscriptionPlan::find($request->plan_id);
        $subscription = $stripeService->createSubscription($user->stripe_id, $subscriptionPlan->stripe_id);
        $sub = $user->subscriptions()->create([
            'subscription_plan_id' => $subscriptionPlan->id,
            'stripe_id' => $subscription['id'],
            'status' => $subscription['status'],
        ]);

        $sub->cycles()->create([
            'is_active' => true,
            'expire_at' => Carbon::createFromTimestamp($subscription['current_period_end'])
        ]);

        return $this->jsonSuccess('Subscribed successfully', [
            'redirect' => route('profile.index')
        ]);
    }

    public function paymentMethod(Request $request)
    {
        $stripeService = new StripeService();
        $user = auth()->user();
        $intent_id = $request->intent_id;

        $defaultMethodExist = $user->getDefaultPaymentMethod();
        if (!$defaultMethodExist || $request->use_as_default) {
            $stripeService->setCustomerDefaultMethod($user->stripe_id, $request->paymentMethod['id']);
            $user->paymentMethods()->update([
                'is_default' => false
            ]);
        }
        $user->paymentMethods()->create([
            'is_default' => !$defaultMethodExist ? 1 : $request->use_as_default ?? 0,
            'token' => $request->paymentMethod['id'],
            'data' => $request->paymentMethod,
        ]);

        $stripeService->createCustomer($user);
        $stripeService->attachMethodToCustomer($user->stripe_id, $request->paymentMethod['id']);

        return $this->jsonSuccess('Payments method added successfully', null);
    }

    public function cancel(Request $request)
    {
        $stripeService = new StripeService();
        $user = auth()->user();
        $activeSub = $user->activeSubscription();
        if (!$activeSub) {
            return $this->jsonError('No active subscrption found');
        }

        $stripeService->cancelSubscription($activeSub->stripe_id);
        $activeSub->cancel();

        return $this->jsonSuccess('Subscription canceled successfully', [
            'redirect' => route('profile.index')
        ]);
    }
}
