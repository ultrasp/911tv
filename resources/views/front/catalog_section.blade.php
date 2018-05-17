<section class="section catalog" id="catalog">
  <div class="section-background">
    <div class="section-bg-wrapper">
      <div class="section-media"></div>
      <div class="section-overlay"></div>
    </div>
  </div>
  <div class="container w1170">
    <div class="content-wrapper">
      <div class="section-heading tt-a-c">
        <h2 class="heading-2 tt-proximanova tt-w-6"><span class="tt-w-8">КАТАЛОГ</span> КАНАЛОВ</h2>
        {{-- <p class="under-title-description">удобный поиск - <strong>найдите канал</strong> по категории</p> --}}
      </div>
      <div class="content-box">
{{--         <div class="channel-filter-wrapper">
          <div class="button-wrapper">
            <div class="btn filter-btn active" data-filter="all">Все каналы</div>
          </div>
        </div>
 --}}        
        <ul class="channel-list">
          @foreach($channels as $channel)
          <li class="item-wrapper" data-filter="01_COM">
            <div class="item" id="channel{{$channel->id}}" title="{{$channel->title}}" data-group-name="">
              <div class="item-inner-wrapper">
                {{-- <div class="hd-label">HD</div> --}}
                <div class="image-wrapper">
                  <img class="lazy" src="{{$channel->getImageUrl()}}" alt="{{$channel->title}}">
                </div>
                <div class="channel-title-wrapper">
                  {{-- <div class="channel-title">{{$channel->title}}</div> --}}
                </div>
                <div class="channel_list" style="display: none">
                  {!! nl2br($channel->content) !!}
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
