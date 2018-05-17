@extends('layouts.front')

@section('content')
<main class="no-main-section" id="main-screen">
	<span class="padding-top" data-nav-scroll-switcher="-60"></span>
	<section class="section inner acc_log" id="acc_log">
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
					<h2 class="heading-2 tt-proximanova tt-w-6 tt-a-c tt-c-white">ИСТОРИЯ 
						<span class="mobile-block tt-w-8">ВАШИХ ПЛАТЕЖЕЙ</span>
					</h2>
	                <p class="under-title-description tt-a-c tt-c-white">здесь есть информация о ваших операциях: <strong>пополнения счета, история операций</strong>
	                </p>
	            </div>
	        </div>
	    </div>
	</section>
	<div class="section acc_log-content" id="acc_log-content">
		<div class="section-background">
			<div class="section-bg-wrapper">
				<div class="section-media"></div>
				<div class="section-overlay"></div>
			</div>
		</div>
		<ul>
			<li>
				<div class="container w1170">
					<div class="content-wrapper">
						<div class="caption_block box-lr-padding-0 box-tb-padding-0 border-none">
							<div class="box-b-margin-20 short">
								<span class="cab-heading">
									История операций
								</span>
							</div>
						</div>
						<table id="utable-n" style="width:100%;font-size:20px;margin-top:15px;color:#567;text-align:center;border-collapse: none;">
							<thead>
								<tr title="uniqe_head_title_never_find" style="height:20px;font-weight:none;font-size:15px;color:#4e4e4e;background:#eee;">
									<td style="width:90px;padding-left:5px;">Номер</td>
									<td style="width:170px;padding-left:5px;">Дата</td>
									<td style="width:200px;">Сумма</td>
									<td style="">Операция</td>
								</tr>
							</thead>
							<tbody>
								@foreach($finances as $item)
								<tr style="height:42px;">
									<td style="font-size:14px;color:#afafaf;padding-left:5px;padding-right:5px;">
										<span style="display:inline-block;color:#fff;padding:2px 6px 1px;background-color:#c1c1c1;">
										{{$item->id}}
										</span>
									</td>
									<td style="font-size:16px;padding-right:4px;color:#a5a9b1;">
										{{$item->created_at->format('d.m.Y H:i')}}
									</td>
									<td style="font-size:16px;padding-right:5px;">
										<span class="money_point" style="display:inline-block;color:#0087ff;line-height:16px;border:1px solid #0087ff;padding:3px 6px;">
											{{$item->getSign().$item->amount}}
										</span>
									</td>
									<td style="font-size:14px;color:#282828;">
										{{$item->details}}
									</td>
								</tr>
								@endforeach
								<tr title="uniqe_head_title_never_find" style="height:30px;font-family:Proxima Nova;font-weight:700;font-size:16px;color:#4e4e4e;background:transparent;border-top:1px solid #000;">
									<td style="font-weight:700;font-size:18px;color:#282828;">Всего</td>
									<td></td>
									<td style="color:#0087ff;font-weight:700;font-size:18px;">${{Auth::user()->amount}}</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<a href="{{route('front.cabinet')}}" style="font-size:18px;">вернуться назад</a>
				</div>
			</li>
		</ul>
	</div>
</main>
<style type="text/css">
.money_point:empty{padding:0!important;border:none!important;}
span.status_point:empty{padding:0!important;border:none!important;}
</style>
@endsection
