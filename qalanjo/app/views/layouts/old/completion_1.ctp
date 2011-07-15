<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Qalanjo.com</title>
	<?php echo $this->Html->css("members/completion/style")?>
	<?php echo $this->Html->css("globals/core")?>
	<?php echo $this->Html->css("redmond/jquery.ui.core")?>
	<?php echo $this->Html->css("redmond/jquery.ui.theme")?>
	<?php echo $this->Html->css("redmond/jquery.ui.all")?>
	<?php echo $this->Javascript->link(array("jquery", "ui/jquery-ui-1.8.10.custom", "validate/jquery.validate.min"))?>
	<?php 
		if (isset($signup_process)){
			echo $this->Javascript->link("custom/signup_process");
			echo $this->Html->css("members/completion/signup");
		}else if (isset($profile_completion)){
			echo $this->Javascript->link("custom/profile_completion".$page);
			echo $this->Html->css("members/completion/profile_completion");
		}else if ($this->action=="signup_upload"){
			echo $this->Javascript->link("uploader/swfobject");
			echo $this->Html->css("uploadify.css");
			echo $this->Html->css("members/completion/signup_upload.css");	
			echo $this->Javascript->link("uploader/jquery.uploadify.v2.1.4.min");
			echo $this->element("scripts/signup_upload", array("member_id"=>$member_id, "progress"=>$progress));				
		}else if ($this->action=="signup_upload_crop"){
			echo $this->Javascript->link("jcrop/jquery.Jcrop.min");
			echo $this->Html->css("jquery.Jcrop");
			echo $this->Javascript->link("custom/signup_crop");
		}else if ($this->action=="questionnaire"){
			echo $this->Html->css("attributes/questionnaire.css");
		}else if ($this->action=="signup_congrats"){
			echo $this->Html->css("members/completion/congrats");
		}
	
	?>
	<?php if (!isset($action)){?>
		<script type="text/javascript">
			$(document).ready(function(){
				var options = {
						value:<?php 
						if (isset($progress)){
							echo $progress;
						}else {
							echo 0;
							
						}?>
				};

				<?php 
					if (isset($signup_process)){
				?>
					signup_validation();
				<?php 
					}
				?>
				$("#progress").progressbar(options);
				
			});
		</script>
	<?php }?>
</head>

<body>
<div id="main-wrap">
  <div id="header">
  </div>
  <div id="banner">
	  <?php echo $this->Html->image("designs/member/completion/banner1.jpg")?>    
  </div>
  <div id="title-wrap">
    <div id="title">
      <p>About Me</p>
      </div>
      <div id="status-bar">
       
      	<div id="progress">
							
		</div>
		<span class="progress">
        <?php 
		if (isset($progress)){
			echo $progress;
		}else {
			echo 0;
			
		}?>%
        </span>
      </div>  
  </div>
   <div id="content-wrap">
  	  <?php echo $content_for_layout;?>
  </div>
  <?php echo $this->element("footer")?>
</div>

</body>
</html>