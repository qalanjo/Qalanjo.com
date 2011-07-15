<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/profile.css" />
<?php echo $this->Html->css(array("blueprint/screen"))?>	
<?php echo $this->Html->css("globals/core")?>
	<?php echo $this->Html->css("redmond/jquery.ui.core")?>
	<?php echo $this->Html->css("redmond/jquery.ui.theme")?>
	<?php echo $this->Html->css("redmond/jquery.ui.all")?>
	<?php echo $this->Html->css("globals/ui-form")?>	
	<?php echo $this->Html->css("members/profile/profile")?>
	<?php echo $this->Html->css("inbox/inbox")?>
	<?php echo $this->Html->css("members/search/search");?>
	
	
	<?php echo $this->Javascript->link(array("jquery", "ui/jquery-ui-1.8.10.custom","ui/autocomplete.html",  'validate/jquery.validate.min', 'custom/member_globals'))?>
	<?php echo $this->element("scripts/autocomplete")?>
<title>Qalanjo.com</title>
</head>
<body>
<?php echo $this->element("members/home_header", array("member"=>$member))?>
<div id="content">
  <div id="side-nav">
  
  		<?php if (!isset($sk)){?>
	        <div id="primary-photo">
	       <?php
	       		if ($member["MemberProfile"]["picture_path"]==""){
	       			$path = "designs/member/profile/";
	       			if ($member["Gender"]["value"]=="Man"){
						$path.="silhoutte_boy.png";
	       			}else{
	       				$path.="silhoutte_girl.png"; 			
	       			}
	       		}else{
	       			$path = "uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"];
	       		}
	       		echo $this->Html->image($path);
	       	?>
	        <p><strong>Profile:81%</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Why?</p>
	        <?php echo $this->Html->image("designs/member/profile/status-level.png")?>
	        </div>
        <?php }?>
        
        <div id="left-navigation">
        	        
        </div>

        <div id="tour_qalanjo">
        <?php
	  		$image = $this->Html->image("designs/member/profile/tour-qalanjo.png");
	  		echo $this->Html->link($image, array("action"=>"index", "controller"=>"gifts"), array("escape"=>false));
	  	?>
        </div>

		<div id="explore_profile">
        <?php
	  		$image = $this->Html->image("designs/member/profile/explore-profile.png");
	  		echo $this->Html->link($image, array("action"=>"index", "controller"=>"gifts"), array("escape"=>false));
	  	?>
        </div>

        <div id="gift-sale">
        <?php
	  		$image = $this->Html->image("designs/member/profile/gift.png");
	  		echo $this->Html->link($image, array("action"=>"index", "controller"=>"gifts"), array("escape"=>false));
	  	?>
        </div>
                
        
  </div>



  <div id="content-wrap">
 	<?php echo $this->Html->image("designs/member/profile/qalanjo_way.jpg", array("id"=>"qalanjo_way"))?>
	<div id="topMenu">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="first tab_selected ui-state-default ui-corner-top"><?php echo $this->Ajax->link("HOME", "/members/home", array("update"=>"updatable_div", "class"=>"navigation"))?></li>
			<li class="ui-state-default ui-corner-top"><?php echo $this->Ajax->link("my SEARCHES", "/members/search", array("update"=>"updatable_div", "class"=>"navigation"))?></li>
			<li class="ui-state-default ui-corner-top"><?php echo $this->Ajax->link("my MATCHES", "/members/search", array("update"=>"updatable_div", "class"=>"navigation"))?></li>
			<li class="ui-state-default ui-corner-top"><?php echo $this->Ajax->link("my CONNECTIONS", "/members/search", array("update"=>"updatable_div", "class"=>"navigation"))?></li>
		</ul>
		 
    </div>   
	<div id="updatable_div">
	<?php echo $content_for_layout;?>
	</div>
	
  </div>

 </div>
<div id="footer">
	<ul>
		<li><a href="#" title="About Us">About Us</a> </li>   
        <li><a href="#" title="Why Qalanjo">Why Qalanjo</a></li>
        <li><a href="#" title="Career">Career</a></li>
        <li><a href="#" title="Privacy">Privacy</a></li>
        <li><a href="#" title="Terms and Services">Terms and Services</a></li>
        <li><a href="#" title="Feedback">Feedback</a></li>
        <li><a href="#" title="Contact Us">Contact Us</a></li>
        <li><a href="#" title="Site Map">Site Map</a></li>
        <li><a href="#" title="How It Works">How It Works</a></li>
        <li><a href="#" title="Media Center">Media Center</a></li>
        <li><a href="#" title="Affiliates">Affiliates</a></li>
        <li><a href="#" title="Online Dating Safety Tips">Online Dating Safety Tips</a></li>
        <li><a href="#" title="Local">Local</a></li>
        <li><a href="#" title="Help">Help</a></li>
	</ul>

<p>Qalanjo.com - Your road to love &copy;</p>
</div>
</body>
</html>