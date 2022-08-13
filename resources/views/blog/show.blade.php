@extends('layouts.app')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="post-page">
                <div class="container post-page__container">
                    <div class="post-page__body">
                        <span class="post-page__data">
                            {{$blog->created_at->format('M d, Y')}}
                        </span>
                        <h2 class="section-title">
                            {{$blog->title}}
                        </h2>
                        <div class="post-page__img">
                            <img src="{{$blog->thumbnail->url}}" alt="">
                        </div>
                        <div class="text">
                            <p>{!!$blog->content!!}</p>
                            <div class="images">
                                @foreach ($blog->images as $image)
                                    <img style="max-width: 300px" src="{{$image->url}}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer />
    </div>
@endsection

