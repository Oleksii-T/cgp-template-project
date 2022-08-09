<header class="header {{request()->routeIs('index') ? '' : 'not-home'}}">
    <div class="container header__container">
        <div class="header__body">
            <a href="{{route('index')}}" class="header__logo logo">
                <img src="{{asset('img/logo.svg')}}" alt="LOGO">
            </a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li>
                        <a href="{{route('subscription-plans.index')}}">
                            Pricing
                        </a>
                    </li>
                    <li>
                        <a href="/about-us">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="/how-it-works">
                            How It Works
                        </a>
                    </li>
                    <li>
                        <a href="{{route('faq')}}">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{route('feedbacks.index')}}">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="buttons-group">
                @auth
                    <a href="{{route('profile.index')}}" class="btn btn-sm btn-white">
                        Account
                    </a>
                    <form action="{{route('logout')}}" method="post" id="logout-form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-blue">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{route('login')}}" class="btn btn-sm btn-white">
                        Log In
                    </a>
                @endauth
            </div>
            <div class="header__burger">
                <span></span>
            </div>
        </div>
    </div>
</header>
