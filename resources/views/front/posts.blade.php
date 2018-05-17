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
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">Новости</h2>
	                <p class="under-title-description tt-a-c tt-c-white">здесь есть информация о последних новостях: <strong>изменения, добавленные каналы </strong> и др.</p>
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
				@foreach($posts as $post)
					<div style="margin:5px auto;padding:5px;">
						<h2 style="text-align:center">
							{{$post->title}}
						</h2>
					</div>
					<div>{!! $post->content !!}</div>
					<p style="font-size:14px;float:right;">
						{{$post->created_at->format('Y-m-d H:i:s')}}
					</p>
					<div style="clear: both"></div>
				@endforeach
			</div>
		</div>
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
@endsection
