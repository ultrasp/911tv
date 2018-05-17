<div class="remodal-wrapper remodal-is-closed" style="display: none;">
	<div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="activation-popup" data-remodal-options="hashTracking:false" tabindex="-1">
    	<button data-remodal-action="close" class="remodal-close"></button>
    	<div class="box-tb-padding-55">
	        <div id="activation-message" class="tt-a-с tt-l-26 tt-s-20 notification">
	        		<span style="color:darkred">
	        		Вы не подтвердили учетную запись! После подтверждения учётной записи вам будет предоставлен тестовый период просмотра.
	        	</span>
	        	<button class="btn large activate_email_btn" id="activate" data-email="{{Auth::user()->email}}" data-url="{{route('front.send_mail')}}">
	        		Подтвердить учетную запись!
	        	</button>
        	</div>
    	</div>
	</div>
</div>
<div class="remodal-wrapper remodal-is-closed" style="display: none;">
	<div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="after-acrivation-popup" data-remodal-options="hashTracking:false" tabindex="-1">
		<button data-remodal-action="close" class="remodal-close"></button>
		<div class="box-tb-padding-55">
    		<div id="after-acrivation-message" class="tt-a-с tt-l-26 tt-s-20 notification">
    		</div>
		</div>
	</div>
</div>
