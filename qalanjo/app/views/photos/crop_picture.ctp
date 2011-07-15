<?php 

	echo $this->Javascript->link('jcrop/jquery.Jcrop');
	echo $this->element('photos/profile_jcrop');
	echo $this->Html->css('jquery.Jcrop');
	
	echo $this->Form->create("Photo", array("url"=>"/photos/makeProfilePicture/". $photo['Photo']['id'], 'id'=>'formCropper'));
	echo $this->Form->input("Photo.x1", array("type"=>"hidden", "id"=>"x1"));
	echo $this->Form->input("Photo.y1", array("type"=>"hidden", "id"=>"y1"));
	echo $this->Form->input("Photo.width", array("type"=>"hidden", "id"=>"width"));
	echo $this->Form->input("Photo.height", array("type"=>"hidden", "id"=>"height"));
?>

	<div id="jcrop-wrapper">
		<?php 
			echo $this->Html->image('uploads/' . $member_id . '/' . $albumName . '/' . $photo['Photo']['picture_path'],
						array('id'=>'cropbox'));
						
		?>
	</div>

	<input type="button" id="submitCrop" value="Done Cropping"/>
	<input type="hidden" id="doneCropping" value="" />