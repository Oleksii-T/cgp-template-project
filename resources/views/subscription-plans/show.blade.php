@extends('layouts.app')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="pricing first-section-padding">
                <div class="container pricing__contaner">
                    <div class="pricing__body">
                        <h2 class="section-title">Subscribe to plan "{{$subscriptionPlan->title}}"</h2>
                        <p class="section-subtitle">Sub</p>
                        <form class="porfile-change__form subscribe-form">
                            @csrf
                            <span class="d-none" id="user-data" data-email="{{$currentUser->email}}"  data-name="{{$currentUser->name}}" data-plan="{{$subscriptionPlan->id}}"></span>
                            <div class="porfile-change__form-group">
                                <div class="porfile-change__form-input-wrap">
                                    <label for="email" class="porfile-change__form-label">Card</label>
                                    <div id="cardNumber" class="porfile-change__form-input"></div>
                                </div>
                                <div class="porfile-change__form-input-wrap">
                                    <label for="password" class="porfile-change__form-label">Expiration</label>
                                    <div id="cardExp" class="porfile-change__form-input"></div>
                                </div>
                                <div class="porfile-change__form-input-wrap">
                                    <label for="password" class="porfile-change__form-label">CVC</label>
                                    <div id="cardCVC" class="porfile-change__form-input"></div>
                                </div>
                            </div>
                            <div class="porfile-change__form-btn-wrap">
                                <button type="submit" class="btn btn-blue-border btn-md-3">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <x-footer />
    </div>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/payments.js') }}"></script>
@endpush
