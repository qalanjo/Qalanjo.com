<?php 
	if (count($notifications)!=0){
?>
<div class="control_wrapper span-23 last">
	
	<div class="prepend-6 span-18 last">
		
		<div class="span-14 ralign">
		<?php 
			if (count($notifications)!=0){
		?>
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array("update"=>"messages"), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
		 |
				<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
			
		<?php 
			}
		?>
		</div>
		<p class="span-3 last ralign">
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages% messages', true)
		));
		?>	</p>	
		
	</div>
</div>
<?php 
	}
?>