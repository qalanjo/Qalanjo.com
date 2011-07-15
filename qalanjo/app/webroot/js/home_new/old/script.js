$(document).ready( function() {
	
	if (action=="login"){
		$("#frames").css("margin-left", "-100%");
		$("#why-join-qalanjo").hide();
	}
	
	$("#MemberGenderId").change(function(){
		selected = $(this).val();
		swap(selected, $("#MemberLookingForId"));
	});
	$("#MemberLookingForId").change(function(){
		selected = $(this).val();
		swap(selected, $("#MemberGenderId"));
	});
	
	validateForm();
	
	
	$('#country').live("change", function() {
		if($('#country :selected').text() == 'United States') {
			$("#state").attr("disabled", false);
		} else {
			$("#state").attr("disabled", true);
		}
	});
	$('.panels a.nav1').click(function() {
		var link = $(this);
		if(!link.hasClass('active')) {
			var panel = $(this).parent().parent().parent();
			panel.css({
				'z-index': '4'
			});
			
			$('#panel-1').css({
				'clip': 'rect(0px, 701px, 0px, 701px)',
				'z-index': '5',
				'display': 'block'
			}).stop().animate(
				{
					'clip': 'rect(0px, 701px, 650px, -16px)'
				},
				{
					duration: 1000,
					easing: 'swing',
					complete: function() {
						panel.css({
							'display': 'none'
						});
					}
				}
			);
		}
	});
	
	$('#btn-why').click(function() {
		var panel = $(this).parent();
		panel.css({
			'z-index': '4'
		});
		
		$('#panel-2').css({
			'clip': 'rect(0px, 701px, 0px, 701px)',
			'z-index': '5',
			'display': 'block'
		}).stop().animate(
			{
				'clip': 'rect(0px, 701px, 650px, -16px)'
			},
			{
				duration: 1000,
				easing: 'swing',
				complete: function() {
					panel.css({
						'display': 'none'
					});
				}
			}
		);
	});
	
	$('.panels a.nav2').click(function() {
		var link = $(this);
		if(!link.hasClass('active')) {
			var panel = $(this).parent().parent().parent();
			panel.css({
				'z-index': '4'
			});
			
			$('#panel-2').css({
				'clip': 'rect(0px, 701px, 0px, 701px)',
				'z-index': '5',
				'display': 'block'
			}).stop().animate(
				{
					'clip': 'rect(0px, 701px, 650px, -16px)'
				},
				{
					duration: 1000,
					easing: 'swing',
					complete: function() {
						panel.css({
							'display': 'none'
						});
					}
				}
			);
		}
	});
	
	$('#btn-how').click(function() {
		var panel = $(this).parent();
		panel.css({
			'z-index': '4'
		});
		
		$('#panel-3').css({
			'clip': 'rect(0px, 701px, 0px, 701px)',
			'z-index': '5',
			'display': 'block'
		}).stop().animate(
			{
				'clip': 'rect(0px, 701px, 650px, -16px)'
			},
			{
				duration: 1000,
				easing: 'swing',
				complete: function() {
					panel.css({
						'display': 'none'
					});
				}
			}
		);
	});
	
	$('.panels a.nav3').click(function() {
		var link = $(this);
		if(!link.hasClass('active')) {
			var panel = $(this).parent().parent().parent();
			panel.css({
				'z-index': '4'
			});
			
			$('#panel-3').css({
				'clip': 'rect(0px, 701px, 0px, 701px)',
				'z-index': '5',
				'display': 'block'
			}).stop().animate(
				{
					'clip': 'rect(0px, 701px, 650px, -16px)'
				},
				{
					duration: 1000,
					easing: 'swing',
					complete: function() {
						panel.css({
							'display': 'none'
						});
					}
				}
			);
		}
	});
	
	$('#btn-new').click(function() {
		var panel = $(this).parent();
		panel.css({
			'z-index': '4'
		});
		
		$('#panel-4').css({
			'clip': 'rect(0px, 701px, 0px, 701px)',
			'z-index': '5',
			'display': 'block'
		}).stop().animate(
			{
				'clip': 'rect(0px, 701px, 650px, -16px)'
			},
			{
				duration: 1000,
				easing: 'swing',
				complete: function() {
					panel.css({
						'display': 'none'
					});
				}
			}
		);
	});
	
	$('.panels a.nav4').click(function() {
		var link = $(this);
		if(!link.hasClass('active')) {
			var panel = $(this).parent().parent().parent();
			panel.css({
				'z-index': '4'
			});
			
			$('#panel-4').css({
				'clip': 'rect(0px, 701px, 0px, 701px)',
				'z-index': '5',
				'display': 'block'
			}).stop().animate(
				{
					'clip': 'rect(0px, 701px, 650px, -16px)'
				},
				{
					duration: 1000,
					easing: 'swing',
					complete: function() {
						panel.css({
							'display': 'none'
						});
					}
				}
			);
		}
	});
	
	$('#login-button').click(function() {
		$('#why-join-qalanjo').fadeOut('fast');
		$('#frames').animate(
				{
					'margin-left': '-100%'
				}, 
				{
					duration: 1000,
					easing: 'easeOutBack'
				}
			);
	});
	
	$('#register-button').click(function() {
		$('#frames').animate(
			{
				'margin-left': '0%'
			}, 
			{
				duration: 1000,
				easing: 'easeOutBack',
				complete: function() {
					$('#why-join-qalanjo').fadeIn('fast');
				}
			}
		);
	});
	
	$('#why-join-qalanjo-link').click(function() {
		return false;
	});
	
	setInterval("slideSwitch()", 5000);
});

function slideSwitch() {
	var $active = $('#slideshow img.active');
	
	if($active.length == 0) {
		$active = $('#slideshow img:last');
	} 
	
	var $next = $active.next().length ? $active.next() : $('#slideshow img:first');
	$next.fadeIn(1000, function() {
		$next.addClass('active');
	}, 'swing');
	$active.fadeOut(1000, function() {
		$active.removeClass('active');
	}, 'swing');
}

function swap(selected, target){
	if (selected==1){
		target.val(2);
	}else if (selected==2){
		target.val(1);
	}
}


/**
 * Validation
 */
var validator;

function defaultSelected(value){
	return value!="-1";
}
function defaultSelectedState(value){
	if($('#country :selected').text() == 'United States') {
		return value!="0";	
	}
	return false;
}




function validateForm(){
	
	
	$(".required").hide();
	$.validator.addMethod("defaultSelected", function(value){
		return defaultSelected(value);
	});
	
	$.validator.addMethod("defaultSelectedState", function(value){
		return defaultSelectedState(value);
	});
	
	
	
	
	validator = $("#signup").validate({
		errorElement: "em",
		errorPlacement: function(error, element) {
			element.parent().children(".required").show().html("");
			element.removeClass("error");
			error.removeClass("error").appendTo(element.parent().children(".required"));
			
		},
		success: function(label) {
			label.text("");
			if (validator.numberOfInvalids()==0){
				$("#summary").hide();	
			}
		},
		rules: {
			"data[Member][firstname]": {
				required:true,
				minlength:3,
				maxlength:30
			},
			"data[Member][lastname]": {
				required:true,
				minlength:3,
				maxlength:30
			},
			"data[Member][zipcode]": {
				required:true,
				number:true,
				minlength:4,
				maxlength:10
			},
			"data[Member][country_id]": {
				required:true,
				defaultSelected:true
				
			},
			"data[Member][state]":{
				defaultSelectedState:true,
				required:true
			},
			"data[Member][email]":{
				email:true,
				required:true
			},
			"data[Member][confirm_email]":{
				email:true,
				required:true,
				equalTo:"#email"
			},
			"data[Member][password]":{
				required:true,
				minlength:5
			},
			"data[Member][idea_id]":{
				required:true,
				defaultSelected:true
			}
		
		},
		messages:{
			"data[Member][idea_id]":{
				defaultSelected:"Select where you here the idea about us"
			},
			"data[Member][country_id]":{
				defaultSelected:"Select the country where you live"
			},
			"data[Member][state]":{
				defaultSelectedState:"Select the state where you live"
			}
			
		}
	});
}

