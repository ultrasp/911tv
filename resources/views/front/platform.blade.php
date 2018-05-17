@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section devices" id="devices">
	    <div class="section-background">
	        <div class="section-bg-wrapper">
	            <div class="section-media"></div>
	            <div class="section-overlay"></div>
	        </div>
	    </div>
	    <div class="container w1170">
	        <div class="content-wrapper">
	            <div class="section-heading grey tt-a-c">
	            	<h2 class="heading-2 tt-proximanova tt-w-6">
	            		ДОСТУПЫЕ <span class="tt-w-8"> УСТРОЙСТВА</span>
	            	</h2>
	            	<p class="under-title-description">
	            		<strong>смотрите iptv</strong> телевидение на удобной для вас платформе
	            	</p>
	            </div>
	            <div class="content-box">
	            	<div class="device-preview">
	            		<ul class="devices-list">
	            			@foreach(App\Models\Platform::getLabels() as $key => $label)
	            				<li class="device-item">
	            					<div class="devise-item-header">
	            						@if($key != 'online')
	            							{{$label}}
	            							@else
	            							<a href="{{route('front.online')}}">
	            								{{$label}}
	            							</a>
	            							@endif
	            					</div>
		            				<div class="devise-item-list">
		            					@php
		            					$platforms = App\Models\Platform::getByType($key);
		            					@endphp
		            					@if( count($platforms) > 0 )
		            					(
		            						@foreach($platforms as $key => $platform)
		            						<a href="{{route('front.platform',[
		            							'slug' => $platform->slug
		            							])}}">
		            							{{$platform->name}}
		            						</a> 
			            						@if(count($platforms)-1 != $key )
			            						,
			            						@endif
		            						@endforeach
		            					)
		            					@endif
		            				</div>
	            				</li>
	            			@endforeach
	            		</ul>
	            		<div class="devices-img">
	            			<img src="{{asset('images/devices-img.png')}}" alt="devices">
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="section device-content" id="device-content">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<div class="container w780">
			<div class="content-wrapper zero">
				@if($cur_platform)
				@if($cur_platform->steps->count() > 0)
					<div id="instructions" class="caption_block zero device">
						<div class="tt-c-003650 d-iblock cab-heading big mb-5">
							Настройка {{$cur_platform->name}}
						</div>
						<div class="tt-s-18 tt-l-20 tt-c-949494 d-block">
							поддерживаемые платформы: {{$cur_platform->os}}
						</div>
						<ul class="manual-list box-t-margin-35 box-b-padding-55">
							@foreach($cur_platform->steps as $step)
								<li>
									{!! $step->content !!}
								</li>
							@endforeach
						</ul>
					</div>
				@endif
				@endif
			</div>
		</div>
	</section>
</main>
<style type="text/css">
	.manual-list li p img {
		width: 100%;
	    max-width: 534px;
    	height: auto;
	}
</style>
@endsection
