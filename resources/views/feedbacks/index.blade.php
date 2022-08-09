@extends('layouts.app')

@php($body_class = 'account-page')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="account first-section-padding">
                <div class="container">
                    <div class="heading-account">
                        <h3>Contact us</h3>
                        <span>Leave a feedback</span>
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
                                                                    Title
                                                                </label>
                                                                <input type="text" class="input" name="title">
                                                                <span data-input="title" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    Email Address
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
                                                                    Content
                                                                </label>
                                                                <textarea class="input" name="text"></textarea>
                                                                <span data-input="text" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3>Attachments</h3>
                                                <div class="form-content">
                                                    <div class="input-group-row">
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    Image
                                                                </label>
                                                                <input type="file" class="input" name="image">
                                                                <span data-input="image" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-col-2">
                                                            <div class="input-group">
                                                                <label class="input-group__title">
                                                                    File
                                                                </label>
                                                                <input type="file" class="input" name="file">
                                                                <span data-input="file" class="input-error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions-butts">
                                        <button type="submit" class="btn btn-sm btn-blue">Send</button>
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
