<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<title>Qalanjo.com</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php echo $this->Html->css("globals/core")?>
		<?php echo $this->Html->css("blueprint/screen")?>
		<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
		<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
		<?php echo $this->Html->css("blue/aboutus") ?>
		<?php 
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
		<?php echo $this->Javascript->link(array("jquery", "blue/aboutus"))?>
		
    </head>
    <body>
        <div class="container">
            <div class="shadow left">
            </div>
            <div class="container-main left">
               	<div class="header left">
               		<div class="logo left"></div>
               		<div class="couple-top left"></div>
               		<div class="right icon-set-button">
               			<?php 
               				echo $this->Html->image("/css/img/blue/aboutus/rss.png", array("class"=>"right"));
               				echo $this->Html->image("/css/img/blue/aboutus/twitter.png", array("class"=>"right"));
               				echo $this->Html->image("/css/img/blue/aboutus/facebook.png", array("class"=>"right", "url"=>"http://www.facebook.com/pages/Qalanjo/183622908342331"));
               			?>
               			<?php echo $this->Html->link(" ", "/", array("class"=>"find-my-match right clear"))?>
               		</div>
               	</div>
               	<?php 
               		echo $this->element("blue/general/about_us_header");
               	?>
               	<div id="about-us" class="left about-us clear">
               		<div class="left left-container">
               			<?php 
               				echo $content_for_layout;
               			?>
               		</div>
               		<div class="left right-container">
               			<div class="couple-right left"></div>
               			<div class="fb-find left clear">
               				<?php 
               					echo $this->Html->image("/css/img/blue/aboutus/fb-big.png", array("class"=>"left"))
               				?>
               				<div class="left">
               					<span class="left">like us on</span> <span class="left clear fb-name">Facebook</h2>
               				</div>
               				<div class="left clear">
               					<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FQalanjo%2F183622908342331&amp;width=200&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;height=556" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:556px;" allowTransparency="true"></iframe>
               				</div>
               			</div>
               		</div>
               		
               	</div>
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
