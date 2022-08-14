@extends('layouts.app')

@php($body_class = 'account-page')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="account first-section-padding">
                <div class="container">
                    <div class="heading-account">
                        <h3>{{$page->show('top:title')}}</h3>
                        <span>{{$page->show('top:text')}}</span>
                    </div>
                    <div class="content-account">
                        <div class="account-sidebar1 tabs">
                            <ul class="hidden-list">
                                <li class="current" rel="account-detail">
                                    <a href="#">
                                        <?php include 'img/account-details-icon.svg'?>
                                        {{$page->show('sidebar:account-details')}}
                                    </a>
                                </li>
                                <li rel="subscriptions">
                                    <a href="#">
                                        <?php include 'img/subscriptions-icon.svg'?>
                                        {{$page->show('sidebar:subscriptions')}}
                                    </a>
                                </li>
                                <li rel="payment-methods">
                                    <a href="#">
                                        <?php include 'img/payments-methods-icon.svg'?>
                                        {{$page->show('sidebar:payment-methods')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('logout')}}">
                                        <?php include 'img/logaut-icon.svg'?>
                                        {{$page->show('sidebar:logout')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="account-content">
                            <div id="account-detail" class="current tab-content">
                                <form action="{{route('profile.update')}}" class="general-ajax-submit" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="heading-tab">
                                        <h3>{{$page->show('account-details:title')}}</h3>
                                    </div>
                                    <div class="account-content">
                                        <div class="tab-info">
                                            <div class="padding">
                                                <h3>{{$page->show('account-details:avatar')}}</h3>

                                                <div class="form-content">
                                                    <div class="input-group-row show-uploaded-file-preview">
                                                        <div class="input-group-col-2">
                                                            <img src="{{$currentUser->avatar}}" alt="" class="custom-file-preview" style="max-width: 100px">
                                                        </div>
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <input type="file" class="input" name="avatar">
                                                                <span data-input="file" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h3>{{$page->show('account-details:personal-info')}}</h3>

                                                <div class="form-content">
                                                    <div class="input-group-row">
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('account-details:name')}}
                                                                </label>
                                                                <input type="text" class="input" name="name" value="{{$currentUser->name}}">
                                                                <span data-input="name" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('account-details:email')}}
                                                                </label>
                                                                <input type="text" class="input" name="email" value="{{$currentUser->email}}">
                                                                <span data-input="email" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h3>{{$page->show('account-details:password-change')}}</h3>

                                                <div class="form-content">
                                                    <div class="input-group-row">
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('account-details:new-password')}}
                                                                </label>
                                                                <div class="input-wrapper">
                                                                    <input type="password" name="password" class="input" placeholder="•••••••••••••••••••••">
                                                                    <button type="button" class="input-button">
                                                                        <img src="{{asset('img/eye-cross_1.svg')}}">
                                                                    </button>
                                                                </div>
                                                                <span data-input="password" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('account-details:confirm-new-password')}}
                                                                </label>
                                                                <div class="input-wrapper">
                                                                    <input type="password" name="password_confirmation" class="input" placeholder="•••••••••••••••••••••">
                                                                    <button type="button" class="input-button">
                                                                        <img src="{{asset('img/eye-cross_1.svg')}}">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions-butts">
                                        <button type="submit" class="btn btn-sm btn-blue">{{$page->show('account-details:save')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div id="subscriptions" class="tab-content">
                                <div class="heading-tab">
                                    <h3>{{$page->show('subscriptions:title')}}</h3>
                                </div>
                                <div class="tab-info">
                                    @if ($currentUser->subscriptions()->count())
                                        @foreach ($currentUser->subscriptions()->latest()->get() as $subscription)
                                            <div class="list-subscription {{$subscription->isActive() ? 'active' : ''}}">
                                                @if ($subscription->isActive())
                                                    <span class="active-subscription-label">{{$subscription->isCanceled() ? $page->show('subscriptions:active-canceled') : $page->show('subscriptions:active')}}</span>
                                                @elseif ($subscription->isCanceled())
                                                    <span class="active-subscription-label">{{$page->show('subscriptions:canceled')}}</span>
                                                @endif
                                                <div class="subscription-item">
                                                    <span>{{$page->show('subscriptions:plan')}}</span>
                                                    <span>{{$subscription->plan->title}} ({{$subscription->plan->number_intervals . ' ' . $subscription->plan->interval}})</span>
                                                </div>
                                                <div class="subscription-item">
                                                    <span>{{$page->show('subscriptions:start')}}</span>
                                                    <span>{{$subscription->start_at ? $subscription->start_at->format('F d, Y') : $subscription->created_at->format('F d, Y')}}</span>
                                                </div>
                                                <div class="subscription-item">
                                                    <span>{{$page->show('subscriptions:end')}}</span>
                                                    <span>{{$subscription->cycle->expire_at->format('F d, Y')}}</span>
                                                </div>
                                                @if ($subscription->isActive() && !$subscription->isCanceled())
                                                    <div class="subscription-item">
                                                        <div class="actions">
                                                            <form action="{{route('subscriptions.cancel', $subscription)}}" method="post" class="general-ajax-submit">
                                                                @csrf
                                                                <button type="submit" class="btn btn-white btn-sm ask">{{$page->show('subscriptions:cancel')}}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        {{$page->show('subscriptions:empty')}}
                                        <br />
                                        <br />
                                        <div class="buttons-group">
                                            <a href="{{route('subscription-plans.index')}}" class="btn btn-sm btn-blue">
                                                {{$page->show('subscriptions:empty-button')}}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="payment-methods" class="tab-content">
                                <div class="payment-methods-block1">
                                    <div class="heading-tab">
                                        <h3>{{$page->show('payment-methods:title')}}</h3>
                                        <a href="#" class="btn btn-sm btn-white open-add-payments">{{$page->show('payment-methods:add-button')}}</a>
                                    </div>
                                    <div class="tab-info">
                                        @if ($paymentMethods->isNotEmpty())
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>{{$page->show('payment-methods:methods')}}</th>
                                                    <th>{{$page->show('payment-methods:expires')}}</th>
                                                    <th>{{$page->show('payment-methods:actions')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paymentMethods as $method)
                                                        <tr>
                                                            <th class="methods">
                                                                <div class="card">
                                                                    <img src="#" alt="">
                                                                    <span class="hidden-text">•••• •••• ••••</span>
                                                                    <span class="visible-text">&nbsp;{{$method->data['card']['last4']}}</span>
                                                                </div>
                                                            </th>
                                                            <th class="expires">{{$method->data['card']['exp_month'] . '/' . $method->data['card']['exp_year']}}</th>
                                                            <th class="actions">
                                                                <div class="action-links">
                                                                    @if ($currentUser->getDefaultPaymentMethod()->id==$method->id)
                                                                        <a type="submit" class="btn btn-xs btn-white disable">{{$page->show('payment-methods:is-default')}}</a>
                                                                    @else
                                                                        <form action="{{route('payment-methods.set-default', $method)}}" method="post" class="general-ajax-submit inline">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-xs btn-white">{{$page->show('payment-methods:set-default')}}</button>
                                                                        </form>
                                                                    @endif
                                                                    <form action="{{route('payment-methods.destroy', $method)}}" method="post" class="general-ajax-submit inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-xs btn-white ask">{{$page->show('payment-methods:delete')}}</button>
                                                                    </form>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            {{$page->show('payment-methods:empty')}}
                                        @endif
                                    </div>
                                </div>
                                <form class="payment-methods-block2 hidden-payment add-payment-method">
                                    <div class="heading-tab">
                                        <h3>{{$page->show('payment-methods:add-title')}}</h3>
                                    </div>
                                    <div class="tab-info tabs-pd">
                                        <div class="account-content">
                                            <div id="credit-card" class="tab-content2 current">
                                                <div class="input-group">
                                                    <label class="input-group__title">{{$page->show('payment-methods:card-number')}}</label>
                                                    <div class="input" id="cardNumber"></div>
                                                </div>
                                                <div class="input-group-row">
                                                    <div class="input-group-col-2">
                                                        <div class="input-group">
                                                            <label class="input-group__title">
                                                                {{$page->show('payment-methods:card-expiration')}}
                                                            </label>
                                                            <div class="input" id="cardExp"></div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group-col-2">
                                                        <div class="input-group">
                                                            <label class="input-group__title">
                                                                {{$page->show('payment-methods:card-ccv')}}
                                                            </label>
                                                            <div class="input" id="cardCVC"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions-butts">
                                        <a href="#" class="btn btn-white btn-form btn-exit">{{$page->show('payment-methods:add-cancel')}}</a>
                                        <button type="submit" class="btn btn-blue btn-form">{{$page->show('payment-methods:add-save')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer />
    </div>
@endsection

@push('scripts')
    <script>
        var STRIPE_PUB_KEY = "{{\App\Models\Setting::get('stripe_public_key')}}";
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/payments.js') }}"></script>
@endpush
