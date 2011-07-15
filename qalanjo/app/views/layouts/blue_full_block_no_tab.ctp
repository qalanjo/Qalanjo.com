<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Qalanjo.com</title>
		
		<?php echo $this->Html->css("globals/core")?>
		<?php echo $this->Html->css("blueprint/screen")?>
		<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
		<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
		<?php echo $this->Html->css(array("redmond/jquery.ui.all", "blue/container-no-tab", "toastmessage/css/jquery.toastmessage"))?>
		<script type="text/javascript" src="js/jquery-1.4.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="js/jquery-animate-clip.js" charset="utf-8"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js" charset="utf-8"></script>
		<script type="text/javascript" src="js/ui/jquery-ui-1.8.10.custom.js" charset="utf-8"></script>
		<?php 
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
		<?php 
			echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "js/jquery.easing.1.3", "ui/jquery-ui-1.8.10.custom",'validate/jquery.validate.min', "ui/autocomplete.html", "js/jquery.toastmessage.js", "js/jquery.form"));
		?>
		<script type="text/javascript" src="js/script.js"></script>
		<?php 
			echo $scripts_for_layout;
			$path_container = "/css/img/blue/container/";
		?>
	</head>
    <body>
    	<div class="header-bg"></div>
		<div class="container">
			<div class="header left">
				<div class="logo left"></div>
				<div class="right-header left">
					<div class="controls-right right">
						<div class="right">
							<?php 
								echo $this->Html->image($path_container."facebook_s1.png", array("class"=>"left", "url"=>"http://www.facebook.com/pages/Qalanjo/183622908342331"));
								echo $this->Html->image($path_container."rss_s1.png", array("class"=>"left"));
								echo $this->Html->image($path_container."twitter_s1.png", array("class"=>"left"));			
							?>
						</div>
						<div class="right right-header-content clear">
							<?php echo $this->Html->link("<strong>Login</strong>", "/members/login", array("escape"=>false))?>
						</div>
					</div>
					
				</div>
			</div>
			<div class="tab-line left"></div>
			<div class="homebox">
				<?php echo $content_for_layout?>
			</div>
			<div class="footer left">
				<div class="left footer-left">
                        <div class="left">
                           <h2 class='qalanjo'>Qalanjo LLC</h2>
                           <div class="name-company">Copyright &copy; Qalanjo LLC. All Rights Reserved 2011</div>
 	  	                   <div class="find-us"><span class="left">Find Us on</span><?php echo $this->Html->link(" ", "http://www.facebook.com/pages/Qalanjo/183622908342331", array("class"=>"fb left clear"))?><?php echo $this->Html->link(" ", "#", array("class"=>"twitter left"))?><?php echo $this->Html->link(" ", "#", array("class"=>"rss left"))?></div>
                        </div>
                    </div>
				 <?php echo $this->element("blue/general/footer_link_set_2")?>
				
			</div>
			<div class="left gradient-bottom"></div>
		</div>
    </body>
</html>
