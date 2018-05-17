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
	                <h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">Программа передач</h2>
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
				<table class="zui-table">
					<thead>
						<tr>
							<th>
								Соревнование
							</th>
							<th>
								Название чемпионата
							</th>
							<th>
								Время показа
							</th>
						</tr>
					</thead>
					<tbody>
					@foreach($program as $item)
						<tr>
							<td>
								{{ $item->name }}	
							</td>				
							<td>
								{{$item->liga}}
							</td>			
							<td style="text-align: center;">
								{{ date('H:i', strtotime($item->hold_date)) }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>
</main>
@endsection
