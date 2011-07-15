<?php 


echo '<div id="photos-options">';

	if($defaultAlbum) { //if on the default album..
		
		//change the id of the div to set the profile picture without cropping
		// because photos on the default album are already cropped
		$div_id = 'change_profile'; 
		
	} else { //if not on the default album..
		
		//id used to add event listener which will redirect on crop_picture page..
		$div_id = 'make_profile'; 
	}

	echo '<div id="'. $div_id .'">';
		echo '<a href="" > Set as Profile Picture </a>';
	echo '</div>';
	
	echo '<div id="deletePhoto">';
		echo '<a href="" > Delete Photo </a>';
	echo '</div>';
	
echo '</div>';


