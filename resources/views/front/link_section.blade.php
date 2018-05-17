<section class="catalog" id="playlist">
  <div class="container w1170">
    <div class="content-wrapper">
      <div class="section-heading tt-a-c">
        <h2 class="heading-2 tt-proximanova tt-w-6"><span class="tt-w-8">Ваша персональная ссылка на плейлист:</span></h2>
      </div>
          <div class="tt-a-c">
        <div class="link_wrapper">
          @if(!Auth::check())
          <a id="playlist_link" data-link="{{route('front.playlist')}}">Ссылка будет доступна после авторизации</a>
          @else
            <a style="cursor:pointer" class="tt-s-20 tt-l-22 tt-w-7" id="playlist_link" data-link="{{route('front.playlist')}}">
              Скачать плейлист
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
