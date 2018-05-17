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
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">Онлайн трансляция</h2>
	                <p class="under-title-description tt-a-c tt-c-white"><strong></strong> </p>
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
				<div style="margin-top: 30px">
					<div id="video" style="width: 60%; margin: auto;padding: 10px;" data-url="anMvcGxheWxpc3RfdmlkZW8yMjMudHh0"></div>
				</div>
			</div>
		</div>
	</section>
</main>
@endsection
@push('scripts')
<script src="{{'js/playerjs.js'}}"></script>
<script>
	var url = $("#video").data('url');
	var urlDecoded = atob(url);
	var player = new Playerjs({id:"video",file:urlDecoded});
</script>

@endpush