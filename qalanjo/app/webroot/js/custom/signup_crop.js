/**
 * 
 */

$(document).ready(function(){
	
	$('#cropbox').Jcrop({
		aspectRatio: 1,
		onSelect: updateCoords
	});
});

function checkCoords()
{
	if (parseInt($('#w').val())) return true;
	alert('Please select a crop region then press submit.');
	return false;
}

function updateCoords(c)
{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#width').val(c.w);
	$('#height').val(c.h);
}