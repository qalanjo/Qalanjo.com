<?php echo $this->element('scripts/gifts/counterForScrollableClicks',array('types'=>$types));?>

<?php echo $this->element('scripts/gifts/addItem');?>

<?php echo $this->element('scripts/gifts/scrollable');?>


<div id="updatable_div">
      <div id="contentarea">
        <!--center content here-->
        <p>Browse Your Gifts</p>
        <p class="praGraph">Search Gifts: <input type="text" name="q" id="gift_search" /></p>
      	<div id="mainContent">
      		
      		<?php foreach($types as $type):?>
      				<?php if(!empty($type['Gift'])):?>
						<div class='scrollable scrollable<?php echo $type['GiftType']['id'];?>'>
							<div class="bgItems">
								<p class='giftNames'><?php echo strtoupper($type['GiftType']['value']);?></p>
								
								<?php echo $this->element('itemsForGiftScrollable',array('type'=>$type));?>
								
							</div>
						</div>
					<?php endif;?>
					
					<div id='newItemFor<?php echo $type['GiftType']['id'];?>' style='display:none'>
					
						<!--new gifts from ajax requests goes here-->	
						
					</div>
					
					<?php echo $this->element('buttonsForGiftScrollable',array('type'=>$type));?>
				
			<?php endforeach;?>
      	
			
            <div id="buttonBottom">
            <?php
            	echo $this->Html->link("", "#", array("escape"=>false,"class"=>"buttonBottom"));
			?>
            </div>
            <p class="fixIt"></p>
        </div>        
      </div>
      <!--right side-->
      <div id="rightSideMenu">
      		<p class="centerIt">Enjoy all the benefits of Qalanjo!</p>
        	<a href="#" title="subscribe now!" class="bt_Subscribe"></a>
            <?php
            	echo $this->Html->link("", "#", array("escape"=>false,"class"=>"bt_Subscribe","title"=>"subscribe now!"));
			?>
            <?php
            	echo $this->Html->link("", "#", array("escape"=>false,"class"=>"bt_checkOut","title"=>"check out"));
			?>
            <?php 
				echo $this->Html->image("gifts/cart.png",array("height"=>"106"));
			?>
            <p class="subP">Sub-Total: $6.00</p>
            <?php 
				echo $this->Html->link("Add to cart","#",array("escape"=>false,"title"=>"add to cart","class"=>"btCart"));
			?>
            <?php 
				echo $this->Html->link("View Cart","#",array("escape"=>false,"title"=>"view cart","class"=>"btCart"));
			?>
            <p>&nbsp;</p>
            <p>Bouquet of Daffodils: $3.00</p>
            <p>Bouquet of Roses: $3.00</p>
      </div>
    </div><!--/updatable_div-->
    
    
    <?php echo $this->Js->writeBuffer();?>