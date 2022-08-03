<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionPlanRequest;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Services\StripeService;
use App\Models\Setting;

class SubscriptionPlanController extends Controller
{
    private $stripeService;

    public function __construct()
    {
        try {
            $this->stripeService = new StripeService();
        } catch (\Exception $e) {
            redirect()->route('admin.settings.index')->with('error', $e->getMessage())->send();
        }
    }
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.subscription-plans.index');
        }

        return SubscriptionPlan::dataTable(SubscriptionPlan::query());
    }

    public function create()
    {
        return view('admin.subscription-plans.create');
    }

    public function store(SubscriptionPlanRequest $request)
    {
        try {
            $data = $request->validated();
            $stripePlan = $this->stripeService->createPlan($data['title'], $data['price'], $data['interval'], 1, $data['trial']);
            $data['stripe_id'] = $stripePlan['id'];
            $subscriptionPlan = SubscriptionPlan::create($data);
            $subscriptionPlan->features()->attach($data['features']??[]);
        } catch (\Throwable $th) {
            if (isset($subscriptionPlan)) {
                $subscriptionPlan->delete();
            }

            throw $th;
        }

        return $this->jsonSuccess([
            'redirect' => route('admin.subscription-plans.index')
        ], 'Subscription plan created successfully');
    }

    /**
     * @param SubscriptionPlan $subscriptionPlan
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|mixed
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('admin.subscription-plans.edit', compact('subscriptionPlan'));
    }

    /**
     * @param SubscriptionPlanRequest $request
     * @param SubscriptionPlan $subscriptionPlan
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        $data = $request->validated();
        $stripePlan = $this->stripeService->updatePlan($subscriptionPlan->stripe_id, $data['title'], $data['trial']);
        $subscriptionPlan->update($data);
        $subscriptionPlan->features()->sync($data['features']??[]);

        return $this->jsonSuccess([
            'redirect' => route('admin.subscription-plans.index')
        ], 'Subscription plan updated successfully.');
    }

    /**
     * @param SubscriptionPlan $subscriptionPlan
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        if ($subscriptionPlan->stripe_id) {
            $this->stripeService->deletePlan($subscriptionPlan->stripe_id);
        }

        $subscriptionPlan->delete();

        return $this->jsonSuccess(null, "The Subscription plan #$subscriptionPlan->id successfully deleted!");
    }
}
