<div class="left" id="content_header">
		<h2>Profile Picture</h2>
	</div>
	<div class="left" id="content_main">
		<div class="left" id="picture_profile_box">
			<h2>My Profile Picture</h2>
			<p class="blue">
				Want to increase your chance of success? Upload multiple photos.
			</p>
			<p>
				<?php 
					if ($member["Gender"]["value"] == "Man"){
						echo $this->Html->image("designs/member/silhoutte_boy.png");
					}else{
						echo $this->Html->image("designs/member/silhoutte_girl.png");
					}
				?>
			</p>
			<div class="uploader">
				<input id="file_upload" name="file_upload" type="file" />
				<p>
					<a href="javascript:$('#file_upload').uploadifyUpload()">Upload Picture</a>
				</p>
			</div>
			
			<p class="details">
				Photo must be a .gif, .jpg, .png or .bmp format, no longer then 5MB.
			</p>
			<p>
				By Uploading a file you certify that you have the right to distribute this picture<br /> and that it does not vilate the Terms and Service.
           	</p>
         </div>
        </div>