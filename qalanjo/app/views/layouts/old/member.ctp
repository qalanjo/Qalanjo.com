<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/profile.css" />
	<?php echo $this->Html->css(array("blueprint/screen"))?>
	<?php 
	//"members/profile/profile",
		echo $this->Html->css(array("redmond/jquery.ui.all","inbox/inbox", "members/search/search", "members/profile/profile","members/profile/edit"));
	?>
	<?php echo $this->Javascript->link(array("jquery", "ui/jquery-ui-1.8.10.custom","ui/autocomplete.html",  'validate/jquery.validate.min', 'custom/member_globals'))?>
	<?php echo $this->element("scripts/autocomplete")?>
<title>Qalanjo.com</title>
</head>
<body>
<div class="container">
	<div id="header" class="span-24 last container">
	    <div id="logo" class="span-8 container">
	    	
			<div id="logo_img" class="span-3">
			<?php 
	    		$image = $this->Html->image("designs/member/profile/qalanjo name and logo.png");
	    		echo $this->Html->link($image, array("controller"=>"members", "action"=>"index"), array("escape"=>false));
	    	?>   
	    	</div>
	    	<div id="name" class="span-5 last">
				<h2>Welcome, <?php echo $member["Member"]["firstname"]?>!</h2>
			</div>
	    </div>
	   <div id="search" class="span-10">
	          	<input type="text" class="search_text"/><button class="search_button"></button>
	   </div> 
	    <div class="span-6 last">
		   	<div id="log-out-button">
			  	<?php
			  		$image = $this->Html->image("designs/member/profile/log-out-button.png");
			  		echo $this->Html->link($image, array("action"=>"logout", "controller"=>"members"), array("escape"=>false));
			  	?>
			</div>
		    <div id="header-nav">
		   		<span class='controls'><?php echo $this->Html->link("My Account", "#")?>&nbsp;|&nbsp;
		   		<?php echo $this->Html->link("My Credits", "#")?>&nbsp;|&nbsp;
		   		<?php echo $this->Html->link("Settings", "#")?>
		   		</span>
		 	</div>
	 	</div>
	</div>
	<div id="middle_wrapper" class="span-24 last">
		<div id="side-nav" class="span-4">
			<?php echo $this->element("members/profile/sidenav")?>
		</div>
		<div id="content-wrap" class="span-20 last"> 
			<div id="updatable_div">
			<?php echo $content_for_layout;?>
			</div>	
		</div>
	</div>

	<?php echo $this->element("members/footer")?>
</div>
</body>
</html>