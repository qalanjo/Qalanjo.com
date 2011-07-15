$(document).ready(function() {
	interval = setInterval("updateStatus()", 1000, "javaScript");
	var firstSelected = $('ul.wizard-nav > li.selected > a');
	var url = firstSelected.attr('href');
	$(".profile-upload-photo-image").click(function(){
		window.location.href = qalanjo_url+"photos";
	});
	$('.wizard-content').load(url);
	$('.progress-bar').css({
		'width': '0%'
	}).animate(
		{
			'width': '22%'
		},
		{
			duration: 1000,
			easing: 'swing'
		}
	);
	
	$(".no-check").live("click", function(e){
		$(".control-check").attr("checked", false); 
	});
	$(".control-check").live("click", function(e){
		if ($(".no-check").is(":checked")){
			e.preventDefault();
		}
	}); 
	
	
	/**
	 * Text area like twitter
	 */
	
	$(".answer-box").live("keydown", function(e){
		countLetters($(this), e);
	}).live("keypress", function(e){
		countLetters($(this), e);
	}).live("keyup", function(e){
		countLetters($(this), e);
	}).live("blur", function(e){
		countLetters($(this), e);
	}).live("focus", function(e){
		countLetters($(this), e);
	});
	
	/**
	 * Navigation
	 */
	$('.wizard-sub-nav').each(function() {
		$(this).hide();
	});
	$('.wizard-sub-nav li a').click(function(e) {
		var clickedButton = $(this);
		
		if (!clickedButton.parent().hasClass('selected')) {
			var selectedButton = $('.wizard-sub-nav li.selected a');
		
			var url = clickedButton.attr('href');
			$('.wizard-content').load(url);
			
			clickedButton.parent().addClass('selected');
			selectedButton.parent().removeClass('selected');
		}
		
		e.preventDefault();
	});
	$('.wizard-nav .button').click(function(e) {
		var clickedButton = $(this);
		
		if (!clickedButton.parent().hasClass('selected')) {
		
			var linkSelected = $('.wizard-sub-nav li.selected a');
			linkSelected.parent().removeClass('selected');
			
			var selectedButton = $('.wizard-nav li.selected .button');
			var clickedButtonULSibling = clickedButton.siblings('.wizard-sub-nav');
			if (clickedButtonULSibling.length > 0) {
				clickedButtonULSibling.slideDown();
				var link = clickedButtonULSibling.find('a:first');
				link.parent().addClass('selected');
				var url = link.attr('href');
				$('.wizard-content').load(url);
				
			}
			else {
				var url = clickedButton.attr('href');
				if (url==qalanjo_url+"photos"){
					window.location.href = url;
				}else{
					$('.wizard-content').load(url);
				}				
			}
			
			var selectedButtonULSibling = selectedButton.siblings('.wizard-sub-nav');
			if (selectedButtonULSibling.length > 0) {
				selectedButtonULSibling.slideUp();
			}
			else {
			
			}
			
			selectedButton.parent().removeClass('selected');
			clickedButton.parent().addClass('selected');
		}
		
		e.preventDefault();
	});
});


function countLetters(object, e){
	var count = object.val().length;
	if (count>=650){
		e.preventDefault();
	}
	object.parent().children(".countdown-status").text((650-count)+" characters remaining.");
}
