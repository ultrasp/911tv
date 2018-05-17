<div class="remodal-wrapper remodal-is-closed" style="display: none;"><div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="signin-popup" data-remodal-options="hashTracking:false" tabindex="-1">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="box-tb-padding-15">
        <form id="sign-form" class="signin-form" method="post" action="{{route('front.register')}}">
        <!--<form id="sign-form" class="signin-form" method="post" action="">-->
            <input type="hidden" name="partner_id" value="{{request()->input('partner')}}">
            <div class="any-form invert">
                <div class="field-wrapper column box-b-margin-25">
                    <h3 class="tt-a-l heading-h3">регистрация</h3>
                    <h2 class="tt-a-l heading-h2 box-t-margin-10">ЗАПОЛНИТЕ ПОЛЯ</h2>
                    <p class="tt-a-l attention">*все поля обязательны для заполнения</p>
                    <div id="signin-message" class="tt-a-l notification" style="display: none;"></div>
                </div>
                <p class="w-100 label"><span>
                    <input class="styled user_mail" type="email" name="user_mail" id="user_mail" data-url="{{route('front.check_email')}}">
                    <label class="field-label" for="user_mail">E-mail <span class="note">( email@domain.com )</span></label>
                </span></p>
                <p class="w-100 label"><span>
                    <input class="styled user_name" type="text" name="user_name" id="user_name">
                    <label class="field-label" for="user_name">Имя <span class="note">( минимум 2 )</span></label>
                </span></p>
                <p class="w-100 label"><span>
                    <input class="styled user_pass" type="password" name="user_pass" id="user_pass" value="">
                    <label class="field-label" for="user_pass">Введите пароль <span class="note">( минимум 3 )</span></label>
                </span></p>
                <p class="w-100 label"><span>
                    <input class="styled user_pass2" type="password" name="user_pass2" id="user_pass2" placeholder="" value="">
                    <label class="field-label" for="user_pass2">Подтвердите пароль <span class="note">( минимум 3 )</span></label>
                </span></p>
                <div class="w-100" id="recaptcha1">
                    <div class="g-recaptcha" data-sitekey="6Le6JUMUAAAAAEU6rTQ5sJejLABqByWZFjKJcjCs"></div>

                  <!-- <iframe src="asset/anchor(1).html" width="304" height="78" role="presentation" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe> -->
                </div>
                <p class="w-100 sbmt tt-a-l"><span><button class="remodal-confirm btn-submit yellow short" type="submit">Зарегистрироваться</button></span></p>
            </div>
        </form>
    </div>
</div></div>
<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="login-popup" data-remodal-options="hashTracking:false" tabindex="-1">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="box-tb-padding-15">
            <form id="login-form" class="login-form" action="{{route('front.login')}}" method="post">
                <div class="any-form invert">
                    <div class="field-wrapper column box-b-margin-25">
                        <h3 class="heading-h3">авторизация</h3>
                        <h2 class="heading-h2 box-t-margin-10">ЗАПОЛНИТЕ ВСЕ ПОЛЯ</h2>
                        <div id="login-message" class="tt-a-l notification" style="display: none;"></div>
                    </div>
                    <p class="w-100 label">
                        <span>
                            <input class="styled user_mail" required="required" type="email" name="user_mail">
                            <label class="field-label" for="user_mail">Введите E-mail <span class="note">( email@domain.com )</span></label>
                        </span>
                    </p>
                    <p class="w-100 label">
                        <span>
                            <input class="styled" required="required" type="password" name="user_pass">
                            <label class="field-label" for="user_pass">Введите пароль <span class="note">( минимум 3 )</span></label>
                        </span>
                    </p>
                    <p class="w-100 sbmt tt-a-l">
                        <span><button class="remodal-confirm btn-submit yellow short" type="submit">Войти</button></span>
                    </p>
                    <div class="field-wrapper box-t-margin-25">
                        <p class="w-100 sbmt tt-a-l">
                            <span><a class="text-link red recover" href="/#" data-remodal-action="confirm" data-remodal-target="recover-popup">не помню пароль</a></span>
                        </p>
                        <p class="w-100 sbmt tt-a-l">
                            <span><a class="text-link red" href="/#" data-remodal-target="signin-popup">зарегистрироваться</a></span>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="remodal-wrapper remodal-is-closed" style="display: none;"><div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="recover-popup" data-remodal-options="hashTracking:false" tabindex="-1">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="box-tb-padding-15">
        <form id="recover-form" class="recover-form" method="post" action="{{route('front.recover')}}">
            <div class="any-form invert">
                <div class="field-wrapper column box-b-margin-25">
                    <h3 class="heading-h3">воcстановление пароля</h3>
                    <h2 class="heading-h2 box-t-margin-10">ЗАПОЛНИТЕ ПОЛЕ</h2>
                    <div id="recover-message" class="tt-a-l notification" style="display: none;"></div>
                </div>
                <p class="w-100 label">
                    <span>
                        <input class="styled user_mail" required="required" type="email" name="user_mail">
                        <label class="field-label" for="user_mail">Введите E-mail <span class="note">( email@domain.com )</span></label>
                    </span>
                </p>
                <div class="w-100" id="recaptcha2">
                    <div class="g-recaptcha" data-sitekey="6Ld0nUQUAAAAAHosUMslvQXEyONGE8vfrIWyDEnO"></div>
                </div>
                <p class="w-100 sbmt tt-a-l">
                    <span>
                        <button class="remodal-confirm btn-submit yellow short" type="submit">
                            Запросить пароль
                        </button>
                    </span>
                </p>
            </div>
        </form>
    </div>
</div></div>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
    <div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="recover--done--popup" data-remodal-options="hashTracking:false" tabindex="-1">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="box-tb-padding-55">
            <div id="recover-done-message" class="tt-a-с tt-l-26 tt-s-20 notification" style="display: none;"></div>
        </div>
    </div>
</div>