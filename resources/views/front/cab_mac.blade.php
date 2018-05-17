<li>
    <div class="container w1170">
        <div class="content-wrapper">
            <span class="btn-block-content-dropdown hide">-</span>
            <div class="caption_block">
                <p class="cab-heading t-black b-black">
                    MAC адрес вашего устройства :
                </p>
                <div class="block-content dropdown-action">
                    <div class="mac_adres_info">
                        @if( is_null($user->mac))
                            Нет MAC адреса 
                        @else
                            {{$user->mac->mac}}
                        @endif
                    </div>
                    <a style="font-size:16px;color:green;" href="" id="change_mac_link">
                        @if( is_null($user->mac))
                            Добавить 
                        @else
                            Изменить
                        @endif
                    </a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</li>