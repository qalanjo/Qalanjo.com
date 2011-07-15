<script type="text/javascript">

$(document).ready(function(){
	 $('#doneCropping').val('');

	 $('#submitCrop').click(function() {
		if($('#doneCropping').val() == 'true') {
			$('#formCropper').submit();
		} else {
			alert('Please select portion of the picture to crop');
		}
	 });
	 
	 $('#cropbox').Jcrop({
	  aspectRatio	: 1,
	  onSelect		: updateCoords
	 });
});

	function checkCoords(){
	 if (parseInt($('#w').val())) return true;
		 alert('Please select a crop region then press submit.');
		 return false;
	}

	function updateCoords(c) {
		 $('#x1').val(c.x);
		 $('#y1').val(c.y);
		 $('#width').val(c.w);
		 $('#height').val(c.h);
		 $('#doneCropping').val('true'); // flag.. on select
	}

</script>