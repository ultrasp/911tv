$(document).ready(function(){
	$('#recover-message').hide();
	$('#recover-done-message').hide();
	$('#signin-message').hide();
	$('#signin-done-message').hide();
	$('#login-message').hide();
	var blinked = $('#cart_btn').hasClass('blink');
	formFieldValidation();
	var recover_popup=$('[data-remodal-id="recover-popup"]').remodal({hashTracking:false});
	var playlist_popup=$('[data-remodal-id="playlist-popup"]').remodal({hashTracking:false});
	var recover_done_popup=$('[data-remodal-id="recover--done--popup"]').remodal({hashTracking:false});
	login_popup=$('[data-remodal-id="login-popup"]').remodal({hashTracking:false});
	var signin_popup=$('[data-remodal-id="signin-popup"]').remodal({hashTracking:false});
	var signin_popup_done=$('[data-remodal-id="signin--done--popup"]').remodal({hashTracking:false});
	var mac_form_popup=$('[data-remodal-id="mac-change-popup"]').remodal({hashTracking:false});

	var canRegister = false;
    var csr = $('meta[name="csrf-token"]').attr('content');
	var channel_list=$('[data-remodal-id="channels_list"]').remodal({hashTracking:false});
	
	$('.item-wrapper').on('click',function(){
		var item = $(this);
		var content = item.find('.channel_list').html();
		$('[data-remodal-id="channels_list"]').find('.list').html(content);
		channel_list.open();
	})

	$('#change_mac_link').on('click',function(e){
		e.preventDefault();
		mac_form_popup.open();
	})

	$('.mac-form').on('submit',function(){
		var mac = $("#mac_adres").val();
		var form = $(this);
		console.log(mac);
		$.ajax({
			type:"POST",
			url: form.attr('action'),
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			data:{mac:mac},
			success:function(msg){
				if(msg == 1){
					swal({
			  			title: 'Мак адрес устройства обновлен.',
						type: 'success',
					});
					$('.mac_adres_info').html(mac);
					mac_form_popup.close();
				}else{
					swal({
			  			title: 'Ошибка при сохранения.',
						type: 'error',
					});
				}
			},
			error:function(){
				swal({
		  			title: 'Ошибка.',
		  			html: 'Неправильный мак адрес!',
					type: 'error',
				});
			}
		})
			//document.location ='?page=cabinet&p_channels='+code;
		return false;
	})


	$('.select_tarif').on('click',function(){
		channel_list.close();		
	})

	$('a.ticket-item').on('click',function(e){
		e.preventDefault();
		block = $(this);
		block.find('form').submit();
	})

	$('a.ticket-item.main').on('click',function(e){
		e.preventDefault();
		btn = $(this);
		$.ajax({
           	type: 'GET',
			url: btn.data('url'),
			cache:false,
			success:function(msg){
				console.log(msg)
				if(msg == 1){
					login_popup.open();
				}else{
					//console.log(msg);
					window.location.replace(msg);
				}
			}	
		})
	})

	$(".remove_from_cart").on('click',function(e){
		btn = $(this);
		item_row = btn.closest('.item_row');
		e.preventDefault();
		$.ajax({
           	type: 'DELETE',
			url: btn.attr('href'),
			cache:false,
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			data:{id:btn.data('id')},
			success:function(msg){
				swal({
		  			title: 'Товар успешно удален с корзину',
					type: 'success',
				})
				console.log(msg);
				item_row.remove();
				$('.total_price').html(msg.price);
				$('.total_amount').val(msg.price);
				$('.free_sign').val(msg.free_sign);
				if(msg.price == 0){
					$('.cart_fil').addClass('hidden');
					$('.empty_cart_warning').removeClass('hidden');
					blinked = false;
					$("#cart_btn").removeClass('blink');
				}
				var item_count = $('.item_row').length;
				$("span.cart_count").html(item_count);

				$('.item_row').each(function(index){
					var num = index + 1;
					$(this).find('.index').html(num);
				})
			},
			error:function(msg){
				swal({
		  			title: 'Ошибка при удалении.',
					type: 'error',
				})
			}
		});
	})


	$('.addtocartbtn').on('click',function(e){
		var btn = $(this);
		var sel_value = btn.closest('.ticket-item-wrapper').find('select:first').val();
		e.preventDefault();
		$.ajax({
			type:"POST",
			url: btn.attr('href'),
			cache:false,
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			data:{id:sel_value},
			success:function(msg){
				if(msg==1){
					swal({
			  			title: 'Товар добавлен в корзину',
						type: 'success',
					})
					var count = parseInt($('.cart_count').html(), 10);
					$('.cart_count').html(count+1);
					blinked = true;
					console.log(blinked);
				}else{
					swal({
			  			title: 'Ошибка при добавление в корзину',
						type: 'error',
					})
				}
			},
			error:function(msg){
				swal({
		  			title: 'Пройдите авторизации или регистрации на сайте.',
					type: 'error',
				})
			}
		});
	})

var timer = 1, max_timer = 10;
setInterval(function(){
	if(blinked && !$("#cart_btn").hasClass('blink') && timer < 5 ){
		$("#cart_btn").addClass('blink');
	}
	if(blinked && timer < max_timer){
		timer += 1;
	}
	if(blinked && $("#cart_btn").hasClass('blink') ){
		if(timer == 5){
			$("#cart_btn").removeClass('blink');
		}

	}
	if(timer == max_timer ){
		timer = 1;
	}
}, 2000);


$("#recover-form").submit(function(){
	var form = $("#recover-form");
	var user_mail=$('#recover-form .user_mail');
	var user_mail_val=$('#recover-form .user_mail').val();
	var data=$(this).serialize();
	data['g-recaptcha-response']=grecaptcha.getResponse();
	console.log(data);
	$.ajax({
		type:"POST",
		url: form.attr('action'),
		data:data,
        headers: {
            'X-CSRF-TOKEN': csr
		},
		success:function(msg){
			if(msg==1){
				user_mail.removeClass('input_red input_green');
				user_mail.val('');
				if(window.grecaptcha) grecaptcha.reset();
				$('#recover-done-message').html('<p class="tt-a-c tt-l-26 tt-s-20">Письмо c инструкцией по воставлению пароля отправлено вам на указанную почту.</p><p class="tt-a-c tt-l-24 tt-s-16">( Если его нет во "Входящих" - проверьте папку "Спам" )</p>');
				$('#recover-done-message').show();
				recover_popup.close();
				recover_done_popup.open();
			}else{
				user_mail.addClass('input_red');
				$('#recover-message').html(msg.error);
				$('#recover-message').show();
				if(window.grecaptcha) grecaptcha.reset();
			}
		},
		error:function(msg){
			var error_text = '';
			$.each(msg.responseJSON.errors, function(index, value){
				error_text += value[0]+"<br>";
			})
			user_mail.addClass('input_red');
			$('#recover-message').html(error_text);
			$('#recover-message').show();
		}
	});
	return false;
});

/*
$("#recover-form").submit(function(){
	var form = $(this);
	var data= {'user_mail' : $('#recover-form .user_mail').val() };
	console.log(data);
	console.log(grecaptcha.getResponse());
	data['g-recaptcha-response']=grecaptcha.getResponse();
	//if(window.grecaptcha) grecaptcha.reset();
	$.ajax({
		type:"POST",
		url: form.attr('action'),
		data:data,
        headers: {
            'X-CSRF-TOKEN': csr
		},
		success:function(msg){
			if(msg==1){
				user_mail.removeClass('input_red input_green');
				if(window.grecaptcha) grecaptcha.reset();
				$('#recover-done-message').html('<p class="tt-a-c tt-l-26 tt-s-20">Письмо c инструкцией по воставлению пароля отправлено вам на указанную почту.</p><p class="tt-a-c tt-l-24 tt-s-16">( Если его нет во "Входящих" - проверьте папку "Спам" )</p>');
				$('#recover-done-message').show();
				recover_done_popup.open();
			}else{
				user_mail.addClass('input_red');
				if(window.grecaptcha) grecaptcha.reset();
			}
		},
		error:function(msg){
			var error_text = '';
			$.each(msg.responseJSON.errors, function(index, value){
				error_text += value[0]+"<br>";
			})
			$('#recover-message').html(error_text);
			$('#recover-message').show();
		}
	});
	return false;
});
*/
$("#sign-form").submit(function(){
	var reg_form = $(this);
	var user_name=$('#user_name').val();
	var user_mail=$('#user_mail').val();
	var user_pass=$('#user_pass').val();
	var data=$(this).serialize();
	if(window.grecaptcha) data['g-recaptcha-response']=grecaptcha.getResponse();
	console.log(canRegister);
	//if(!canRegister) return false;
	$.ajax({
		type:"POST",
		url: reg_form.attr('action'),
		cache:false,
        headers: {
            'X-CSRF-TOKEN': csr
		},
		data:data,
		success:function(msg){
			if(msg==1){
				console.log("Регистрация успешна");
				$('#signin-message').html("Регистрация успешна");
				$('#signin-message').hide();
				if(window.grecaptcha)grecaptcha.reset();
				var login_wrapper='<div class="log-in"><a href="/cabinet" class="text-link">'+user_name+'</a></div><div class="sign-in"><a href="/logout" class="text-link">выйти</a></div>';
				$('.log-wrapper').html(login_wrapper);
				$("#sign-form input").removeClass('input_green input_red');
				signin_popup.close();
				clearFormFields();
				swal({
		  			title: 'Регистрация прошло успешна',
		  			html: '<h3 class="heading-3 tt-w-8">Поздравляем!</h3><br><p class="tt-a-c tt-l-26 tt-s-20">Вы зарегистрированы и авторизированы на сайте. Приятного просмотра.</p>',
					type: 'success',
				})
			}else{
				$("#sign-form #user_mail").removeClass('input_green');
				$("#sign-form #user_mail").addClass('input_red');
				swal({
		  			title: 'Регистрация прошло неуспешна',
					type: 'error',
				})
				if(window.grecaptcha)grecaptcha.reset();
			}
		},
		error:function(msg){
			console.log(msg);
			$("#sign-form #user_mail").removeClass('input_green');
			$("#sign-form #user_mail").addClass('input_red');
			var error_text = '';

			$.each(msg.responseJSON.errors, function(index, value){
				error_text += value[0]+"<br>";
			})
			/*
			swal({
	  			title: 'Ошибки форми регистрации.',
	  			html: error_text,
				type: 'error',
			})*/
			$('#signin-message').html(error_text);
			$('#signin-message').show();
			if(window.grecaptcha)grecaptcha.reset();
		}
	});
	return false;
});
$("#login-form").submit(function(){
	var form = $(this);
	var data=$(this).serialize();
	$.ajax({
		type:"POST",
		url:form.attr('action'),
		data:data,
        headers: {
            'X-CSRF-TOKEN': csr
		},
		success:function(msg){
			if(msg!=0){
				console.log(msg);
				console.log("Авторизация успешна");
				var login_wrapper = '<div class="log-in"><a href="/cabinet" class="text-link">'+msg.name+'</a></div><div class="sign-in"><a href="/logout" class="text-link">выйти</a></div>';
				$('.log-wrapper').html(login_wrapper);
				login_popup.close();
				clearFormFields();
				$('#login-message').hide();
				swal({
		  			title: 'Авторизация успешна.',
					type: 'success',
				})
				//$('.link_wrapper').html(msg.playlist);
			}else{
				$('#login-message').html("Авторизация не успешна");
				$('#login-message').show();
				swal({
		  			title: 'Авторизация не успешна.',
					type: 'error',
				})
				console.log("Авторизация не успешна");
			}
		},
		error:function(msg){
			swal({
	  			title: 'Неправильный логин или пароль.',
				type: 'error',
			})
		}
	});
	return false;
});
function clearFormFields(){
	$('form input').val('');
};
function formFieldValidation(){
	var user_name=$('#user_name');
	var user_mail=$('#user_mail');
	var user_pass=$('#user_pass');
	var user_pass2=$('#user_pass2');
	var valid_email=false;
	canSubmit();
	enableSubmit();
	user_name.focus(nameEvent).keyup(nameEvent);
	user_mail.focus(checkmail).keyup(checkmail).change(checkmail);
	user_pass.focus(passwordEvent).keyup(passwordEvent).keyup(passwordConfirmation);
	user_pass2.focus(passwordConfirmation).keyup(passwordConfirmation);
	$('#user_name, #user_mail, #user_pass, #user_pass2').keyup(enableSubmit);
	function isNameValid(){
		if(user_name.length){
			return user_name.val().length>1;
		}else{
			return false;
		}
	};
	function nameEvent(){
		if(isNameValid()){
			user_name.removeClass('input_red').addClass('input_green');
		}else{
			user_name.removeClass('input_green').addClass('input_red');
		}
	};
	function checkmail(){
		var value=user_mail.val();
		var pattern=/^(([a-zA-Z0-9]|[!#$%\*\/\?\|^\{\}`~&'\+=\-_])+\.)*([a-zA-Z0-9]|[!#$%\*\/\?\|^\{\}`~&'\+=\-_])+@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9\-]+$/;
		if(pattern.test(value)){
			//var data = {'email': user_mail.val()}; 
			//console.log(data);
			$.ajax({
				type:"POST",
				url: user_mail.data('url'),
				data:{'email': user_mail.val()},
		        headers: {
		            'X-CSRF-TOKEN': csr
        		},
				success:function(msg){
					if(msg==1){
						$('#user_mail').removeClass('input_red').addClass('input_green');
						valid_email=true;
					}else{
						$('#user_mail').removeClass('input_green').addClass('input_red');
						valid_email=false;
					}
				}
			});
		}
		else{
			$('#user_mail').removeClass('input_green').addClass('input_red');
			valid_email=false;
		}
		var email=fillName(value);
		$('#user_name').val(email);
		nameEvent();
	};
	function isPasswordValid(){
		return user_pass.val().length>2;
	};
	function isRePasswordValid(){
		return user_pass2.val().length>2;
	};
	function arePasswordsMatching(){
		return user_pass.val()===user_pass2.val();
	};
	function canSubmit(){
		return isNameValid()&&valid_email&&isPasswordValid()&&arePasswordsMatching();
	};
	function passwordEvent(){
		if(isPasswordValid()){
			user_pass.removeClass('input_red').addClass('input_green');
		}else{
			user_pass.removeClass('input_green').addClass('input_red');
		}
	};
	function passwordConfirmation(){
		if(arePasswordsMatching()){
			if(isRePasswordValid()){
				user_pass2.removeClass('input_red').addClass('input_green');
			}else{
				user_pass2.removeClass('input_green').addClass('input_red');
			}
		}else{
			user_pass2.removeClass('input_green').addClass('input_red');
		}
	};
	function enableSubmit(){
		canRegister = canSubmit();
	};
};
function fillName(m){
	var i=m.indexOf("@");
	if(i==-1)i=99;
	var name=m.substr(0,i);return name;
}



$('#form-ask-question').submit(function(){
	var form = $(this);
	$.ajax({
		type:"POST",
		url:form.attr('action'),
        headers: {
            'X-CSRF-TOKEN': csr
		},
		data:{message:$('#text-msg').val()},
		success:function(msg){
			if(msg == "NOT AUTHORIZED" ){
				login_popup.open();
			}else{
				swal({
		  			title: 'Спасибо за вопрос.',
		  			html: '<h3 class="heading-3 tt-w-8">Ждите ответа.</p>',
					type: 'success',
				});
				$('#text-msg').val('');
			}
		},
		error:function(msg){
			swal({
	  			title: 'Ошибка при сохранения.',
				type: 'error',
			})
		}
	});
	return false;
});

var errors_form = $('#form_errors');
if(errors_form.length){
	console.log(errors_form.html().length);	
	if(errors_form.html().length){
		swal({
  			title: 'Ошибка.',
  			html: errors_form.html(),
			type: 'error',
		});
	}
}

var alert_block = $('.message_alert');
if(alert_block.length){
	swal({
			title: alert_block.html(),
		type: alert_block.data('type'),
	});
}

$('.show_kod').on('click',function(){
	$('#p_code_input').val($('#p_channels_code').val());
})

var parentCodeChange_popup = $('[data-remodal-id="parent-code-change-popup"]').remodal({hashTracking:false});
$('.change_code_btn').on('click',function(){
	parentCodeChange_popup.open();
})

$('.adult-form').on('submit',function(){
	var code = $("#new_parent_code").val();
	var form = $(this);
	if(code.length == 4 && Number.isInteger(+code)) {
		console.log('code');
		$.ajax({
			type:"POST",
			url: form.attr('action'),
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			data:{code:code},
			success:function(msg){
				if(msg == 1){
					swal({
			  			title: 'Код обновлен.',
						type: 'success',
					});
					$('#p_code_input').val(code);
					$('#p_channels_code').val(code);
					parentCodeChange_popup.close();
				}else{
					swal({
			  			title: 'Ошибка при сохранения.',
						type: 'error',
					});
				}
			},
			error:function(){
				swal({
		  			title: 'Ошибка.',
		  			html: 'Код должен состоять из 4 цифр!',
					type: 'error',
				});
			}
		})
		//document.location ='?page=cabinet&p_channels='+code;
	} else {
		$("#pCode-change #adult-message").html("<p><span style='color:#b51513;font-size:14px;'>Вы ввели неправильный код!</span></p><p> <span style='color:#b51513;font-size:14px;'>Код должен состоять из 4 цифр!</span>");
	}
	return false;
})

	var after_activation_message = $('[data-remodal-id="after-acrivation-popup"]').remodal({hashTracking:false});
	var need_activation = $('[data-remodal-id="activation-popup"]');	
	var need_activation_popup = need_activation.remodal({hashTracking:false});

	$(".activate_email_btn").on('click',function(){
		var link  = $(this);
		var email = link.data('email');
		var emailSplit = email.split("@");
		domain_email = emailSplit[1];
		need_activation_popup.close();
		$.ajax({
			type: "POST",
			url: link.data('url'),
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			success: function (response) {
				if(response == 1) {
					after_activation_message.open();
					$("#after-acrivation-message").html("<p><span style='color:green';>Письмо с ссылкой активации отправлено на Вашу почту!</span></p><span>Проверить почту: <a target='_blank' href='http://"+domain_email+"'>"+domain_email+"</a></span>");
				} else {
					after_activation_message.open();
					$("#after-acrivation-message").html("<p><span style='color:darkred';>Произошла ошибка!</span></p><span>Свяжитесь с технической поддержкой! <a href='/help'>Перейти</a></span>");
				}
			},
			error: function(response) {
				after_activation_message.open();
				$("#after-acrivation-message").html("<p><span style='color:darkred';>Произошла ошибка!</span></p><span>Свяжитесь с технической поддержкой! <a href='/help'>Перейти</a></span>");
			}
		});
	})

	if(need_activation.length){
		setTimeout(function(){
			need_activation_popup.open();
		}, 1000);
	}

	$('.chat_btn').bind('click',function(){
		$(this).prop('disabled',true);
		var form = $(".send-message-form");
		$.ajax({
			type:"POST",
			url: form.attr('action'),
			data:{message:$('#chat-message').val()},
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			success:function(msg){
				$('#chat-message').val("");
				$('.chat_btn').prop('disabled',false);
				$('#main-chat-div').append(msg.message);
			}
		});
	});
	$('#chat-message').keydown(function(event){
		if(event.ctrlKey&&event.which==13){
			$('.chat_btn').click();
		}
	});

	$("#playlist_link").on('click',function(e){
		var link_btn = $(this);
		e.preventDefault();
		$.ajax({
			type:"GET",
			url: link_btn.data('link'),
			cache:false,
	        headers: {
	            'X-CSRF-TOKEN': csr
			},
			success:function(msg){
				if(msg==0){
					login_popup.open();
					/*
					swal({
			  			title: 'Ошибка.',
			  			html: 'Пройдите авторизации чтобы получить плейлист!',
						type: 'error',
					});*/
				}else{
					playlist_popup.open();
					$(".my_download_playlist").data('link-url',msg);
				}
			}
		})
	})

	$(".my_download_playlist").on('click',function(e){
		e.preventDefault();
		var link = $(this);
		var selected = $("#playlist_select").find('option:selected');
		//$( "#myselect option:selected" )
		//console.log(selected.closest('optgroup'));
		var type = selected.closest('optgroup').data('id');
		var link_play = link.data('link-url')+type+'&output='+ $("#playlist_select").val();
		console.log(link.data('link-url')+type+'&output='+ $("#playlist_select").val());
		window.location.replace(link_play);
	})

	$("#playlist_select").on('change',function(){
		set_select();
	})

	set_select();
	function set_select(){
		var selected = $(':selected', $("#playlist_select"));
		var type = selected.closest('optgroup').attr('label');
		$('#playlist_type').html(type + " : "+$("#playlist_select").find("option:selected").text());
	}
	/*
	var mess_count=0;
	function chat_refresh(){
		$.ajax({
			type:"POST",
			url:'pages/chat-ajax.php',
			data:{chat_read:1},
			success:function(msg){
				if(msg!=mess_count){
					if(mess_count!=0)
						$.ajax({
							type:"POST",
							url:'pages/chat-ajax.php',
							data:{chat_read:2,chat_id:'id'+last_chat_id,room:room_id},
							success:function(msg){
								if(msg!="0"){
									$('#main-chat-div').append(msg);
									$('html, body').animate({scrollTop:$("#chat-send").offset().top-200},1000);
								}
							}
						});
					mess_count=msg;
				}
				setTimeout('chat_refresh()',2000);
			}
		});
	}*/
	/*
	$('.chat_show_prev').bind('click',function(){
		$.ajax({
			type:"POST",
			url:'pages/chat-ajax.php',
			data:{chat_read:2,chat_id:'prev'+first_chat_id,room:room_id},
			success:function(msg){
				if(msg!="0"){
					$('#main-chat-div').prepend(msg);
				}else{
					$('.chat_show_prev').css({display:'none'});
				}
			}
		});
	});
	*/
})

