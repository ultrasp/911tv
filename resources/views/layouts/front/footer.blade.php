<footer class="footer">
    <div class="section-background">
        <div class="section-bg-wrapper">
            <div class="section-media"></div>
            <div class="section-overlay"></div>
        </div>
    </div>
    <div class="container w1170">
        <div class="content-wrapper">
            <div class="logo-copyright">
                <div class="logo-wrapper">
                    <div class="logo">
                        <a href="" class="home">
                        {{$setting->sitetitle}}
                        </a>
                    </div>
                    <div class="log-wrapper">
                        @if(Auth::check())
                          <div class="log-in">
                            <a href="{{route('front.cabinet')}}" class="text-link">
                              {{Auth::user()->username}}
                            </a>
                          </div>
                          <div class="sign-in">
                            <a href="{{route('front.logout')}}" class="text-link">
                              выйти
                            </a>
                          </div>
                        @else
                          <div class="log-in"><a href="#" data-remodal-target="login-popup" class="text-link">войти</a></div>
                                    <div class="sign-in"><a href="#" data-remodal-target="signin-popup" class="text-link">зарегистрироваться</a></div>
                        @endif
                    </div>
                </div>
                <div class="copy-right-social-wrapper">
                    <div class="copyright">
                        Copyright© 2013-2017. All rights reserved.
                    </div>
                    <div class="social-wrapper box-t-margin-10">
                        <ul class="social-list">
                            <li class="social-item">
                                <a href="{{$setting->facebook}}">
                                    <i class="demo-icon fo-icon-facebook-rect"></i>
                                </a>
                            </li>
                            <li class="social-item">
                                <a href="{{$setting->gplus}}">
                                    <i class="demo-icon fo-icon-googleplus-rect"></i>
                                </a>
                            </li>
                            <li class="social-item">
                                <a href="{{$setting->twitter}}">
                                    <i class="demo-icon fo-icon-twitter-bird"></i>
                                </a>
                            </li>
                            <li class="social-item">
                                <a href="{{$setting->instagram}}">
                                    <i class="demo-icon fo-icon-instagram-filled"></i>
                                </a>
                                {{-- <a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/16.png"></a> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="move-top-arrow">
                <a href="#main-screen" class="to-top scrolled"></a>
            </div>
        </div>
    </div>
</footer>
