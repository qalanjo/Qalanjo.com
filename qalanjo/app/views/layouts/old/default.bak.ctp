<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Qalanjo.com</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php 
	     if (isset($home)){
	     	echo $this->Html->css("home/home");
	     	echo $this->Html->css("globals/globals");
	     	
	     }else if (isset($profile_completion)){
	     	echo $this->Html->css("profile_completion");
	     }
	?>
</head>
<body>
	<?php echo $content_for_layout;?>
	<?php echo $this->Javascript->link(array('test/flexi-background')); ?>
</body>
</html>


