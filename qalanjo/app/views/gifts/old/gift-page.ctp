<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<link rel="stylesheet" type="text/css" media="screen, print, projection"  href="css/gifts.css"></link>

</head>
<body>
<div id="top">
 <div id="page">
 	<!--######################### LEFT MENU #########################-->
     <div id="leftSideMenu">
             <?php 
			 	$image = $this->Html->image("logo.png", array("alt"=>"Qalanjo","height"=>"117","width"=>"123"));
				echo $this->Html->link($image,"#",array("escape"=>false,"title"=>"Qalanjo"));
			 ?>
             <?php
			 	$image = $this->Html->image("profilepic.png", array("alt"=>"Qalanjo","height"=>"90","class"=>"profilePicture"));
				echo $this->Html->link($image,"#",array("escape"=>false,"title"=>"myProfilePicture"));
			 ?>
            <ul>
                <li class="titleMenu">Flowers
                    <ul>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("Pink Roses", "#") ?>
                        </li>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("Red Roses", "#") ?>
                        </li>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("White and Red Roses", "#") ?>
                        </li>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("Full Bloom Red Rose", "#") ?>
                        </li>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("Daffodils", "#") ?>
                        </li>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("Pink Carnation", "#") ?>
                        </li>
                        <li class="sideSubMenus">
                        	<?php echo $this->Html->link("Tulips", "#") ?>
                        </li>
                    </ul>
                </li>
                <li class="titleMenu">Jewelries</li>
                <li class="titleMenu">E-Cards</li>
                <li class="titleMenu">Stuffed Items</li>
                <li class="titleMenu">Chocolates</li>
                <li class="titleMenu">Pets</li>
            </ul>
         </div> 
    <!--######################### TOP MENU #########################-->
 	<div id="topMenu">
        <ul class="fl">
            <li>
                <?php echo $this->Html->link("Home", "#",array("escape"=>false,"title"=>"home")) ?>
            </li>
            <li>
                <?php echo $this->Html->link("My Matches", "#",array("escape"=>false,"title"=>"my matches")) ?>
            </li>
            <li>
                <?php echo $this->Html->link("Reports", "#",array("escape"=>false,"title"=>"reports")) ?>
            </li>
        </ul>
        
        <ul class="fl2">
            <li>
                <?php echo $this->Html->link("HELP", "#",array("escape"=>false,"title"=>"help")) ?>
            </li>
            <li>
                |
            </li>
            <li>
                <?php echo $this->Html->link("MY ACCOUNT", "#",array("escape"=>false,"title"=>"my account")) ?>
            </li>
            <li>
                |
            </li>
            <li>
                <?php echo $this->Html->link("LOG OUT", "#",array("escape"=>false,"title"=>"log out")) ?>
            </li>
        </ul>
    </div>
    <!--######################### CONTENT HERE #########################-->
    <?php echo $content_for_layout;?>
 </div><!-- /page -->
 <!--######################### FOOTER HERE #########################-->
<div id="footer">
	<ul>
    	<li>
            <?php 
				echo $this->Html->link("Privacy","#",array("escape"=>false,"title"=>"Privacy"));
			?>
        </li>
        <li>
            <?php 
				echo $this->Html->link("Feedback","#",array("escape"=>false,"title"=>"Feedback"));
			?>
        </li>
        <li>
            <?php 
				echo $this->Html->link("Report","#",array("escape"=>false,"title"=>"Report"));
			?>
        </li>
        <li>
            <?php 
				echo $this->Html->link("About Us","#",array("escape"=>false,"title"=>"About Us"));
			?>
        </li>
        <li>
            <?php 
				echo $this->Html->link("Contact Us","#",array("escape"=>false,"title"=>"Contact Us"));
			?>
        </li>
    </ul>
</div><!--/footer-->
</div><!-- /top -->
</body>
</html>