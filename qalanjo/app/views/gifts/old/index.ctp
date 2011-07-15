<?php echo $session->flash();?>
<?php echo $this->element('gifts/gift_css_scripts_dialogs');?>
<?php echo $this->element('gifts/scrollable',array('types'=>$types,'action'=>'index'));?>
	
		
<div id="mainContent"><!-- MAIN CONTENT -->
    	
	<?php foreach($types as $type):?> <!-- LOOP FOR GIFT SCROLLABLE ITEMS -->
      	<?php if(!empty($type['Gift'])):?>
      		<div class='scrollable-wrapper'><!-- SCROLLABLE-WRAPPER -->
	      		<!-- "previous page" action -->
				<a class="prev browse left prev<?php echo $type['GiftType']['id'];?>"></a><!-- PREV BUTTON SCROLLABLE -->

				<div class='scrollable scrollable<?php echo $type['GiftType']['id'];?> span-13'><!-- SCROLLABLE -->
				    			
					<h2 class="title"><?php echo strtoupper($type['GiftType']['value']);?></h2><!-- CATEGORY TITLE -->
					
					<div class="items"><!-- ITEMS SCROLLABLE -->
									
						<?php echo $this->element('gifts/itemsForGiftScrollable',array('type'=>$type,'see_more'=>1));?>
									
					</div><!-- ( END ) ITEMS SCROLLABLE -->
						
				</div><!-- ( END ) SCROLLABLE -->
					
				<!-- "next page" action -->
				<a class="next browse right next<?php echo $type['GiftType']['id'];?>"></a><!-- NEXT BUTTON SCROLLABLE -->
				
			</div><!-- ( END ) SCROLLABLE-WRAPPER
						
		<?php endif;?>
	<?php endforeach;?><!-- ( END ) LOOP FOR GIFT SCROLLABLE ITEMS -->
</div><!-- ( END ) MAIN CONTENT-->
    
<?php echo $this->Js->writeBuffer();?>