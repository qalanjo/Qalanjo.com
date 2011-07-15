<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/profile.css" />
	<?php echo $this->Html->css(array("blueprint/screen"))?>
	<?php 
	//"members/profile/profile",
		echo $this->Html->css(array("redmond/jquery.ui.all","inbox/inbox", "members/profile/profile"));
	?>
	<?php echo $this->Javascript->link(array("jquery", "ui/jquery-ui-1.8.10.custom","ui/autocomplete.html",  'validate/jquery.validate.min', 'custom/member_globals'))?>
	<?php echo $this->element("scripts/autocomplete")?>
<title>Qalanjo.com</title>
</head>


<body>

<div class="container ui-widget">

	<div id="header" class="span-24 last">
	
	    <div id="logo-wrapper" class="span-8">
			<div id="logo" class="span-4">
			<?php 
	    		$image = $this->Html->image("designs/member/profile/qalanjo name and logo.png");
	    		echo $this->Html->link($image, array("controller"=>"members", "action"=>"index"), array("escape"=>false));
	    	?>   
	    	</div>
	    	<div id="name" class="span-3">
				<h2>Welcome, <?php echo $member["Member"]["firstname"]?>!</h2>
			</div>
	    </div>
	 
	   <div id="search" class="span-9">
	          	<input type="text" class="search_text"/><button class="search_button"></button>
	   </div>
	  
	    <div id="log-out-wrapperclass" class="span-3 rfloat">
		   	<div id="log-out-button" >
			  	<?php
			  		$image = $this->Html->image("designs/member/profile/log-out-button.png");
			  		echo $this->Html->link($image, array("action"=>"logout", "controller"=>"members"), array("escape"=>false));
			  	?>
			</div> 
	 	</div>
	</div>
	
	<div id="photo-wrapper" class="span-5 prepend-top">
		<?php echo $this->Html->image("designs/member/silhoutte_girl.png")?>
	</div>
	
	<div id="top-bar" class="span-18 prepend-top">
		<div id="status-bar-wrapper" class="prepend-1 span-18">
			<div id="status-bar" class="span-18 center">
				<?php 
					echo $this->element("members/status", array("member"=>$member)); 
				?>
			</div>
		</div>
		<br class="clearfloat" />
		<div class="edit span-2 calign rfloat ui-corner-bottom"><?php echo $this->Ajax->link("Edit", "/members/update/field:status", array("update"=>"status-content", "class"=>"edit_control"))?></div>
	</div>
	
	<div id="main-wrapper" class="span-24 last ui-corner-all prepend-top container">
	
		<div id="left-side-bar" class="span-4">
			<div id="side-nav" class="span-4">
			<?php echo $this->element("members/profile/sidenav")?>
			</div>
		</div>
		
		<div id="content" class="span-20 last">
			<div id="updatable_div" class="span-20 ui-corner-all">
				<?php echo $content_for_layout;?>
			</div>	
		</div>
		
	</div>
	<!-- footer -->
	<?php echo $this->element("members/footer")?>

	
</div>
</body>
</html>