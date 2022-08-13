@extends('layouts.app')

@section('content')
    <div class="wrapper_main pt-74">
        <main class="content">
            <section class="blog-news first-section-padding">
                <div class="container blog-news__container">
                    <div class="blog-news__body">
                        <h2 class="section-title">Blog</h2>
                        <div class="custom-row blog-news__row">
                            @foreach ($blogs as $blog)
                                <article class="article-item preveiw">
                                    <a href="{{route('blog.show', $blog)}}">
                                        <div class="article-item__img">
                                            <img src="{{$blog->thumbnail->url}}" alt="">
                                        </div>
                                        <h3 class="article-item__title">{{$blog->title}}</h3>
                                        <span class="article-item__date">{{$blog->created_at->format('M d, Y')}}</span>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                        <div class="pagination">

                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-footer />
    </div>
@endsection
