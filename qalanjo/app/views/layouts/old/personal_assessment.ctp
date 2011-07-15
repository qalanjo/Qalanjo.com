<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Qalanjo.com</title>
		<?php echo $this->Html->css("blueprint/screen")?>
		<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
		<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
		<?php echo $this->Html->css(array("redmond/jquery.ui.all", "blue/container-no-tab", "blue/personality"))?>
		<?php 
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
		<?php echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "js/jquery.easing.1.3", "ui/jquery-ui-1.8.10.custom",'validate/jquery.validate.min', "ui/autocomplete.html"))?>
		
		<?php 
			if (($this->action=="questionnaire")&&($this->name=="Attributes")){		
				$pathGeneral = "designs/blue/attributes/general/";		
				echo $this->Html->css("blue/questionnaire/page".$page);
				echo $this->Javascript->link("blue/attributes/questionnaire");
			}else if (($this->action=="profile_completion")){
				$pathGeneral = "designs/blue/attributes/general/";	
				echo $this->Html->css("blue/profile_building/pcompletionp".$page);
				echo $this->Javascript->link("blue/members/profile_completion");
				
			}else if ($this->action=="signup_upload"){
				echo $this->Html->css("blue/picture_profile");
				echo $this->Javascript->link("uploader/swfobject");
				echo $this->Html->css("uploadify.css");
				echo $this->Html->css("members/completion/signup_upload.css");	
				echo $this->Javascript->link("uploader/jquery.uploadify.v2.1.4.min");
				echo $this->element("scripts/signup_upload", array("member_id"=>$member_id, "progress"=>$progress));				
			}else if ($this->action=="signup_upload_crop"){
				echo $this->Html->css("blue/picture_profile");
				echo $this->Javascript->link("jcrop/jquery.Jcrop.min");
				echo $this->Javascript->link("custom/signup_crop");
			}else if ($this->action=="signup_congrats"){
				echo $this->Javascript->link("blue/members/congrats");
			}
				$pathGeneral = "designs/blue/attributes/general/";	
		?>
	</head>
	<body>
		<div class="container">
			<div class="header">
			
			</div>
			<div class="homebox">
				<div class="content-container">
					<div class="left" id="banner">
						<div class="left" id="logo">
							<?php 
								echo $this->Html->image($pathGeneral."logo_big.png");
							?>
						</div>
						<div class="left" id="label">
							<h1>
							<?php 
								echo $set;
							?>
							
							</h1>
						</div>
					</div>
					<div class="left" id="content_box">
						<div class="left" id="content">
							<?php 
								echo $content_for_layout;
							?>							
						</div>
						
					</div>
					<div class="left" id="sidebar">
							<div class="left clear">
								
							</div>
							<div class="left"  id="loading">
								
							</div>
							<div class="left clear">
								<p class="teaser">Take your time but try not to over analyze as you can edit these information later.</p>
							</div>
						</div>
				</div>
			</div>
			<?php echo $this->element("blue/general/footer")?>
		</div>
	</body>
</html>
