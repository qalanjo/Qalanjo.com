<?php echo $this->Html->css("jTools/scrollable-buttons.css")?>
<?php echo $this->Html->css("jTools/scrollable-items.css")?>
<?php echo $this->Javascript->link(array("jquery","jTools/jquery.tools.min.js"))?>
<script type="text/javascript">
// execute your scripts when the DOM is ready. this is mostly a good habit
$(function() {

	// initialize scrollables
	
	<?php foreach($types as $type):?>
		$(".scrollable<?php echo $type['GiftType']['id'];?>").scrollable(
			{
				next:'.next<?php echo $type['GiftType']['id'];?>',
				prev:'.prev<?php echo $type['GiftType']['id'];?>'
			});
	<?php endforeach;?>

});
</script>