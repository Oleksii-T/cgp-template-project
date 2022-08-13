<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.index'));
});

// Users
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.edit', function ($trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit User # ' . $user->id, route('admin.users.edit', $user->id));
});
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create User', route('admin.users.create'));
});

// Settings
Breadcrumbs::for('admin.settings.index', function ($trail) {
    $trail->push('Settings', route('admin.settings.index'));
});

// Subscription plans
Breadcrumbs::for('admin.subscription-plans.index', function ($trail) {
    $trail->push('Subscription plans', route('admin.subscription-plans.index'));
});
Breadcrumbs::for('admin.subscription-plans.edit', function ($trail, $plan) {
    $trail->parent('admin.subscription-plans.index');
    $trail->push('Edit plan # ' . $plan->id, route('admin.subscription-plans.edit', $plan->id));
});
Breadcrumbs::for('admin.subscription-plans.create', function ($trail) {
    $trail->parent('admin.subscription-plans.index');
    $trail->push('Create Plan', route('admin.subscription-plans.create'));
});

// Subscription features
Breadcrumbs::for('admin.subscription-features.index', function ($trail) {
    $trail->push('Subscription Features', route('admin.subscription-features.index'));
});
Breadcrumbs::for('admin.subscription-features.edit', function ($trail, $feature) {
    $trail->parent('admin.subscription-features.index');
    $trail->push('Edit Feature # ' . $feature->id, route('admin.subscription-features.edit', $feature->id));
});
Breadcrumbs::for('admin.subscription-features.create', function ($trail) {
    $trail->parent('admin.subscription-features.index');
    $trail->push('Create Feature', route('admin.subscription-features.create'));
});

// Subscriptions
Breadcrumbs::for('admin.subscriptions.index', function ($trail) {
    $trail->push('Subscriptions', route('admin.subscriptions.index'));
});
Breadcrumbs::for('admin.subscriptions.show', function ($trail, $sub) {
    $trail->parent('admin.subscriptions.index');
    $trail->push('Subscription # ' . $sub->id, route('admin.subscriptions.show', $sub));
});

// Pages
Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->push('Pages', route('admin.pages.index'));
});
Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push('Create Page', route('admin.pages.create'));
});
Breadcrumbs::for('admin.pages.edit', function ($trail, $model) {
    $trail->parent('admin.pages.index');
    $trail->push('Edit Page # ' . $model->id, route('admin.pages.edit', $model->id));
});
Breadcrumbs::for('admin.pages.edit-blocks', function ($trail, $model) {
    $trail->parent('admin.pages.edit', $model);
    $trail->push('Edit Page # ' . $model->id . ' Blocks', route('admin.pages.edit-blocks', $model->id));
});

// Menus
Breadcrumbs::for('admin.menus.index', function ($trail) {
    $trail->push('Menus', route('admin.menus.index'));
});
Breadcrumbs::for('admin.menus.edit', function ($trail, $model) {
    $trail->parent('admin.menus.index');
    $trail->push('Edit Menu # ' . $model->id, route('admin.menus.edit', $model->id));
});

// Menus
Breadcrumbs::for('admin.feedbacks.index', function ($trail) {
    $trail->push('Feedbacks', route('admin.feedbacks.index'));
});
Breadcrumbs::for('admin.feedbacks.show', function ($trail, $model) {
    $trail->parent('admin.feedbacks.index');
    $trail->push('Feedback # ' . $model->id, route('admin.feedbacks.show', $model));
});

// Menus
Breadcrumbs::for('admin.blogs.index', function ($trail) {
    $trail->push('Blogs', route('admin.blogs.index'));
});
Breadcrumbs::for('admin.blogs.create', function ($trail) {
    $trail->push('Create Blog', route('admin.blogs.create'));
});
Breadcrumbs::for('admin.blogs.edit', function ($trail, $model) {
    $trail->parent('admin.blogs.index');
    $trail->push('Edit Blog # ' . $model->id, route('admin.blogs.edit', $model));
});
