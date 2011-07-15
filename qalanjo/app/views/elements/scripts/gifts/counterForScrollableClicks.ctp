	<script type="text/javascript">
		<?php foreach($types as $type):?>
		
		clicksFor<?php echo $type['GiftType']['id'];?> = 0; // for checking of the number of clicks in each type
		
		// increment the number of clicks in every type
		function incrementClicksFor<?php echo $type['GiftType']['id'];?> (){
			clicksFor<?php echo $type['GiftType']['id'];?> += 1;	
		}
		
		<?php endforeach;?>
	</script>