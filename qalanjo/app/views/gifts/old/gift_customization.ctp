
<?php echo $this->Html->css('jTools/tabbed-items.css');?>
<?php echo $this->Javascript->link('jTools/jquery.tools.tabs.js');?>

<script>
	// perform JavaScript after the document is scriptable.
	$(function() {
		// setup ul.tabs to work as tabs for each div directly under div.panes
		$("ul.tabs").tabs("div.panes > div");
	});
</script>

<div id="updatable_div">
      <div id="contentarea">
        <!--center content here-->
      	<div id="mainContent">
      	<p>Customize your gifts</p>
      	<div>Add some fancy message to them to make the gifts more personalized</div>
      	
      	
      	<?php echo $javascript->link('tiny_mce/tiny_mce.js');?>
      	
      	<?php echo $this->Form->create('SentGift',array('inputDefaults'=>array('div'=>false,'legend'=>false),'url'=>array('controller'=>'gifts','action'=>'gift_preview')));?>
      	
      		<!-- TAB HEADERS -->
      		<ul class='tabs'>
      		
      			<?php $options = array(); // Initialize the options for adjusting the tab width?>
      			
		    	<?php 
		    		$sizeOfArray = sizeof($to_be_sent);
		    		$primePosition = 0; // prime position, this will increase by 4 every loop to check if the key is equal to $primPosition
		    		$temporary_container = array(); //temporary container for $to_be_sent_gifts, splitted by 4
		    	?>
		    	<?php
		    		while($primePosition < $sizeOfArray){
			    		$splitted = array_slice($to_be_sent,$primePosition,4);// split by 4 elements
			    		if(!empty($splitted)){
			    			$temporary_container[] = $splitted;
			    		}
			    		$primePosition += 4; 
			    	}
		    	?>
		    	
		    	<?php foreach($temporary_container as $temp):?>
			    		<?php foreach($temp as $gift):?>
			    		
			    			<?php if(sizeof($temp) == 1 || sizeof($temp) == 2): // if size of the current $temp is == 1 OR 2, the class will be 'w2'?>
			    				<?php $options = array('class'=>'w2');?>
			    			<?php elseif(sizeof($temp) == 3):?>
			    				<?php $options = array('class'=>'w1');?>
			    			<?php endif;?>
			    			
			    			<?php if(strlen($gift['Gift']['name']) < 16):?>
		      					<li><?php echo $this->Html->link($gift['Gift']['name'],'#',$options);?></li>
		      				<?php else:?>
		      					<li><?php echo $this->Html->link(substr($gift['Gift']['name'],0,14).'...','#',$options);?></li>
		      				<?php endif;?>
								
			    		<?php endforeach;?>
		    	<?php endforeach;?>
      		</ul>
      		<!-- END TAB HEADERS -->
      		
      		<!-- TAB BODY -->
      		<div class = 'panes'>
	      		<?php foreach($to_be_sent as $gift):?>
	      			<div>
	      			<?php echo $this->Html->image('gifts/'.$gift['Gift']['picture_path'],array('div'=>false));?>
	      			
	      			<?php if(isset($gift_details['SentGift']['message_number_'.$gift['Gift']['id']])):?>
	      				<?php echo $this->Form->textarea('message_number_'.$gift['Gift']['id'],array('value'=>$gift_details['SentGift']['message_number_'.$gift['Gift']['id']]));?>
	      			<?php else:?>
	      				<?php echo $this->Form->textarea('message_number_'.$gift['Gift']['id']);?>
	      			<?php endif;?>
	      			</div>
	      		<?php endforeach;?>
	      	</div>
	      	<!-- END TAB BODY -->
      	
      	<?php echo $this->element('gifts/tinymceedit');?>
      	
      	<?php echo $this->Form->input('member_id',array('value'=>$receiver,'type'=>'hidden'));?>
      	
      	<?php echo $this->Form->input('from_id',array('value'=>$sender,'type'=>'hidden'));?>
      	
      	
      	<?php echo $this->Form->end('Preview');?>
      		
      	</div>
      </div>
</div>