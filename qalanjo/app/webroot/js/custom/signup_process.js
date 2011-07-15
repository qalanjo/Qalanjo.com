var country = "";

function swap(selected, target){
	if (selected==1){
		target.val(2);
	}else if (selected==2){
		target.val(1);
	}
}

function signup_validation(){
	$("#signup_form").validate({
		rules:{
			"data[Member][firstname]":{
				required:true,
				minlength:3
			},
			"data[Member][lastname]":{
				required:true,
				minlength:2
			},
			"data[Member][city]":{
				required:true
			},
			"data[Member][state]":{
				required:true
			},
			"data[Member][zipcode]":{
				required:true,
				number:true
			},
			"data[Member][email]":{
				required:true,
				email:true
			},
			"data[Member][confirm_email]":{
				required:true,
				email:true,
				equalTo:"#MemberEmail"
			},
			"data[Member][password]":{
				required:true,
				minlength:6
			},
			"data[Member][confirm_password]":{
				required:true,
				equalTo:"#MemberPassword"
			},
			"data[Member][secret_answer]":{
				required:true
			},
			"data[Member][agree]":{
				required:true
			}
		},
		messages:{
			
		}
		
		
	});
	
	$("#MemberGenderId").change(function(){
		selected = $(this).val();
		swap(selected, $("#MemberLookingForId"));
	});
	$("#MemberLookingForId").change(function(){
		selected = $(this).val();
		swap(selected, $("#MemberGenderId"));
	});
	
	 /**
	  *  Last Name default value
	
	$("#lastname").each(function() { //onblur
		$(this)
		.data('default', $(this).val())
		.addClass('inactive')
		.focus(function() {
			$(this).removeClass('inactive');
			if ($(this).val() == $(this).data('default') || '') {
				$(this).val('');
			}
			
		})
		.blur(function() {
			var default_val = $(this).data('default');
			if ($(this).val() == '') {
			$(this).addClass('inactive');
			$(this).val($(this).data('default'));
			}
		});
	});
	*
	*/

}