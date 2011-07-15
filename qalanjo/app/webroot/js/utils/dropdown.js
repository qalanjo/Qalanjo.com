/**
 * Drop Down
 */

function drop_down(){
	$('#nav li').hover(
        function () {
            $('ul', this).slideDown({
            	duration:500,
            	easing:"easeOutExpo"
            });
            $(this).toggleClass("linkHover");
        }, 
        function () {
            $('ul', this).slideUp({
                    	duration:500,
                    	easing:"easeOutExpo"
               }
            );         

            $(this).toggleClass("linkHover");
        }
    );
}