<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Qalanjo.com</title>
		
		<?php echo $html->charset(); ?>
		<?php echo $this->Html->css("globals/core")?>
		<?php echo $this->Html->css("blueprint/screen")?>
		<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
		<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
		<?php echo $this->Html->css(array("redmond/jquery.ui.all", "blue/container-style"))?>
		<?php echo $this->Html->css("aboutus/styles") ?>
		<?php 
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
		<?php echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "js/jquery.easing.1.3", "ui/jquery-ui-1.8.10.custom",'validate/jquery.validate.min', "ui/autocomplete.html", "aboutus/script"))?>
		<?php 
			if (($this->action=="display")&&($this->name=="Pages")){
				echo $this->Html->css("blue/about_us");
				$path = "designs/blue/members/general/";
				
			}
		?>
	</head>
	<body>
		<div class="container">
			<?php
				/*
				 * Header for Member
				 * @version 0.0.1
				 * @date 5/21/2011
				 */	
				$path = "designs/blue/members/general/";
			?>
			<div class="header">
				<h2>
					<?php 
						echo $this->Html->image($path."logo.png", array("url"=>"/", "alt"=>"Qalanjo"));		
					?>
				</h2>
			</div>
			<div class="homebox">
				<div class="content-container">
					<div class="aboutus-container-header">
					</div>
					<div class="main-menu-container">
						<ul class="main-menu">
							<li id="about" class="selected">
								<?php echo $html->link('About us', '', array('class'=>'about', 'escape'=>false)) ?>
							</li>
							<li id="contact">
								<?php echo $html->link('Contact us', '/contactus', array('class'=>'contact', 'escape'=>false)) ?>
							</li>
						</ul>
					</div>
					<div class="sub-menu-container">
						<ul class="sub-menu">
							<div class="about">
								<li class="selected">
									<?php echo $html->link('About Qalanjo.com', '/aboutus', array('class'=>'about-qalanjo-dot-com', 'escape'=>false)) ?>
								</li>
								<li>
									<?php echo $html->link('Why Qalanjo', '/why', array('class'=>'why-qalanjo', 'escape'=>false)) ?>
								</li>
								<li>
									<?php echo $html->link('Services', '/services', array('class'=>'services', 'escape'=>false)) ?>
								</li>
								<li>
									<?php echo $html->link('Management Team', '/team', array('class'=>'management-team', 'escape'=>false)) ?>
								</li>
								<li>
									<?php echo $html->link('Affiliates', '/affiliates', array('class'=>'affiliates', 'escape'=>false)) ?>
								</li>
							</div>
						</ul>
					</div>
					<div class="updatable-container">
						<?php echo $content_for_layout; ?>
					</div>
				</div>		
			</div>
			<?php echo $this->element("blue/general/footer")?>
		</div>
	</body>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-23493927-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</html>
			