<li>
    <div class="container w1170">
        <div class="content-wrapper">
        	<div class="hidden" id="form_errors">@include('errors')</div>
        	@include('front.alert')
            <span class="btn-block-content-dropdown hide">-</span>
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
</li>