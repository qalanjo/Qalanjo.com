<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Qalanjo.com - Your Road to Love</title>
		<?php echo $this->Html->css("home/style")?>
		<?php 
			echo $this->Html->scriptBlock("
				var action='{$this->action}';
			")
		?>
		<?php echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "validate/jquery.validate.min", "js/jquery.easing.1.3", "home_new/script"))?>
	
		
	
	</head>
	<body>
		<?php echo $content_for_layout;?>
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