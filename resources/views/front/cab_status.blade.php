<li>
    <div class="container w1170">
        <div class="content-wrapper">
            <span class="btn-block-content-dropdown hide">-</span>
            <div class="caption_block">
                <p class="cab-heading">Статус аккаунта</p>
				
                <div class="block-content dropdown-action">
                    @if($user->needActivation())
                        <p style="color:darkred">
                            Учетная запись пользователя не подтверждена!
                        </p>
                        <button class="btn large activate_email_btn" id="activation" data-email="{{$user->email}}" data-url="{{route('front.send_mail')}}">
                            Подтвердить учетную запись!
                        </button>
                    @endif
				</div>
            </div>
        </div>
    </div>
</li>