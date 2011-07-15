
<div id="updatable_div">
      <div id="contentarea">
        <!--center content here-->
      	<div id="mainContent">
      		<p>Gift Preview</p>
      		<div>This is just a preview of the gifts that you are trying to send<br />To edit the message, click the "Edit More" button</div>
      		
      		
      		<?php foreach($sent_gifts_info as $gift):?>
	      		<div>
	      			<?php echo $this->Html->image('gifts/'.$gift['Gift']['picture_path'],array('width'=>83,'div'=>false));?>
	      		</div>
	      		<div>
	      			<?php echo $gift['SentGift']['message'];?>
	      		</div>
	      	<?php endforeach;?>

      		
      		
      		<div>
	      		<?php echo $this->Html->link('Edit More',
	      			array(
	      				'controller'=>'gifts',
	      				'action'=>'gift_customization'
	      			),
	      			array(
	      				'div'=>false
	      			)
	      		);?>
	      	</div>
	      	<div>
	      		<?php echo $this->Html->link('Send',
	      			array(
	      				'controller'=>'gifts',
	      				'action'=>'continue_sending_gift'
	      			),
	      			array(
	      				'div'=>false
	      			)
	      		);?>
	      	</div>
	      	
      	</div>
      </div>
</div>      