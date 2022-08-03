<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Page;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::latest()->limit(5)->get(),
            'users_total' => User::count(),
            'pages' => Page::latest()->limit(5)->get(),
            'pages_total' => Page::count(),
            'plans' => SubscriptionPlan::latest()->limit(5)->get(),
            'plans_total' => SubscriptionPlan::count(),
            'subscriptions' => Subscription::latest()->limit(5)->get(),
            'subscriptions_total' => Subscription::count(),
        ];

        return view('admin.index', compact('data'));
    }
}
