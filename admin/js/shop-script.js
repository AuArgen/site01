$(document).ready(function(){
	
	$("#newsticker").jCarouselLite({
    vertical: true,
    btnPrev:"#news-next",
    btnNext:"#news-prev",
    visible:3,
    auto:4000,
    speed:800
  }); 
loadcart();
$("#style-grid").click(function(){

$("#block-tovar-grid").show();
$("#block-tovar-list").hide();

$("#style-grid").attr("src","/images/activity_grid.png");
$("#style-list").attr("src","/images/icon-list.png");

$.cookie(' select_style', 'grid');
});


$("#style-list").click(function(){

$("#block-tovar-grid").hide();
$("#block-tovar-list").show();

$("#style-list").attr("src","/images/bulleted_list1.png");
$("#style-grid").attr("src","/images/icon-grid.png");

$.cookie(' select_style', 'list');
});

if($.cookie(' select_style') == 'grid')
{
	$("#block-tovar-grid").show();
	$("#block-tovar-list").hide();

	$("#style-grid").attr("src","/images/activity_grid.png");
	$("#style-list").attr("src","/images/icon-list.png");	
}
else
{
	$("#block-tovar-grid").hide();
	$("#block-tovar-list").show();

	$("#style-list").attr("src","/images/bulleted_list1.png");
	$("#style-grid").attr("src","/images/icon-grid.png");
}


$("#select-sort").click(function(){

$("#sorting-list").slideToggle(200);

});

$('#block-category > ul > li > a').click(function(){

if ($(this).attr('class') != 'active') 
{
	$('#block-category > ul > li > ul').slideUp(400);
	$(this).next().slideToggle(400);

		$('#block-category > ul > li > a').removeClass('active');
		$(this).addClass('active');
		$.cookie('select_cat', $(this).attr('id'));	
}
else
{
	$('#block-category > ul > li > a').removeClass('active');
	$('#block-category > ul > li > ul').slideUp(400);
	$.cookie('select_cat','');
}

});

	/*if ($.cookie('select_cat') != '') 
	{
		$('#block-category > ul > li > # '+$.cookie('select_cat')).addClass('active').next().show();
	} */


	$('#genpass').click(function() {
	$.ajax ( {
		type:"POST",
		url: "functions/genpass.php",
		dataType: "html",
		cache: false,
		success: function(data) {
			$('#reg_pass').val(data);
		}
	});
	});

	$('#reloadcaptcha').click(function(){
	$('#block-captcha > img').attr("src","/reg/reg_captcha.php?r="+Math.random());
	});




	$('.top-auth').toggle(
		function(){
			$(".top-auth").attr("id","active-button");
			$("#block-top-auth").fadeIn(200);
		},
		function(){
			$(".top-auth").attr("id","active-button");
			$("#block-top-auth").fadeOut(200);
		}

		);



	
	$('#button-pass-show-hide').click(function() {
    var statuspass =$('#button-pass-show-hide').attr("class");
    
    if(statuspass == "pass-show") {
        $('#button-pass-show-hide').attr("class","pass-hide");
            var $input = $("#auth_pass");
            var change ="text";
            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                .attr("id",$input.attr("id"))
                .attr("name",$input.attr("name"))
                .attr('class',$input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;
    } else {
        $('#button-pass-show-hide').attr("class","pass-show");
            var $input = $("#auth_pass");
            var change ="password";
            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                .attr("id",$input.attr("id"))
                .attr("name",$input.attr("name"))
                .attr('class',$input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;
    }
});﻿



$("#button-auth").click(function(){
	var auth_login = $("#auth_login").val();
	var auth_pass = $("#auth_pass").val();
	
	if (auth_login == "" || auth_login.length > 30) 
	{
		$("#auth_login").css("border-color","#FDB6B6");
		send_login = 'no';
	}else{ $("#auth_login").css("border-color","#DBDBDB"); send_login = 'yes';} 

	if (auth_pass == "" || auth_pass.length > 15) 
	{
		$("#auth_pass").css("border-color","#FDB6B6");
		send_pass = 'no';
	}else{ $("#auth_pass").css("border-color","#DBDBDB"); send_pass = 'yes';}

	if ($("#rememberme").prop('checked')) 
	{
		auth_rememberme = 'yes';

	} else{ auth_rememberme = 'no'; }

	if (send_login == 'yes' && send_pass == 'yes') 
	{
		$("#button-auth").hide();
		$(".auth-loading").show();

		 $.ajax({
  type: "POST",
  url: "../include/auth.php",
  data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
  dataType: "html",
  cache: false,
  success: function(data) {

  if (data == 'yes_auth')
  {
    location.reload();
  }else{
    
    $("#message-auth").slideDown(400);
    $(".auth-loading").hide();
    $("#button-auth").show();
   }﻿
	}
});
		}
	});
	



$('#remindpass').click(function(){
	$('#input-email-pass').fadeOut(200, function(){
		$('#block-remind').fadeIn(300);
	});
});

$('#prev-auth').click(function(){
	$('#block-remind').fadeOut(200, function(){
		$('#input-email-pass').fadeIn(300);
	});
});


$('#button-remind').click(function(){
	var recall_email = $("#remind-email").val();

	if (recall_email == "" || recall_email.length > 30) 
	{
		$("#remind-email").css("border-color","#FDB6B6");
	}
	else
	{
		$("#remind-email").css("border-color","DBDBDB");

		$("#block-remind").hide();
		$(".auth-loading").show();

		$.ajax({
			type:"POST",
			url:"/include/remind-pass.php",
			data:"email="+recall_email,
			dataType:"html",
			cache:false,
			success:function(data){

				if (data == 'yes') 
				{
					$(".auth-loading").hide();
					$("#block-remind").show();
					$('#message-remind').attr("class","message-remind-sucsess").html("На ваш E-mail выслан пароль.").slideDown(400);
					setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()", 3000);
				}
				else
				{
					$(".auth-loading").hide();
					$("#block-remind").show();
					$('#message-remind').attr("class","message-remind-error").html(data).slideDown(400);
				}
			}

		});

	}

});

$('#auth-user-info').toggle(
	function () {
		$("#block-user").fadeIn(100);
	},
	function () {
		$("#block-user").fadeOut(100);
	}
	);
// профилден чыгуу    
$('#logout').click(function(){
	$.ajax({
			type:"POST",
			url:"/include/logout.php",
			dataType:"html",
			cache:false,
			success:function(data){
				if (data == 'logout') 
				{
					location.reload();
				}
			}
});
});

$('#input-search').bind('textchange', function(){
	var input_search = $("#input-search").val();

	if (input_search.length >= 2 && input_search.length < 150 ) 
	{
		$.ajax({
			type:"POST",
			url:"/include/search.php",
			data:"text="+input_search,
			dataType:"html",
			cache:false,
			success:function(data){

				if (data > '') 
				{
					$("#result-search").show().html(data);
				}else
				{
					$("#result-search").hide();
				}
			}
		});
	}else
	{
		$("#result-search").hide();
	}
});
//корзинадагы контактты текшеруу
// проверка emaila
function isValidEmailAddress (emailAddress){
var pattern = new RegExp("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+) ?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5}");
return pattern.test(emailAddress);
}
//контакные данные
$('#confirm-button-next').click(function(e){
var order_fio = $("#order_fio").val();
var order_email = $("#order_email").val();
var order_phone = $("#order_phone").val();
var order_address = $("#order_address").val();

if (!$(".order_delivery").is(":checked")) 
{
	$(".label_delivery").css("color","#E07B7B");
	send_order_delivery = '0';
}else{ $(".label_delivery").css("color","black"); send_order_delivery = '1';
//проверка фио
if (order_fio == "" || order_fio.length > 50) 
{
	$("#order_fio").css("border-color","#FDB6B6");
	send_order_fio = '0';
}else{$("#order_fio").css("border-color","#DBDBDB"); send_order_fio = '1';}
//проверка email
if (order_email == "" || isValidEmailAddress(order_email) == false) 
{
	$("#order_email").css("border-color","#FDB6B6");
	send_order_email = '0';
}else{$("#order_email").css("border-color","#DBDBDB"); send_order_email = '1';}
//проверка телефона
if (order_phone == "" || order_phone.length > 50) 
{
	$("#order_phone").css("border-color","#FDB6B6");
	send_order_phone = '0';
}else{$("#order_phone").css("border-color","#DBDBDB"); send_order_phone = '1';}
//проверка addressa
if (order_address == "" || order_address.length > 150) 
{
	$("#order_address").css("border-color","#FDB6B6");
	send_order_address = '0';
}else{$("#order_address").css("border-color","#DBDBDB"); send_order_address = '1';}
}
//глобальная проверка 
if (send_order_delivery == "1" && send_order_fio == "1" && send_order_email == "1" && send_order_phone == "1" && send_order_address == "1") 
{
	//отправка форма
	return true;
}
e.preventDefault();
});

// товарды корзинага кошуу
$('.add-cart-style-list,.add-cart-style-grid,.add-cart,.random-add-cart').click(function(){
	var  tid = $(this).attr("tid");
	$.ajax({
		type:"POST",
		url:"/include/addtocart.php",
		data:"id="+tid,
		dataType:"html",
		cache:false,
		success:function(data){
			loadcart();
		}
	});

});
function loadcart (){
	$.ajax({
		type:"POST",
		url:"/include/loadcart.php",
		dataType:"html",
		cache:false,
		success:function(data){

			if (data == "0") 
			{
				$("#block-basket > a").html("Корзина пуста");
			}else
			{
				$("#block-basket > a").html(data);
				/*$(".itog-price > strong").html(fun_group_price(itogprice));*/
			}
		}
	});
}

function fun_group_price(intprice){
	// группировка цены на карзине
	var result_total = String(intprice);
	var lenstr = result_total.length;

	switch(lenstr){
		case 4:{
			groupprice = result_total.substring(0,1)+" "+result_total.substring(1,4);
			break;
		}
		case 5:{
			groupprice = result_total.substring(0,2)+" "+result_total.substring(2,5);
			break;
		}
		case 6:{
			groupprice = result_total.substring(0,3)+" "+result_total.substring(3,6);
			break;
		}
		case 7:{
			groupprice = result_total.substring(0,1)+" "+result_total.substring(1,4)+" "+result_total.substring(4,7);
			break;
		}
		default:{
			groupprice = result_total;
		}
	}
	return groupprice;
}
// минус тавара
$('.count-minus').click(function(){
	var iid = $(this).attr("iid");

	$.ajax({
		type: "POST",
		url:"/include/count-minus.php",
		data: "id="+iid,
		dataType: "html",
		cache: false,
		success: function(data){
			$("#input-id"+iid).val(data);

			loadcart();

		// переменная с ценной продукта
		var priceproduct = $("#tovar"+iid+" > p").attr("price");
		// Цену умножим на количества
		result_total = Number(priceproduct) * Number(data);

		$("#tovar"+iid+" > p").html(fun_group_price(result_total) + "сом");
		$("#tovar"+iid+ " > h5 > .span-count").html(data);

		itog_price ();
		}
	});
});
//плюс тавара
$('.count-plus').click(function(){
	var iid = $(this).attr("iid");

	$.ajax({
		type: "POST",
		url:"/include/count-plus.php",
		data: "id="+iid,
		dataType: "html",
		cache: false,
		success: function(data){
			$("#input-id"+iid).val(data);

			loadcart();

		// переменная с ценной продукта
		var priceproduct = $("#tovar"+iid+" > p").attr("price");
		// Цену умножим на количества
		result_total = Number(priceproduct) * Number(data);

		$("#tovar"+iid+" > p").html(fun_group_price(result_total) + "сом");
		$("#tovar"+iid+ " > h5 > .span-count").html(data);

		itog_price ();
		}
	});
});
$('.count-input').keypress(function(e){
	if (e.keyCode == 13) 
	{
		var iid = $(this).attr("iid");
		var incount = $("#input-id"+iid).val();

		$.ajax({
			type:"POST",
			url:"/include/count-input.php",
			data:"id="+iid+"&count="+incount,
			dataType: "html",
			cache: false,
			success: function(data){
				$("#input-id"+iid).val(data);
				loadcart();

			// переиенная с ценной продукта
			var priceproduct = $("#tovar"+iid+" > p").attr("price");
			// цену умножим на количество
			result_total = Number(priceproduct) * Number(data);

			$("#tovar"+iid+ " > p").html(fun_group_price(result_total)+ "сом");
			$("#tovar"+iid+ " > h5 > .span-count ").html(data);
			}
		});
	}

});

function itog_price(){
	$.ajax({
		type:"POST",
		url:"/include/itog_price.php",
		dataType:"html",
		cache:false,
		success: function(data){
			$(".itog-price > strong").html(data);
		}
	});
}

// отзыв кнопкасын текшеруу
$('#button-send-review').click(function(){
	var name = $("#name_review").val();
	var good = $("#good-review").val();
	var bad = $("#bad_review").val();
	var comment = $("#comment_review").val();
	var iid = $("#button-send-review").attr("iid");

	if (name != "") 
	{
		name_review = '1';
		$("#name_review").css("border-color","#DBDBDB");
	}else
	{
		name_review = '0';
		$("#name_review").css("border-color","#EDB6B6");
	}

	if (good != "") 
	{
		good_review = '1';
		$("#good-review").css("border-color","#DBDBDB");
	}else
	{
		good_review = '0';
		$("#good-review").css("border-color","#EDB6B6");
	}
	if (bad != "") 
	{
		bad_review = '1';
		$("#bad_review").css("border-color","#DBDBDB");
	}else
	{
		bad_review = '0';
		$("#bad_review").css("border-color","#EDB6B6");
	}
	// глобальная проверка и отправка отзыва
	if (name_review == '1' && good_review == '1' && bad_review == '1') 
	{
		$("#button-send-review").hide();
		$("#reload-img").show();

		$.ajax({
			type:"POST",
			url:"/include/add_review.php",
			data:"id="+iid+"&name="+name+"&good="+good+"&bad="+bad+"&comment="+comment,
			dataType:"html",
			cache:false,
			success:function(){
				setTimeout("$.fancybox.close()",1000);
			}
		});
	}
});

// код кнопки нравится
$('#likegood').click(function(){
	var tid = $(this).attr("tid");

	$.ajax({
		type:"POST",
		url:"/include/like.php",
		data:"id="+tid,
		dataType:"html",
		cache:false,
		success:function(data){
			if (data == 'no') 
			{
				alert('Вы уже голосовали!');
			}
			else
			{
				$("#likegoodcount").html(data);
			}
		}
	});
});
});