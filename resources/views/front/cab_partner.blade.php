<li>
    <div class="container w1170">
        <div class="content-wrapper">
            <span class="btn-block-content-dropdown hide">-</span>
            <div class="caption_block">
                <p class="cab-heading t-black b-black">
                    Ваша ссылка для партнерской программы:
                </p>
                <div class="block-content dropdown-action">
                    <div>
                        <a href="{{route('front.home',['partner' =>$user->partner_code])}}">{{route('front.home',['partner' =>$user->partner_code])}}</a>
                    </div>
                    <a href="{{route('front.about_partner')}}" style="font-size:16px;color:green;">
                        подробнее о партнерской программе 
                    </a>
                    <br>
                    <div style="padding-top:15px;font-size:13px;">
                        <a href="/?page=ownedusers">Привлеченных вами   пользователей: <b>{{$user->partners(true)}}</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>