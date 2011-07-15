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
			}else if (($this->action=="index")&&($this->name=="Matches")){
				echo $this->Html->css("blue/matches-page-style");
				echo $this->Javascript->link("blue/matches/index");
			}else if ((($this->action=="inbox")&&($this->name=="ReceiveMessages"))||(($this->action=="read")&&($this->name=="PrivateMessages"))){
				echo $this->Html->css("blue/inbox");
				echo $this->Html->css("blue/reply");
				echo $this->Html->css("blue/match-selector");
				echo $this->Html->css("blue/message-writer");
				echo $this->Javascript->link("js/jquery.textarea-expander");		
				echo $this->Javascript->link("blue/inbox/inbox");
				echo $this->Html->scriptBlock("
					var member_id = {$member_id};
					var state = '{$this->action}';
					");
			}else if ($this->action=="checkout"){
				echo $this->Html->css("blue/checkout");
				echo $this->Javascript->link("blue/subscription_transactions/checkout");
				
			}else if (($this->action=="account")&&($this->name=="Members")){
				echo $this->Html->css("blue/account-setting");
					
			}else if ($this->action=="match_settings"){
				echo $this->Html->css("blue/match-settings");
				echo $this->Html->css("blue/match-setting-personal-preferences");
				echo $this->Html->css("blue/match-setting-distance");
				echo $this->Html->css("blue/match-setting-back-beliefs");
			}else if (($this->action=="edit")&&($this->name=="Members")){
				echo $this->Html->css("blue/edit-profile-style");
				echo $this->Javascript->link("blue/members/edit-profile-script");
			}else if (($this->name=="Photos")||($this->name=="Album")){
				echo $this->Html->css(array(
			       'blue/photos-homepage-style',
			       'blue/matches-page-style',
			       'blue/member-homepage-style',
					"blue/photos"));
			    echo $this->Javascript->link("uploader/swfobject");
			    echo $this->Html->css("uploadify");
			    echo $this->Javascript->link("uploader/jquery.uploadify.v2.1.4.min");
			    echo $this->element("photos/photos_upload", array("member_id"=>$member_id));
			    echo $this->Javascript->link('slimbox/js/slimbox-trunk');
			    echo $this->Html->css('photos/slimbox2');
			    //echo $this->Html->css('photos/thumbnail-photos');
			}else if (($this->action=="details")&&($this->name=="SubscriptionTransactions")){
				echo $this->Html->css("blue/subscription");
				echo $this->Javascript->link("blue/subscription_transactions/details");
			}
			
			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div id="indicator_1" class="calign" style="display:none">
			<h3>
				Loading...
			</h3>
		</div>
		<?php 
			
				echo $this->element("blue/general/comet");
			
		?>
		<div class="container">
			<?php echo $this->element("blue/members/general/header")?>
			<div id="homebox" class="homebox">
				<?php echo $content_for_layout;?>
			</div>
		</div>
		
			<?php echo $this->element("blue/general/footer")?>
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
