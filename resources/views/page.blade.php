@extends('layouts.app')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="post-page">
                <div class="container post-page__container">
                    <h2 class="section-title">{{$page->title}}</h2>
                    {!! $page->content !!}
                </div>
            </section>
        </main>

        <x-footer />
    </div>
@endsection
