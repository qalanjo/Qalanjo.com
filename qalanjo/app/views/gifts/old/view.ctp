<?php echo $this->element('gifts/gift_css_scripts_dialogs');?>
<?php echo $this->element('gifts/scrollable',array('action'=>'view'));?>

      	<div id="mainContent">
      	
      	
      		<!-- (start) THE PICTURE OF THE GIFT THAT WAS CLICKED ########-->
      	
      		<?php 
      			echo $this->Html->link(
					$this->Html->image('gifts/'.$currently_viewed_gift['Gift']['picture_path'],
						array(
							'height'=>'83',
							'div'=>false
						)
					),
					array(
						'controller'=>'gifts',
						'action'=>'view',
						$currently_viewed_gift['Gift']['id']
					),
					array(
						'div'=>false,
						'escape'=>false,
						'title'=>$currently_viewed_gift['Gift']['name']
					)
				);
			?>
				
			<?php 
					echo	$this->Form->create('GiftAvailTransactionItem',array('url'=>array(
									'controller'=>'gift_avail_transactions',
									'action'=>'addToCart'
								)));
					echo	$this->Form->input('gift_id',array('value'=>$currently_viewed_gift['Gift']['id'],'type'=>'hidden'));
					echo	$this->Form->input('quantity',array('label'=>'Quantity','value'=>1,'maxLength'=>7));
					echo 	$this->Form->submit('Add to Cart',array('title'=>'Add To Cart','class'=>"btCart",'div'=>false));
					echo 	$this->Form->end();
				?>
			
			<!-- (end) THE PICTURE OF THE GIFT THAT WAS CLICKED ############-->
			
			<!-- (start) THE DESCRIPTION OF THE GIFT THAT WAS CLICKED ########-->
				<div>
					<p>Price: <?php echo $currently_viewed_gift['Gift']['price'];?></p>
					<p><?php echo $currently_viewed_gift['Gift']['description'];?></p>
				</div>				
			
			<!-- (end) THE PICTURE OF THE GIFT THAT WAS CLICKED ########-->
			
			
			<?php if(!empty($related_gifts['Gift'])):?>
				
				<!-- (start)  Determine the last index -->
					<?php if(!empty($related_gifts['Gift'])):?>
						<?php $last_gift_id = $related_gifts['Gift'][sizeof($related_gifts['Gift'])-1]['id'];?>
					<?php else:?>
						<?php $last_gift_id = 0;?>
					<?php endif;?>
				<!-- (end)  Determine the last index -->

				<!-- (start) RELATED GIFTS -->
				<p>Related Gifts</p>
				
      				<?php if(!empty($related_gifts)):?>
      					<div class='scrollable-wrapper'>
	      					<!-- "previous page" action -->
							<a class="prev browse left prev_related"></a>
							<div class='scrollable scrollable_related'>
								<div class="items">
					
									<?php echo $this->element('gifts/itemsForGiftScrollable',array('type'=>$related_gifts));?>
								
								</div>
					
							</div>
							
						    <!-- "next page" action -->
							<a class="next browse right next_related"></a>
						</div>
					<?php endif;?>
			
			<?php endif;?>
			<!-- (end) RELATED GIFTS -->
			
      	</div>
      	


    <?php echo $this->Js->writeBuffer();?>