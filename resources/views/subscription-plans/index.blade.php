@extends('layouts.app')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="pricing first-section-padding">
                <div class="container pricing__contaner">
                    <div class="pricing__body">
                        <h2 class="section-title">Pricing</h2>
                        <p class="section-subtitle">Here are some screenshots of our product and features</p>
                        @if (session('error'))
                            <p class="section-subtitle custom-error">{{session('error')}}</p>
                        @endif
                        <div class="pricing-actions">
                            @foreach ($plansByIntervals as $interval => $plans)
                                <button type="button" class="pricing-actions__item {{$loop->first ? 'active' : ''}}" data-interval={{$interval}}>{{$interval}}</button>
                            @endforeach
			            </div>

                        @foreach ($plansByIntervals as $interval => $plans)
                            <div class="custom-row pricing-plans {{$loop->first ? '' : 'd-none'}}" data-interval={{$interval}}>
                                @foreach ($plans as $plan)
                                    <div class="custom-col-3">
                                        <div class="pricing-item">
                                            <div class="pricing-item__head">
                                                <h3>{{$plan->title}}</h3>
                                                @if ($plan->popular)
                                                    <span class="pricing-item__stiker">Popular</span>
                                                @endif
                                            </div>
                                            <div class="pricing-item__price">
                                                {{$plan->price==0? 'Free' : $plan->price_readable}}
                                            </div>
                                            <div class="pricing-item__desc">
                                                {!!$plan->description!!}
                                            </div>
                                            <ul class="pricing-item__list">
                                                @foreach ($plan->features??[] as $feature)
                                                    <li>
                                                        <img src="{{asset('assets/website/img/checkmark-circle-1.svg')}}" alt="">
                                                        {{$feature}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <form action="{{route('subscription-plans.show', $plan)}}" method="post">
                                                @csrf
                                                @if ($activeSub && $activeSub->subscription_plan_id == $plan->id)
                                                    {{-- is active plan --}}
                                                    <button class="btn btn-sm btn-blue-transp" disabled>
                                                        Subscribed
                                                    </button>
                                                @else
                                                    <a href="{{route('subscription-plans.show', $plan)}}" class="btn btn-sm btn-blue-transp">
                                                        Sign Up
                                                    </a>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
        <x-footer />
    </div>
@endsection
