<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Qalanjo.com</title>
   <?php echo $this->Html->css("globals/core")?>
	<?php echo $this->Html->css("blueprint/screen")?>
	<?php echo $this->Html->css(array("blueprint/print"), "stylesheet", array("media"=>"print"))?>
	<!--[if IE]><?php echo $this->Html->css("blueprint/ie")?><![endif]-->
	<?php echo $this->Html->css(array("redmond/jquery.ui.all", "blue/questionnaire", "toastmessage/css/jquery.toastmessage", "blue/footer"))?>
     <?php 
			$path = $this->Html->url("/");
			echo $this->element("scripts/php_javascript", array("url"=>$path));
		?>
	<?php echo $this->Javascript->link(array("jquery", "js/jquery-animate-clip", "js/jquery.easing.1.3", "ui/jquery-ui-1.8.10.custom",'validate/jquery.validate.min', "ui/autocomplete.html", "js/jquery.toastmessage.js", "js/jquery.form"))?>   
	<?php echo $scripts_for_layout;?>
</head>
<body>
    <div class="container">
        <div class="shadow left">
        </div>
        <div class="container-main left">
            <div class="header left">
                <div class="logo left">
                </div>
                <div class="couple-top left">
                </div>
                <div class="communicate left">
                </div>
            </div>
            <div class="header-divider left">
            </div>
            <div class="questionnaire-container left">
                <ul class="left progress-indicator">
                    <li class="active step-1">
                        <div class="body-step-1 left">
                            <h2>
                                Profile
                                <br />
                                Building</h2>
                        </div>
                        <div class="number-1 left">
                        </div>
                    </li>
                    <?php 
                    	if (($this->action=="questionnaire")||($this->action=="match_preference")||($this->action=="questionnaire_success")){
                    		$class="active";
                    	}else{
                    		$class="";
                    	}
                    ?>
                    <li class="step-2 <?php echo $class?>">
                    	
                        <div class="body-edge-step left">
                        </div>
                        <div class="body-step left">
                            <h2>
                                Personality Assessment</h2>
                        </div>
                        <div class="number-2 left">
                        </div>
                    </li>
                    <?php 
	                    if (($this->action=="match_preference")||($this->action=="questionnaire_success")){
	                    	$class="active";
	                    }else{
	                    	$class="";
	                    }
                    ?>
                    <li class="step-3 <?php echo $class?>">
                        <div class="body-edge-step body-edge-step-3 left">
                        </div>
                        <div class="body-step body-step-3 left">
                            <h2>
                                Match<br />
                                Preference</h2>
                        </div>
                        <div class="number-3 left">
                        </div>
                    </li>
                </ul>
                <div class="left progress-bar-set">
                    <div class="progress-bar">
                        <div class="progress" style="width:<?php echo $perc?>%">
                        </div>
                    </div>
                    <p>
                        <span id="progress"><?php echo $perc?>%</span> Completeness</p>
                </div>
                <h1 class="questionnaire-header left clear">
                    <span class="progress-step left"><?php echo $pageSet?></span> <span class="progress-step-items right">
                        <?php echo $progressSet?></span>
                </h1>
                <div id="item-set" class="item-set left">
                  <?php 
                  	echo $content_for_layout;
                  ?>
                </div>
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
            <div class="gradient-bottom left">
            </div>
        </div>
</body>
</html>