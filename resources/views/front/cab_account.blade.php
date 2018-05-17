<li>
	<div class="container w1170" id="bill">
        <div class="content-wrapper">
            <span class="btn-block-content-dropdown hide">-</span>
            <div class="caption_block">
        		<p class="cab-heading">Ваш счет</p>
                <div class="block-content dropdown-action">
                    @if(count($user_channels) > 0)
                    @foreach($user_channels as $item)
                    <div title="$0.00" style="color:#424242;font-size:36px;padding:25px;display: inline-block;">
                        <div><img src="{{$item->channel->getImageUrl()}}" style="width: 50px"></div>
                        <div>
                            <span><strong class="tt-c">{{$item->difDays()}}</strong> <sub>дней</sub></span>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div style="color:#424242;font-size:36px;padding:25px">
                        <div>
                            <span>Нет включенных каналов</span>
                        </div>
                    </div>
                    @endif
                    <div class="button-wrapper box-full-width tt-a-c">
                            <!-- <a class="btn large" href="{{route('front.payment')}}">Пополнить баланс</a> -->
                            <a class="btn btn-inv large" href="{{route('front.history')}}">История платежей</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
