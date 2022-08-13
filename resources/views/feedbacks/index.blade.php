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
                        <div class="account-content">
                            <div id="account-detail" class="current tab-content">
                                <form action="{{route('feedbacks.store')}}" class="general-ajax-submit" method="POST">
                                    @csrf
                                    <div class="account-content">
                                        <div class="tab-info">
                                            <div class="padding">
                                                <div class="form-content">
                                                    <div class="input-group-row">
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('content:title')}}
                                                                </label>
                                                                <input type="text" class="input" name="title">
                                                                <span data-input="title" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('content:email')}}
                                                                </label>
                                                                <input type="text" class="input" name="email" value="{{$currentUser->email??''}}">
                                                                <span data-input="email" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-content">
                                                    <div class="input-group-row">
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    {{$page->show('content:content')}}
                                                                </label>
                                                                <textarea class="input" name="text"></textarea>
                                                                <span data-input="text" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions-butts">
                                        <button type="submit" class="btn btn-sm btn-blue">{{$page->show('content:send')}}</button>
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
