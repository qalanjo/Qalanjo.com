<div id="bottom-content" class="span-18">
	<?php echo $this->Session->flash()?>
	<div class="center">
			<?php echo $this->Session->flash()?>
			<?php 
				if ($member["Gender"]["value"] == "Man"){
					echo $this->Html->image("designs/member/silhoutte_boy.png");
				}else{
					echo $this->Html->image("designs/member/silhoutte_girl.png");
				}
			?>
			<div class="uploader">
				<input id="file_upload" name="file_upload" type="file" />
				<p>
					<a href="javascript:$('#file_upload').uploadifyUpload()">Upload Picture</a>
				</p>
			</div>
			<p class="instruction">
				Select an image file on your computer maximum of 4MB : 
				.jpg .png .gif
			</p>
			<p class="note">
				By Uploading a file you certify that you have the right to
distribute this picture and that it does not vilate the <?php echo $this->Html->link("Terms and Service", "#")?>
			</p>
			
		<?php
			$out="<div id=\"buttons\">";
				$out.= $this->Form->submit("Skip");			
	        $out.="</div>"; 
			echo $out;
		?>
	</div>
</div>