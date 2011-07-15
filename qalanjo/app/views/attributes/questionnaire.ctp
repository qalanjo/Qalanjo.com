<div id="top-content">

<?php echo $this->Session->flash();?>
<?php echo $instruction;?>

</div>

<div id="bottom-content">
	<?php
		echo $this->ProfileCompletor->pageN($items, $member_id, $page+1);
	?>
</div>