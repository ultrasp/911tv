@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section inner pay_page" id="pay_page">
	    <div id="main-screen"></div>
	    <div class="section-background">
	        <div class="section-bg-wrapper">
	            <div class="section-media"></div>
	            <div class="section-overlay"></div>
	        </div>
	    </div>
	    <div class="container w1170">
	        <div class="content-wrapper">
	            <div class="section-heading transparent">
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">СТРАНИЦА <span class="tt-w-8">ОПЛАТЫ</span> </h2>
	                <p class="under-title-description tt-a-c tt-c-white">выберите удобный метод оплаты: <strong>Frekassa, Interkassa </strong></p>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="section payment" id="payment">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<div class="container w1170">
			<div class="content-wrapper">
				<div class="section-heading border-frame tt-a-с">
					<h2 class="heading-2 tt-proximanova tt-w-6">
						<span class="mobile-block tt-w-8">
							ПЛАТЕЖНЫЕ СИСТЕМЫ, 
						</span>
						С КОТОРЫМИ МЫ РАБОТАЕМ
					</h2>
					<p class="under-title-description">
						используйте наиболее <strong>удобную систему</strong>  для оплаты счета
					</p>
				</div>
				<div class="content-box">
                	<ul class="pay-system-list">
			          	<li class="pay-ticket">
				            <a href="" class="ticket-item">
				              <span class="filled-circle"></span>
				              <img alt="freekassa money" src="images/free_logo.png">
				            </a>
				        </li>
				        <li class="pay-ticket">
				            <a href="" class="ticket-item">
				              <span class="filled-circle"></span>
				              <img alt="interkassa" src="images/interkassa-logo.png">
				            </a>
				        </li>
                	</ul>
                	<div class="button-wrapper box-full-width tt-a-c"></div>
                </div>				
			</div>
		</div>
	</section>
</main>
@endsection
