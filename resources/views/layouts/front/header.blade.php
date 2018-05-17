<header class="header" id="header">
  <nav class="navbar-wrapper scroll">
    <div class="container w1170 box-full-height">
      <div class="header-content-wrapper">
        <div class="logo-wrapper">
          <div class="logo">
            <a href="{{route('front.home')}}" class="home">{{$setting->sitetitle}}</a>
          </div>
          <div class="log-wrapper">
            @if(Auth::check())
              <div class="log-in">
                <a href="{{route('front.cabinet')}}" class="text-link">
                  {{Auth::user()->username}}
                </a>
              </div>
              <div class="sign-in">
                <a href="{{route('front.logout')}}" class="text-link">
                  выйти
                </a>
              </div>
            @else
              <div class="log-in"><a href="#" data-remodal-target="login-popup" class="text-link">войти</a></div>
  						<div class="sign-in"><a href="#" data-remodal-target="signin-popup" class="text-link">зарегистрироваться</a></div>
            @endif
          </div>
        </div>
        <ul class="main-menu">
          <li><a href="{{route('front.home').'#playlist'}}">Плейлист</a></li>
          <li><a href="{{route('front.online')}}">ONLINE</a></li>
          <li><a href="{{route('front.home').'#catalog'}}">Каналы</a></li>
          <li><a href="{{route('front.platform')}}">Устройства</a></li>
          <li><a href="{{route('front.home').'#price'}}">Тарифы</a></li>
          <li><a href="{{route('front.home').'#payment'}}">Оплата</a></li>
        </ul>
        <div class="mobile-menu-btn">
          <a href="#menu" class="menu-burger"></a>
        </div>
        <div class="button-wrapper">
          <a href="{{route('front.help')}}" id="help_btn" class="btn btn-short btn-message">
            Помощь
          </a>
          <a href="{{route('front.cart')}}" id="cart_btn" class="btn btn-short btn-cart {{ (App\Models\Order::getCartCount() > 0) ? 'blink' :''  }}">
            <img src="{{asset('images/cart.png')}}" class="img-responsive">
            <span class="cart_count">
              {{ App\Models\Order::getCartCount() }}
            </span>
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>
