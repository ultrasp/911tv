@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section inner support" id="support">
	    <div id="main-screen"></div>
	    <div class="section-background">
	        <div class="section-bg-wrapper">
	            <div class="section-media"></div>
	            <div class="section-overlay op-07"></div>
	        </div>
	    </div>
	    <div class="container w960">
	        <div class="content-wrapper">
	            <div class="section-heading transparent">
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">
	                	ЧАТ <span class="tt-w-8">ТЕХНИЧЕСКОЙ ПОДДЕРЖКИ</span>
	                </h2>
	                <p class="under-title-description tt-a-c tt-c-white">задавайте интересующие вопросы:  <strong>специалист ответит в ближайшее время </strong></p>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="section support-content" id="support-content">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<div class="container w840">
			<div class="content-wrapper box-t-padding-55">
				@if(Auth::check())
					<div class="button-wrapper">
						{{-- <a class="chat_show_prev">показать предыдущие сообщения</a> --}}
					</div>
	                <div id="main-chat-div">
	                	@foreach($old_messages as $item)
	                		@include('front.message',['message' => $item])
	                	@endforeach
	                </div>
	                <a name="send" id="chat-send"></a>
				    {!! Form::open([
			    		'route' => ['front.save_message'],
			    		'class' => 'send-message-form'])!!}
	                    <div class="any-form invert">
	                        <input type="hidden" name="page" value="chat">
	                        <br>
	                        <p class="w-100 label">
	                            <span>
	                                <textarea id="chat-message" name="message"></textarea><br>
	                                <label class="field-label" for="user_name">
	                                	Ваше сообщение
	                                </label>
	                            </span>
	                        </p>
	                        <p class="w-100 sbmt tt-a-l">
	                            <span>
	                                <input type="button" class="chat_btn btn-submit yellow short" value=" отправить ">
	                            </span>
	                        </p>
						</div>
				    {!! Form::close() !!}
					<br>
					<a href="{{route('front.home')}}" style="font-size:16px;color:#b44">назад</a>
				@else
					<p class="tt-s-24 tt-l-36 tt-w-9 tt-a-c">
						Пожалуйста, <a href="#" data-remodal-target="login-popup">авторизируйтесь</a> или <a href="#" data-remodal-target="signin-popup">зарегистрируйтесь</a>, чтобы задать вопрос специалисту в тех.поддержке</p>
				@endif
            </div>
		</div>
	</section>
</main>
@endsection
