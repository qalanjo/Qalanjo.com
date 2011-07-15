<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Qalanjo.com - Your Road to Love</title>
        <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
        <!--[if IE]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
        <link rel="stylesheet" href="css/home.css" type="text/css" media="screen" charset="utf-8" />
		<?php echo $this->Html->css("blueprint/screen")?>
		<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
		<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
		<?php echo $this->Html->css("blue/home")?>
		<?php 
			echo $this->Html->scriptBlock("
				var action='{$this->action}';
			");
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
		<?php echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "validate/jquery.validate.min", "js/jquery.form", "js/jquery.easing.1.3", "home_new/script"))?>

    </head>
    <body>
        <div class="container">
            <div class="shadow left">
            </div>
            <div class="container-main left">
               <?php echo $content_for_layout;?>
				<hr/>
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
				<div class="gradient-bottom left">
				</div>
            </div>
            <div class="shadow shadow-last left">
            </div>
        </div>
        <div id="result"></div>
    </body>
</html>
