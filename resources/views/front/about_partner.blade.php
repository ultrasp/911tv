@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section inner partner-header" id="partner-header">
	    <div class="section-background">
	        <div class="section-bg-wrapper">
	            <div class="section-media"></div>
	            <div class="section-overlay"></div>
	        </div>
	    </div>
	    <div class="container w1170">
	        <div class="content-wrapper">
	            <div class="section-heading transparent">
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">
	                	<span class="tt-w-8">ПАРТНЕРСКАЯ</span>  ПРОГРАММА
	            	</h2>
	                <p class="under-title-description tt-a-c tt-c-white"><strong>способ заработка </strong>  на привлеченных Вами клиентах.</p>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="section partner-content" id="speedtest-content">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<div class="container w1170">
			<div class="content-wrapper box-t-padding-60 line-height-1-5">
				<strong>Ваши клиенты</strong> = Cтабильный доход каждый месяц! 
				<br><br>
				<b>Как это работает?</b>
				<br><br>
				У <strong>Вас</strong> есть друг, которого зовут, к примеру, Василий, который хочет смотреть <strong>ТВ</strong>, но не знает где. Вы даете ему ссылку из вашего <a href="{{route('front.cabinet')}}">личного кабинета</a> (не забудьте, не просто ссылку на сайт "<font color="darkred">911tv.info</font>" а именно <font color="lime">Вашу ссылку</font>, например "<font color="green">http://911tv.info/?partner=WeEd1</font>").<br>
				Василий переходит по ссылке, <strong>смотрит ТВ</strong>, думает стоит платить или нет. Система уже отметила, что Василий, хоть и не зарегистрировался на сайте, но пришел от вас. Далее, если Василий регистрируеться, в базе данных он отмечается как <strong>Ваш клиент</strong> по партнерской программе.<br><br>
				Это значит, что <font color="red">20%</font> с каждого его платежа мы переведем на <strong>ВАШ счет</strong>. Эти деньги вы можете использовать как для просмотра ТВ, так и заказать вывод на Ваш електронный кошелек.<br>
				Не забудьте приостановить вашу учетную запись, если планируете накапливать средства!<br><br>
				Заявки на выплаты принимаються на почту <a href="mailto:support@911tv.info">support@911tv.info</a>, с указанием вашего email, суммы вывода и кошелька Webmoney/Qiwi/Yandex.Money/PayPal.<br><br>	
				<strong>Удачного заработка! :)</strong>        
			</div>
		</div>
	</section>
</main>
@endsection
