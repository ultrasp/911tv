<nav class="menu mobile-menu mm-menu mm-vertical mm-offcanvas mm-fx-menu-slide mm-shadow-page mm-shadow-panels mm-pagedim-black mm-theme-dark mm-multiline" style="display: none;" id="menu" aria-hidden="true">
  <div class="mm-panels">
    <div class="mm-panel mm-vertical mm-hasnavbar" id="mm-2">
      <div class="mm-navbar">
        <a class="mm-title">{{$setting->sitetitle}}</a>
      </div>
      <ul class="mm-listview">
        <li><a href="{{route('front.home').'#playlist'}}">Плейлист</a></li>
        <li><a href="{{route('front.online')}}"  class="link-to">ONLINE</a></li>
        <li><a href="{{route('front.home').'#catalog'}}">Каналы</a></li>
        <li><a href="{{route('front.platform')}}" class="link-to">Устройства</a></li>
        <li><a href="{{route('front.home').'#price'}}">Тарифы</a></li>
        <li><a href="{{route('front.home').'#payment'}}">Оплата</a></li>
				<li><a class="link-to" href="{{route('front.help')}}">Помощь</a></li>
			</ul>
    </div>
  </div>
  <a class="btn-mm-close" href=""></a>
</nav>
