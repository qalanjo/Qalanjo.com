<?php 

/*
 * 	element which contains brief info about the user including profile picture..
 *  at the left nav.. 
 */

?>


<div class="details-container"> 
	<div class="profile-image-container"> 
		<a href="#">
			<?php echo $this->Html->image('photos/content-default-woman.jpg')?>
		</a> 
	</div> 
	<div class="profile-details"> 
		<div class="user-firstname"> 
			<span><?php echo $profileInfo['Member']['firstname']?></span> 
		</div> 
		<div class="user-address"> 
			<span><?php echo $profileInfo['Member']['address1']?></span> 
		</div> 
	</div> 
	<div class="profile-controls"> 
		<a href="#">Inbox</a> |
		<a href="#">Edit Profile</a> 
	</div> 
	<div class="profile-progress"> 
		<div class="profile-progress-label"> 
			Profile is <span id="profile-progress-percent">22%</span> complete
		</div> 
		<div class="profile-progress-container"> 
			<div class="profile-progress-bar"> 
			</div> 
			<div class="profile-progress-divider"> 
			</div> 
		</div> 
	</div> 
</div> 