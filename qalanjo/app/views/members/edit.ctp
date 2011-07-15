<?php 
	$this->Html->css("blue/edit-profile-style", "stylesheet", array('inline'=>false));
	$this->Javascript->link("blue/members/edit-profile-script", false);
?>
<div class="content-container">
	<div class="profile-wizard-header">
		<h1>My Profile</h1>
		<div class="profile-wizard-progress">
			<div class="progress-bar-container">
				<em class="progress-bar-background">
					<em class="progress-bar">
					</em>
				</em>
			</div>
			<span class="progress-label">22% Complete</span>
		</div>
		<div class="profile-upload-photo-tab">
			<div class="profile-upload-photo-image">
			</div>
		</div>
	</div>
	<div class="profile-view-tabs">
		<ul>
			<li class="active">
				<a>
					<span class="tab-left"></span>
					<span>Complete My Profile</span>
					<span class="tab-right"></span>
				</a>
			</li>
			<li>
				<?php 
					echo $this->Html->link("
						<span class=\"tab-left\"></span>
						<span>View My Profile</span>
						<span class=\"tab-right\"></span>
					
					", "/members/profile/".$member_id, array("escape"=>false));
				
				?>
			</li>
		</ul>
		<div class="bottom-line">
		</div>
	</div>
	<div class="profile-wizard">
		<ul class="wizard-nav">
			<li class="selected complete">
				<?php echo $this->Html->link("<span>Basic</span>", "/members/edit/sk:basic", array("escape"=>false, "class"=>"button"))?>
				
			</li>
			<li class="has-sub-nav incomplete">
				<div class="button">
					<span>In My Own Words</span>
				</div>
				<ul class="wizard-sub-nav">
				
				
					<li>
						<?php echo $this->Html->link("<span>Page 1</span>", "/members/edit/sk:words/page:1", array("escape"=>false))?>
					</li>
					<li>
						<?php echo $this->Html->link("<span>Page 2</span>", "/members/edit/sk:words/page:2", array("escape"=>false))?>
					</li>
				</ul>
			</li>

			<li class="twoline has-sub-nav incomplete">
				<div class="button">
					<span>Something to <br />Talk About</span>
				</div>
				<ul class="wizard-sub-nav">
					<li>
						<?php echo $this->Html->link("<span>Music</span>", "/members/edit/sk:music", array("escape"=>false))?>
					</li>
					<li>
						<?php echo $this->Html->link("<span>Pets</span>", "/members/edit/sk:pets", array("escape"=>false))?>
					</li>
					<li>
						<?php echo $this->Html->link("<span>Books</span>", "/members/edit/sk:books", array("escape"=>false))?>
					</li>
					<li>
						<?php echo $this->Html->link("<span>Movies</span>", "/members/edit/sk:movies", array("escape"=>false))?>
					
					</li>
					<?php /*?>
					<li>
						<?php echo $this->Html->link("<span>Travel</span>", "/members/edit/sk:movies", array("escape"=>false))?>
					</li>
					*/?>
					<li>
						<?php echo $this->Html->link("<span>Leisure</span>", "/members/edit/sk:leisure", array("escape"=>false))?>
					</li>
				</ul>
			</li>
			<?php /*?>
			<li class="incomplete">
				<div class="button">
					<span>Values</span>
				</div>
				<ul class="wizard-sub-nav">
					<li>
						<a href="edit-profile-values-must-haves.html"><span>Must Haves</span></a>
					</li>
					<li>
						<a href="edit-profile-values-cant-stands.htm"><span>Can't Stands</span></a>
					</li>
				</ul>
			</li>
			*/?>
			<li class="incomplete">
				<?php 
					echo $this->Html->link("<span>My Photos</span>", "/photos", array("class"=>"button", "escape"=>false));
				?>
			</li>
		</ul>
		<div id="wizard-content" class="wizard-content">
		</div>
	</div>
</div>