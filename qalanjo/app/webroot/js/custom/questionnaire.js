/**
 * Questionnaire
 */

$(document).ready(function(){
	$(".row:even").addClass("highlight");
  var $radios = $('input:radio');
  
  if($radios.is(':checked') === true) {
        $radios.attr('checked', false);
    }
});
