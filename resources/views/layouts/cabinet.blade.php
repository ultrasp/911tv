@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section inner cabinet" id="cabinet">
	    <div class="section-background">
	        <div class="section-bg-wrapper">
	            <div class="section-media"></div>
	            <div class="section-overlay"></div>
	        </div>
	    </div>
	    <div class="container w1170">
	        <div class="content-wrapper">
	            <div class="section-heading transparent">
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">ВАШ <span class="tt-w-8">ЛИЧНЫЙ КАБИНЕТ</span> 
	                </h2>
	                <p class="under-title-description tt-a-c tt-c-white">здесь есть информация о: <strong>счете, статусе аккаунта, ссылке на партнерскую программу </strong> и др.</p>
	            </div>
	        </div>
	    </div>
	</section>
	<section class="section cabinet-content" id="cabinet-content">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<ul class="dropdown-list user">
			@include('front.cab_account',['user_channels' => $user_channels])
            @if($user->needActivation())
				@include('front.cab_status',['user' => $user])
			@endif
			@include('front.cab_form',['user' => $user])
			@include('front.cab_playlist')
			@include('front.cab_partner',['user' => $user])
			{{-- @include('front.cab_password',['user' => $user]) --}}
		</ul>
	</section>
</main>
<style>
.footer {
	z-index:0;
}
.container {
	    margin: 10px auto;
}
section.section .content-wrapper {
				padding-bottom: 10px;
			}
.searchForm {
	font-size:16px;
	color:#bbb;
}
.searchForm__entry {
    margin: 0px auto 16px auto;
	display: inline-block;
}
.searchForm__entry--center {
	margin: auto;
	width: 100%;
}
.searchForm__select {
	height: 46px;
	font-family: 'Proxima Nova';
	font-size: 16px;
	line-height: 18px;
	padding: 5px 5px!important;
	border: 2px solid #bababa;
	outline: 0;
	text-align: left;
	text-transform: initial;
	color: #1c1919;
	background: transparent;
	background-color: transparent;
	-moz-transition: all .35s;
	-o-transition: all .35s;
	-webkit-transition: all .35s;
	transition: all .35s;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	width: 100%;
}
.searchForm__caption {
	margin-top: 10px;
	font-size: 13px;
}
@media screen and (max-width: 770px) {
	.searchForm__entry {
		width: 100%;
	}
}
/* для модального окна костыли */
@media only screen and (min-width: 641px) {
	#news-preview-popup {
		max-width:96%;
		height: 100%;
	}
}
p.btn-left.w-100.sbmt.tt-a-l {
	float: left;
	width: 45%;
	
}
p.btn-right.w-100.sbmt.tt-a-l {
	float: right;
	width: 45%;
	margin-left:10%;
}
@media only screen and (max-width: 568px) {
	p.btn-right.w-100.sbmt.tt-a-l,p.btn-left.w-100.sbmt.tt-a-l {
		width:100%;
		margin: 5px 0;
		float:none;
		text-align: center;
	}
	#preview_iframe {
		height: 400px;
	}
}
#news-text {
	height:10em;
	resize: none;
	padding: 10px;
}
#news-preview-popup {
	padding: 10px;
}
#preview,#news_send {
	margin: 0px 0 10px 0;
}
#preview_view {
	padding: 10px;
}
</style>

<div class="remodal-wrapper remodal-is-closed" style="display: none;">
	<div class="remodal any-modal adult remodal-is-initialized remodal-is-closed" data-remodal-id="parent-code-change-popup" data-remodal-options="hashTracking: false" tabindex="-1">
		<button data-remodal-action="close" class="remodal-close"></button>
    	<div class="box-tb-padding-25">
			<div class="any-form invert">
				<form class="adult-form" id="pCode-change" action="{{route('front.adult_password')}}">
					<div class="any-form cabinet m-0 invert">
						<div class="field-wrapper column box-t-margin-5 box-b-margin-25">
							<h3 class="heading-h3">доступ к каналам для взрослых</h3>
							<div id="adult-message" class="tt-a-l notification">
								
							</div>
						</div>
						<p class="w-100 label box-b-margin-25">
							<span id="adult-content-span">
								<label class="field-label">Введите новый пароль</label>
								<input class="styled tt-a-c" required="required" type="text" id="new_parent_code">
							</span>
						</p>
						<p class="w-100 sbmt tt-a-l">
							<span>
								<button class="remodal-confirm btn-submit yellow short submit_adult_pasword" type="submit">Отправить</button>
							</span>
						</p>
					</div>
				</form>
			</div>
    	</div>
	</div>
</div>
<div class="remodal-wrapper remodal-is-closed" style="display: none;">
	<div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="playlist-popup" data-remodal-options="hashTracking:false" tabindex="-1">
		<button data-remodal-action="close" class="remodal-close"></button>
        <div id="playlist-message" class="tt-a-с tt-l-26 tt-s-20 notification">
		    <div class="container w1170">
				<div class="content-wrapper ">
					<div class="speedtest-block caption_block zero zero-0 tt-w-5 ">
						<div class="cab-heading" style="color: #009cdb;border: 1px solid #009cdb;">
							Вам доступны следующие форматы плейлисты
						</div>
						<div class="regtext any-form center acc_log_c invert">
							<span class="searchForm__caption">Форматы</span>
							<select class="searchForm__select" style="margin:10px 0;" id="playlist_select"> 
								<optgroup style="background:#19D175;" data-id="gigablue" label="GigaBlue">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup data-id="enigma16" label="Enigma 2 OE 1.6">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="dreambox"  label="DreamBox OE 2.0">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;"  data-id="m3u" label="m3u">
									<option value="m3u8">HLS </option>
									<option value="ts" selected="">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="simple"  label="Simple List">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="octagon" label="Octagon">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="starlivev3" label="StarLive v3">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="mediastar" label="MediaStar / StarLive v4">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;"  data-id="enigma216_script" label="Enigma 2 OE 1.6 Auto Script">
									<option value="output=m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="m3u_plus" label="m3u With Options" >
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="starlivev5" label="StarLive v5">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="webtvlist" label="WebTV List">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="ariva" label="Ariva">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="spark" label="Spark">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="gst" label="Geant/Starsat/Tiger">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="fps" label="Fortec999/Prifix9400/Starport">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="revosun" label="Revolution 60/60 | Sunplus">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="starsat7000" label="Starsat 7000">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
								<optgroup style="background:#19D175;" data-id="zorro" label="Zorro">
									<option value="m3u8">HLS </option>
									<option value="ts">MPEGTS</option>
								</optgroup>
							</select>
						
							<div id="playlistLinkPl" style="margin: 10px auto; display: block;">
								<p id="playlist_type">hls</p>
								<div>
									<a style="cursor:pointer" data-link-url="" class="tt-s-20 tt-l-22 tt-w-7 my_download_playlist">Скачать плейлист</a>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
