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
          @foreach($specialchannels as $channel)
            <li class="price-ticket">
              <div class="ticket-item">
                <div class="ticket-item-wrapper">
                  <div class="price-title">
                    <img src="{{$channel->getImageUrl()}}">
                  </div>
                  <div class="price-value">
                    <select name="tarif">
                    @foreach($channel->tarifs as $tarif)
                        <option value="{{$tarif->id}}">
                          {{$tarif->period}} 
                          @if($tarif->period == 1)
                          месяц 
                          @elseif($tarif->period < 10)
                          месяца
                          @else
                          месяцев
                          @endif
                          ( {{number_format((float)$tarif->price,2, '.', '')}}$ )
                        </option>
                    @endforeach
                    </select>
                  </div>
                  <div class="button-wrapper box-full-width tt-a-c">
                    <a class="btn large tarif-order addtocartbtn" href="{{route('front.addcart')}}">Добавить в корзину</a>
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
