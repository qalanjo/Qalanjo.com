<?php if ($render=="ajax"){?>
	<div class="span-15" id="content-main">
		<div id="title" class="span-15 last">
			<div class="span-10">
				<h2>Notifications
					
				</h2>
			</div>
			<div class="span-5 last">
				<div id="button">
				
				</div>
			</div>
		</div>
		<div id="notifications" class="span-15 last">
			<?php echo $this->element("notifications/update")?>
		</div>
	</div>
	
	<div id="content-sidebar" class="span-4 last">
	</div>
<?php 
}else{
	echo $this->element("notifications/update");
}