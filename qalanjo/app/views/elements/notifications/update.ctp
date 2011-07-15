<?php
$this->Paginator->options(array(
    'update' => '#notifications',
    'evalScripts' => true
));
?>

<?php 
foreach ($notifications as $notification){
	?>
<div class="span-15 clear last notif_line notification">				
	<div class="span-2 delete_notification">
		<?php 
			$link = $this->Ajax->link("", "/notifications/delete/".$notification["Notification"]["id"], array("update"=>"notification_delete_update"));
			echo "<span>$link</span>";
		?>
	</div>            
	<div class="span-13 last">
		<?php echo $this->NotificationCompletor->transformMessage($notification)?>		
		<span class="winkedByDate">
		<?php echo $this->AgoTime->time_since(strtotime($notification["Notification"]["created"]))?>
		</span>
	</div>
</div>	
<?php 
}
?>
<div class="clear">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>