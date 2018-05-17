<section class="section price" id="price">
  <div class="section-background">
    <div class="section-bg-wrapper">
      <div class="section-media"></div>
      <div class="section-overlay"></div>
    </div>
  </div>
  <div class="container w1170">
    <div class="content-wrapper">
      <div class="section-heading mw-975 tt-a-l">
        <h2 class="heading-2 tt-proximanova tt-w-6">ТАРИФЫ</h2>
        <p class="under-title-description">выберите подходящий тариф</p>
      </div>
      <div class="content-box">
        <ul class="price-list">
          @foreach($channels as $channel)
            <li class="price-ticket">
              <div class="ticket-item">
                <div class="ticket-item-wrapper">
                  @foreach($channel->tarifs as $tarif)
                    <div class="price-title {{$tarif->channel->title}}">{{$tarif->channel->title}}</div>
                  <div class="price-value">
                    ${{number_format((float)$tarif->price,2, '.', '')}}
                  </div>
                  @endforeach
                  <div class="price-term">
                    <div class="day-term-value"><span class="value">{{$tarif->period}}</span></div>
                    <div class="day-term-descr"><span class="tt-c-black">месяц</span> просмотра</div>
                    {{-- <img src="{{$tarif->channel->getImageUrl()}}" class="img-responsive"> --}}
                  </div>
                  <div class="button-wrapper box-full-width tt-a-c">
                    <a class="btn large tarif-order addtocartbtn" data-tarif-id="{{$tarif->id}}" href="{{route('front.addcart')}}">Добавить корзинку</a>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        <div class="button-wrapper box-full-width tt-a-r">
            {{-- <a href="#" data-remodal-target="individual-tariff-popup" class="btn big large yellow">подобрать индивидуальный тариф</a> --}}
        </div>
      </div>
    </div>
  </div>
</section>
