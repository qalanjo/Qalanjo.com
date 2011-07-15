
<?php echo $session->flash();?>


<?php echo $this->element('gifts/gift_css_scripts_dialogs');?>
	
	<div id="updatable_div">
		
      	<div id="contentarea">
		 	<!--center content here-->
		    <p><?php echo $gifts[0]['GiftType']['value'];?></p>
		    <div id="mainContent">
		    	<?php echo $this->element('gifts/paginated_gifts',array('gifts'=>$gifts));?>
	    </div>
	</div>
    	
    	
    	
	</div><!--/updatable_div-->


<?php echo $this->Js->writeBuffer();?>