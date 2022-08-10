<a href="" class="scroll_to_top"></a>
<footer class="footer">
    <div class="container fooret__container">
        <div class="fooret__body">
            <div class="footer__top">
                <div class="footer__top-left">
                    <a href="{{route('index')}}" class="footer__logo logo">
                        <img src="{{$footerBlock->show('logo')}}" alt="">
                    </a>
                    <span class="footer__slogan">
                        {{$footerBlock->show('text')}}
                    </span>
                </div>
                <div class="footer__top-right">
                    <nav class="footer__menu">
                        <div class="footer__menu-item">
                            <h4 class="footer__menu-title">{{$footerBlock->show('menu-1')}}</h4>
                            <ul class="footer__menu-list">
                                @foreach ($footer1Menu as $item)
                                    <li>
                                        <a href="{{url($item->link)}}">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="footer__menu-item">
                            <h4 class="footer__menu-title">{{$footerBlock->show('menu-2')}}</h4>
                            <ul class="footer__menu-list">
                                @foreach ($footer2Menu as $item)
                                    <li>
                                        <a href="{{url($item->link)}}">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="footer__menu-item">
                            <h4 class="footer__menu-title">{{$footerBlock->show('menu-3')}}</h4>
                            <ul class="footer__menu-list">
                                @foreach ($footer3Menu as $item)
                                    <li>
                                        <a href="{{url($item->link)}}">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="mailto:{{$footerBlock->show('email')}}">{{$footerBlock->show('email')}}</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="footer__bottom-privaci">{{$footerBlock->show('copyright')}}</p>
                <div class="footer__bottom-right">
                    <div class="footer__bottom-links">
                        @foreach ($footerBottom as $item)
                            <a href="{{url($item->link)}}">{{$item->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
