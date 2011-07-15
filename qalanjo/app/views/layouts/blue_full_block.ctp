<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Qalanjo.com</title>
		<?php echo $this->Html->css("globals/core")?>
		<?php echo $this->Html->css("blueprint/screen")?>
		<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
		<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
		<?php echo $this->Html->css(array("redmond/jquery.ui.all", "blue/container-style", "toastmessage/css/jquery.toastmessage"))?>
		<?php 
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
		<?php echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "js/jquery.easing.1.3", "ui/jquery-ui-1.8.10.custom",'validate/jquery.validate.min', "ui/autocomplete.html", "js/jquery.toastmessage.js", "js/jquery.form", "blue/members/session_checker"))?>
		<?php 
			if ($this->action=="match_settings"){
				echo $this->Html->css("blue/match-setting");
			}else if (($this->name=="Photos")||($this->name=="Album")){
				echo $this->Html->css(array(
			       'blue/matches-page-style',
				   'blue/album'));
			    echo $this->Javascript->link("uploader/swfobject");
			    echo $this->Html->css("uploadify");
			    echo $this->Javascript->link("uploader/jquery.uploadify.v2.1.4.min");
				echo $this->Html->css('photos/upload-style');
			    echo $this->element('photos/upload-script');
			    echo $this->Javascript->link('slimbox/js/slimbox-trunk');
			    echo $this->Javascript->link('popup-box/popup-box');
			    echo $this->Html->css('photos/slimbox2');
			    echo $this->Html->css(array(
			    		'blue/ui-dialog',
			    		'blue/upload-style'));
			}
			echo $this->Html->scriptBlock("
				var userid = {$member["Member"]["id"]}
			");
			echo $scripts_for_layout;
			$path_container = "/css/img/blue/container/";
		?>
	</head>
    <body>
    	<div class="header-bg">
    		
			
    	</div>
    		<?php 
		
			echo $this->element("blue/general/comet");
		
			?>
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
							<?php 
								if (isset($member["MemberProfile"])&&($member["MemberProfile"]["picture_path"]!="")){
									echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"left profile-pic"));
								}else{
									if (isset($member["Gender"])){
										if ($member["Gender"]["value"]=="Man"){
											echo $this->Html->image($path."s-men.jpg", array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"left profile-pic"));
										}else{
											echo $this->Html->image($path."s-women.jpg", array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"left profile-pic"));
										}
									}else{
										if (isset($user["MemberProfile"]["picture_path"])||($user["MemberProfile"]["picture_path"]!="")){
											echo $this->Html->image("uploads/".$user["Member"]["id"]."/default/profile_thumb_".$user["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$user["Member"]["id"], "class"=>"left profile-pic"));
										}else{
											if ($user["Gender"]["value"]=="Man"){
												echo $this->Html->image($path."s-men.jpg", array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"left profile-pic"));
											}else{
												echo $this->Html->image($path."s-women.jpg", array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"left profile-pic"));
											}	
										}
									}
								}
							?>
							<span class="left">Hi, Welcome <strong><?php 
							if (isset($user)){
								echo $user["Member"]["firstname"]." ".$user["Member"]["lastname"];
							}else{
								echo $member["Member"]["firstname"]." ".$member["Member"]["lastname"];	
							}	
							?></strong> |  <?php echo $this->Html->link("Log-out", "/members/logout")?></span>
							<span class="right clear"><?php echo date("l, F d, Y h:m A")?></span>
						</div>
					</div>
					
					<?php echo $this->element("blue/members/general/header")?>
					
				</div>
			</div>
			<div class="tab-line left">
			</div>
			<div class="homebox">
				<?php 
					echo $content_for_layout;
				?>
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