/**
 * Script for Questionnaire
 */
$(document).ready(function(){
	$("div.slider").slider({
		min:1,
		max:5,
		animate:true,
		value:3,
		change:function(event, ui){
			var slider = $(this).attr("id");
			var temps = slider.split("_");		
			var value = ui.value;
			if (value==1){
				$("#weight"+temps[1]).val(5);
			}else if (value==2){
				$("#weight"+temps[1]).val(4);
			}else if (value==3){
				$("#weight"+temps[1]).val(3);
			}else if (value==4){
				$("#weight"+temps[1]).val(2);
			}else if (value==5){
				$("#weight"+temps[1]).val(1);
			}
		}
	});
	$(".weights").val(3);
});