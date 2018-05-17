<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Front'], function() {
	Route::get('/api','HomeController@api')->name('front.api');

	Route::get('/test','HomeController@test')->name('front.test');
	
	Route::get('/','HomeController@index')->name('front.home');
	Route::post('/check_email','UserController@check_email')->name('front.check_email');
	Route::post('/register','UserController@register')->name('front.register');
	Route::get('/approv/{token}','UserController@approv')->name('front.approv');
	Route::get('/help','UserController@help')->name('front.help');
	Route::post('/ask','UserController@save_ask')->name('front.save_ask');
	Route::get('/online','HomeController@online')->name('front.online');
	Route::post('/login', 'LoginController@doLogin')->name('front.login');
	Route::get('/about_partner','HomeController@about_partner')->name('front.about_partner');
	Route::get('/platform/{slug?}','HomeController@platform')->name('front.platform');

	Route::get('/enter/{token}','HomeController@enter')->name('front.enter');
	Route::post('/recover','UserController@recover')->name('front.recover');

	Route::get('/playlist','UserController@playlist')->name('front.playlist');
	Route::get('/update_api','HomeController@updateApi')->name('front.updateApi');

	Route::get('/online_playlist','HomeController@onplaylist')->name('front.onplaylist');

	Route::get('/goToPayment','PaymentController@goToPayment')->name('front.goToPayment');

	Route::get('/admin',function(){
		if(	Auth::check() ){
			return redirect()->route('admin.dashboard');
		}else{
			return redirect()->route('admin.login');
		}
	});

	Route::middleware(['auth'])->group(function() {
		Route::post('/send_mail','UserController@send_mail')->name('front.send_mail');
		Route::get('/logout','UserController@logout')->name('front.logout');
		Route::get('/cabinet','UserController@cabinet')->name('front.cabinet');
		Route::get('/payment','PaymentController@index')->name('front.payment');
		// Route::get('/payment/{provider}','PaymentController@service')->name('front.payment.provider');
		Route::get('/history','PaymentController@history')->name('front.history');
		Route::get('/status/{up?}','UserController@change_status')->name('front.status');
		Route::post('/profile','UserController@profile')->name('front.profile');
		Route::post('/adult_password','UserController@adult_password')->name('front.adult_password');
		Route::post('/help','UserController@save_message')->name('front.save_message');
		Route::get('/cart','PaymentController@cart')->name('front.cart');
		Route::post('/cart','PaymentController@addcart')->name('front.addcart');
		Route::delete('/cart/{id}','PaymentController@delete_from_cart')->name('front.cart.remove');

		Route::post('/mac','UserController@save_mac')->name('front.savemac');

	});

	Route::post('/payment/freekassa911tv3y1n','PaymentController@payed')->name('front.payed');

	Route::post('/payment/interkassa911tv3y1n','PaymentController@payed2')->name('front.payed2');

	Route::get('/payment/success','PaymentController@success')->name('front.payment.success');
	Route::get('/payment/fail','PaymentController@fail')->name('front.payment.fail');

});

Route::group(['namespace' => 'Admin','prefix'=>'admin'], function(){
	//Auth::routes();
	Route::get('/login', 'LoginController@showLogin')->name('admin.login');
	Route::post('/login', 'LoginController@doLogin')->name('admin.login');
	Route::get('logout', array('uses' => 'LoginController@doLogout'));
});

Route::group(['namespace' => 'Admin','prefix'=>'admin', 'middleware' => ['auth:admin']], function() {
	Route::get('/dashboard','AdminController@dashboard')->name('admin.dashboard');

	Route::get('/client','ClientController@index')->name('admin.client.index');
	Route::get('/client/{id}','ClientController@edit')->name('admin.client.edit');
	Route::get('/client/delete/{id}','ClientController@delete')->name('admin.client.delete');
	Route::post('/client/{id}','ClientController@save')->name('admin.client.save');

	Route::get('/channel/add','ChannelController@add')->name('admin.channel.add');
	Route::get('/channel','ChannelController@index')->name('admin.channel.index');
	Route::post('/channel/{id?}','ChannelController@save')->name('admin.channel.save');
	Route::get('/channel/edit/{id}','ChannelController@edit')->name('admin.channel.edit');
	Route::get('/channel/delete/{id}','ChannelController@delete')->name('admin.channel.delete');

	Route::get('/payment','PaymentController@index')->name('admin.payment.index');

	Route::get('/setting','SettingController@index')->name('admin.setting.index');
	Route::post('/setting','SettingController@save')->name('admin.setting.save');
	Route::get('/setting/text','SettingController@edit_text')->name('admin.setting.text');
	Route::post('/setting/text','SettingController@save_text')->name('admin.setting.text.save');

	Route::get('/tarif','TarifController@index')->name('admin.tarif.index');
	Route::get('/tarif/delete/{id}','TarifController@delete')->name('admin.tarif.delete');
	Route::get('/tarif/add','TarifController@add')->name('admin.tarif.add');
	Route::get('/tarif/{id}','TarifController@edit')->name('admin.tarif.edit');
	Route::post('/tarif/{id?}','TarifController@save')->name('admin.tarif.save');

	Route::get('/platform','PlatformController@index')->name('admin.platform.index');
	Route::get('/platform/add','PlatformController@add')->name('admin.platform.add');
	Route::get('/platform/delete/{id}','PlatformController@delete')->name('admin.platform.delete');
	Route::get('/platform/{id}','PlatformController@edit')->name('admin.platform.edit');
	Route::post('/platform/{id?}','PlatformController@save')->name('admin.platform.save');

	Route::get('/feedback','FeedbackController@index')->name('admin.feedback');
	Route::get('/feedback/{user_id}','FeedbackController@chat')->name('admin.chat');
	Route::post('/feedback/{user_id}','FeedbackController@save')->name('admin.message.save');
	Route::get('/feedback/message_del/{id}','FeedbackController@delete_message')->name('admin.message.delete');
	Route::get('/feedback/delete/{id}','FeedbackController@delete')->name('admin.feedback.delete');



	Route::get('/change_pass','AdminController@change_pass')->name('admin.change_pass');
	Route::post('/change_pass','AdminController@save_pass')->name('admin.change_pass');
	Route::get('/sign_out','AdminController@sign_out')->name('admin.logout');

	
});