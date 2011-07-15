<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Qalanjo.com</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<?php 
		     if (isset($home)){
		     	echo $this->Html->css("home/home");
		     	echo $this->Html->css("home/labels");
		     	
		     }else if (isset($profile_completion)){
		     	echo $this->Html->css("profile_completion");
		     }
		
		     echo $javascript->link(array('jquery', 'validate/jquery.validate.min', 'select/jquery.hyjack.select.min', "ui/jquery-ui-1.8.10.custom", "history/jquery.history.min", "temp/jquery.easing.1.3", "temp/jquery.scrollTo-1.4.2-min", 'home/home_script.js', 'home/labels.js'));
		?>
	</head>
	<body>
		<?php echo $content_for_layout;?>
	</body>
</html>