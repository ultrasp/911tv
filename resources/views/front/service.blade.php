@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section inner userlist" id="userlist">
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
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">Оплатить</h2>
	                <p class="under-title-description tt-a-c tt-c-white"></p>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="section userlist-content" id="userlist-content">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<div class="container w1170">
			<div class="content-wrapper">
			    {!! Form::model($user, [
		    		'route' => ['front.profile'],
		    		'id' => 'save_user_data',
		    		'class' => 'caption_block mobile'])!!}
	                <p class="cab-heading mb-0">Ваши данные</p>
    	            <div class="block-content dropdown-action">
        	            <div class="regtext any-form mw-520 center cabinet invert box-t-margin-40">
                        	<p class="w-100 label">
                        		<span>
                        			<label class="field-label">Ваш почтовый ящик</label>
            		            {!! Form::text('email',null,[
            		            	'class' =>'reginput',
            		            	'readonly' => ''
            		            	]) !!}
                        	</span>
                        </p>
                        <p class="w-100 label">
                        	<span>
                        		<label class="field-label">Ваше имя</label>
            		            {!! Form::text('username',null,[
            		            	'class' =>'reginput',
            		            	]) !!}
                        	</span>
                        </p>
                        <p class="w-100 label">
                        	<span class="image">
                        		<label class="field-label">Пароль</label>
            		            {!! Form::password('password',null,[
            		            	'class' =>'reginput',
            		            	]) !!}
        		            	<img alt="pass status img" width="46" id="pass_img_status" src="{{asset('images/t.png')}}">
        		            </span>
            		    </p>
                        <p class="w-100 label">
                        	<span>
                        		<label class="field-label">Подтвердите пароль</label>
            		            {!! Form::password('password_confirmation',null,[
            		            	'class' =>'reginput',
            		            	]) !!}
							</span>
						</p>
                        <p class="w-100 sbmt btn-small">
                        	<span class="tt-a-l">
                        		<button class="btn-submit yellow" type="submit">
                        			Сохранить
                        		</button>
                        	</span>
                        </p>
                    </div>
                </div>
		    {!! Form::close() !!}
			</div>
		</div>
	</section>
</main>
@endsection
