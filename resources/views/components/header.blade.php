<header class="header {{request()->routeIs('index') ? '' : 'not-home'}}">
    <div class="container header__container">
        <div class="header__body">
            <a href="{{route('index')}}" class="header__logo logo">
                <img src="{{$headerBlock->show('logo')}}" alt="LOGO">
            </a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    @foreach ($headerMenu as $item)
                        <li>
                            <a href="{{url($item->link)}}">
                                {{$item->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div class="buttons-group">
                @auth
                    <a href="{{route('profile.index')}}" class="btn btn-sm btn-white">
                        {{$headerBlock->show('account')}}
                    </a>
                    <form action="{{route('logout')}}" method="post" id="logout-form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-blue">
                            {{$headerBlock->show('logout')}}
                        </button>
                    </form>
                @else
                    <a href="{{route('login')}}" class="btn btn-sm btn-white">
                        {{$headerBlock->show('login')}}
                    </a>
                @endauth
            </div>
            <div class="header__burger">
                <span></span>
            </div>
        </div>
    </div>
</header>
