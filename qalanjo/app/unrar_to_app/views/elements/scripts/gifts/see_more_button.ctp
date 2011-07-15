

<?php if($type['EOF'] == 1):?>
	<?php $eof = $type['EOF'];?>
<?php else:?>
	<?php $eof = 0;?>
<?php endif;?>

<script type="text/javascript">
	function insert_see_more_button(last_gift_id){
		var sizeOfArray =  <?php echo sizeof($type['Gift']);?>;
		var eof = <?php echo $eof;?>;
		if(eof == 1 || clicksFor<?php echo $type['GiftType']['id'];?> == 4){
			if(sizeOfArray == 6){
				$('.divForItemNo<?php echo $type['Gift'][sizeof($type['Gift'])-1]['id'];?>')
					.append(
						'<div><a href="#"><img src="<?php echo $this->Html->url('/img/gifts/seeMoreButton.png');?>" height="83" alt=""></a></div>'
					);
			}else{
				$('.divForItemNo<?php echo $type['Gift'][sizeof($type['Gift'])-1]['id'];?>')
					.append(
						'<a href="#"><img src="<?php echo $this->Html->url('/img/gifts/seeMoreButton.png');?>" height="83" alt=""></a>'
					);
			}
		}
	}
</script>