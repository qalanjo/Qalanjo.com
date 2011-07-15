var intval = "";
var state = 0;
var signupState = 0;

$(document).ready(function () {
	init();
	
	if($(window).height() < 636 || $(window).width() < 900) {
		signupState = 2;
		setupSignupLayout2();
	} else {
		signupState = 1;
		setupSignupLayout1();
	}
	
	startSlideShow();
	$(window).resize(function() {
		if($(window).height() < 636 || $(window).width() < 900) {
			if(signupState != 2) {
				signupState = 2;
				if (state == 0) {
					$('#signup').fadeOut(100, function(){
						setupSignupLayout2();
						$('#signup').fadeIn(100);
					});
				}
			}
		} else {
			if(signupState != 1) {
				signupState = 1;
				if (state == 0) {
					$('#signup').fadeOut(100, function(){
						setupSignupLayout1();
						$('#signup').fadeIn(100);
					});
				}
			}
		}
		if (state == 0) {
			window.clearInterval(intval);
			intval = window.setInterval("onInterval()", 5000);
		}
	});
});

function setupSignupLayout1() {
	var signup_form = $('.signup_form_min');
	signup_form.addClass('signup_form');
	signup_form.removeClass('signup_form_min');
	signup_form.css({
		top: '446px'
	});
	
	var image_wrapper = $('.slideshow_min div.image_wrapper_min');
	image_wrapper.addClass('image_wrapper');
	image_wrapper.removeClass('image_wrapper_min');
	
	var slideshow = $('.slideshow_min');
	slideshow.addClass('slideshow');
	slideshow.removeClass('slideshow_min');
	
	$('.slideshow div').each(function() {
		$(this).css({
			left: '100%'
		});
	});
	$('.slideshow div.active').css({
		left: '35%'
	});
}

function setupSignupLayout2() {
	var signup_form = $('.signup_form');
	signup_form.addClass('signup_form_min');
	signup_form.removeClass('signup_form');
	signup_form.css({
		top: '136px'
	});
	
	var image_wrapper = $('.slideshow div.image_wrapper');
	image_wrapper.addClass('image_wrapper_min');
	image_wrapper.removeClass('image_wrapper');
	
	var slideshow = $('.slideshow');
	slideshow.addClass('slideshow_min');
	slideshow.removeClass('slideshow');
}

function init () {
	/* Signup and Login page */
	$('#login').hide();
	$('#login_form').css({
		top: '136px'
	});
	$('#show_signup_login_page_toggle_button').html('<p>Login</p>');
	$('#show_signup_login_page_toggle_button').live('click', toggleSignupLoginPage);
	
	/* Reasons page */
	$('#show_signup_page_button').html('<p>Home</p>');
	$('#reasons_header').hide();
	$('#reasons').hide();
}

function startSlideShow(){
	if (signupState == 1) {
		$('.slideshow div').each(function(){
			$(this).css({
				left: '100%'
			});
		});
		active = $('.slideshow div.active');
		first = $('.slideshow div:first');
		active.removeClass('active');
		first.addClass('active');
		$('.slideshow div.active').css({
			left: '35%'
		});
	} else if (signupState == 2) {
		
	}
	intval = window.setInterval("onInterval()", 5000);
}

function stopSlideShow() {
	window.clearInterval(intval);
}

function onInterval() {
	if(signupState == 1) {
		doSlideShowForLayout1();
	} else if (signupState == 2) {
		doSlideShowForLayout2();
	}
}

function doSlideShowForLayout1() {
	var active = $('.slideshow div.active');
	var next = active.next().length ? active.next() : $('.slideshow div:first');
	
	next.addClass('active');
	active.removeClass('active');
	
	active.delay(110).animate(
		{
			left: -400
		},
		{
			duration: 2000,
			easing: 'easeOutElastic',
			complete: function() {
				active.css({
					left: '100%'
				});
			}
		}
	);
	next.animate(
		{
			left: '35%'
		},
		{
			duration: 2000,
			easing: 'easeOutElastic'
		}
	);
}

function doSlideShowForLayout2() {
	var active = $('.slideshow_min div.active');
	if (active.length == 0) {
		active = $('.slideshow_min div:last')
	}
	var next = active.next().length ? active.next() : $('.slideshow_min div:first');
	
	active.addClass('last-active');
	active.removeClass('active');
	
	next.css({opacity: 0.0})
		.addClass('active')
		.animate(
			{
				opacity: 1.0
			}, 
			{	
				duration: 1000, 
				complete: function(){
					active.removeClass('last-active');
				}
			}
		);
}

function toggleSignupLoginPage(){
	if (state == 0) {
		showLoginPage();
	}
	else if (state == 1) {
		showSignupPage();
	}
}

function showLoginPage() {
	stopSlideShow();
	state = -1;
	$('#show_signup_login_page_toggle_button').html('<p>Signup</p>');		
	$('#signup').stop(true).fadeOut(500, 'swing');
	var xOffset = ($(document).height() / 2) - 108;
	$('#header').animate(
		{
			top: xOffset
		},
		{
			duration: 1500,
			easing: 'easeInOutElastic'
		}
	);
	$('#login_form').animate(
		{
			top: xOffset + 111
		},
		{
			duration: 1500,
			easing: 'easeInOutElastic'
		}
	);
	$('#footer').delay(850).animate(
		{
			bottom: '-100px'
		},
		{
			duration: 1500,
			easing: 'easeOutElastic',
			complete: function() {
				state = 1;
			}
		}
	);
	$('#login').delay(200).fadeIn(500, 'swing');
}

function showSignupPage() {
	if ($(window).height() < 636 || $(window).width() < 900) {
		setupSignupLayout2();
	} else {
		setupSignupLayout1();
	}
	startSlideShow();
	$('#show_signup_login_page_toggle_button').html('<p>Login</p>');
	state = -1;	
	$('#footer').stop(true).animate(
		{
			bottom: '0px'
		},
		{
			duration: 1250,
			easing: 'easeOutElastic'
		}
	);
	$('#header').delay(105).animate(
		{
			top: '25px'
		},
		{
			duration: 1500,
			easing: 'easeOutElastic',
			complete: function() {
				state = 0;
			}
		}
	);
	$('#login_form').delay(105).animate(
		{
			top: '136px'
		},
		{
			duration: 1500,
			easing: 'easeOutElastic'
		}
	);
	$('#login').delay(400).fadeOut(500, 'swing');
	$('#signup').delay(400).fadeIn(500, 'swing');
}

function slideDownToReasonsPage() {
	if (state == 0) {
		state = -1;
		stopSlideShow();
		$('#reasons').stop().show();
		$('#footer .footer_links').fadeOut(800, 'easeOutBack')
		$('.signup_form').animate({
			top: $('#container').height() - 100 - 69
		}, {
			duration: 800,
			easing: 'easeOutBack'
		});
		$('#container').animate({
			height: $('#container').height(),
			marginTop: 190 - $('#container').height()
		}, {
			duration: 800,
			easing: 'easeOutBack',
			complete: function(){
				$('#reasons_header').fadeIn(1000, function() {
					state = 2;
				});
				$('#show_reasons_page_button #lip').fadeOut(1000);
			}
		});
	}
}

function slideUpToSignupPage () {
	if ($(window).height() < 636 || $(window).width() < 900) {
		setupSignupLayout2();
	} else {
		setupSignupLayout1();
	}
	if (state == 2) {
		state = -1;
		startSlideShow();
		$('html').stop().scrollTo(0, 800);
		
		$('#show_reasons_page_button #lip').fadeIn(250);
		$('#reasons_header').fadeOut(250, function(){
			$('#container').animate({
				height: '100%',
				marginTop: '0'
			}, {
				duration: 800,
				easing: 'easeOutBack',
				complete: function(){
					$('#reasons').hide(0, function() {
						state = 0;
					});
				}
			});
			$('.signup_form').animate({
				top: 446
			}, {
				duration: 800,
				easing: 'easeOutBack'
			});
			$('#footer .footer_links').fadeIn(800, 'easeOutBack')
		});
	}
}


