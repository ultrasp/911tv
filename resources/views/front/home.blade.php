@extends('layouts.front')

@section('content')
    <main>
	    @include('front.top_section')
	    @include('front.work_section')
	    @include('front.devices_section')
	    @include('front.catalog_section',['channels' => $channels])
	    @include('front.link_section')
	    @include('front.prices_section',['specialchannels' => $specialchannels])
	    @include('front.payment_section')
	    @include('front.ask_question_section')
	</main>
<div class="remodal-wrapper remodal-is-closed" style="display: none;">
	<div class="remodal any-modal remodal-is-initialized remodal-is-closed" data-remodal-id="channels_list" data-remodal-options="hashTracking:false" tabindex="-1">
    	<button data-remodal-action="close" class="remodal-close"></button>
    	<div class="box-tb-padding-55">
	        <div id="activation-message" class="tt-a-с tt-l-26 tt-s-20 notification">
	        	<span style="color:darkred">
	        		Список каналов
	        	</span>
	        	<div class="list"></div>
	        	<a class="btn large select_tarif" id="select_tarif" href="#price">
	        		Выбрать тариф
	        	</a>
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
