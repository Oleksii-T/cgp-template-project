@extends('layouts.app')

@section('content')
    <div class="wrapper_main">
        <main class="content">
            <section class="offer">
                <div class="container">
                    <h1>
                        {{$page->show('top:title')}}
                    </h1>
                    <span>
                        {{$page->show('top:text')}}
                    </span>
                    @guest
                        <a href="{{route('register')}}" class="btn btn-standart btn-blue" style="margin-top: 40px">{{$page->show('top:signup')}}</a>
                    @endguest
                </div>
                <div class="offer-image">
                    <img src="{{asset('img/graf.svg')}}">
                </div>
            </section>
            <section class="features pd-100">
                <div class="container">
                    <h2>{{$page->show('features:title')}}</h2>
                    <span>{{$page->show('features:text')}}</span>

                    <div class="feature-items">
                        @foreach ($page->show('features:items') as $item)
                            <div class="feature-item">
                                <img src="{{$item['image']}}">
                                <h3>{{$item['title']}}</h3>
                                <p>{{$item['text']}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="about-us pd-100">
                <div class="container">
                    <h2>{{$page->show('about-us:title')}}</h2>
                    <span>{{$page->show('about-us:text')}}</span>
                    <div class="about-us-items">
                        <div class="about-us-item">
                            <div class="image">
                                <img src="{{$page->show('about-us:block-1-image')}}">
                            </div>
                            <div class="text --right">
                                <h3>{{$page->show('about-us:block-1-title')}}</h3>
                                {!!$page->show('about-us:block-1-text')!!}
                            </div>
                        </div>
                        <div class="about-us-item">
                            <div class="text --left">
                                <h3>{{$page->show('about-us:block-2-title')}}</h3>
                                {!!$page->show('about-us:block-2-text')!!}
                            </div>
                            <div class="image">
                                <img src="{{$page->show('about-us:block-2-image')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer />
    </div>
@endsection
