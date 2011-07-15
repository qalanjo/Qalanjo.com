 

<?php
	echo $this->Javascript->link('simplemodal');
	echo $this->Form->create('Photo', 
				array('type'=>'file','url'=>'/photos/upload/')); 
				

echo $form->input('Album.member_id', array('type'=>'hidden', 'value'=>$member_id));
echo '<label> select album </label>';
echo '<select name="data[Album][id]" id="album">';
echo '<option value="" id="new"> -- New Album -- </option>';
	foreach($albums as $album) {
			echo "<option value='" . $album['Album']['id'] .  "'>" . $album['Album']['name'] . "</option>";
		}
echo "</select>";
?>
	<input type='button' id='upload' value='Upload Picture' />
	<input type='button' id='clearQueue' value='Clear Queue' />
	
	
	<div class="uploader">
		<input id="file_upload" name="file_upload" type="file" />
	</div>
	
	<div id="dialog-box">
		<span id="dialog-text"> </span>
		<input type="text" id="answer" />
		<span id="warning"> album name cant be empty </span>	
	</div>
	<div id="cancelled_images">
	
	</div>
<?php echo $form->end(); ?>



