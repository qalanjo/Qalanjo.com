<div class="full_block span-24 last account_blocks">
	<div class="edit_block span-16 append-4 prepend-4">
		<div class="top_line span-16 last">
			<h2 class="span-12">Billing Information</h2>
			<div class="control span-4 last">
				<?php echo $this->Html->link("change", "#", array("class"=>"toggle_control"))?>
			</div>
		</div>
		<div id="billing_edit" class="hidden_box clear">	
			<?php echo $this->element("members/account/billing", array("countries"=>$countries))?>
		</div>
	</div>
	<div class="edit_block span-16 append-4 prepend-4">
		<div class="top_line span-16 last">
			<h2 class="span-12">Credit Cards</h2>
			<div class="control span-4 last">
				<?php echo $this->Html->link("change", "#", array("class"=>"toggle_control"))?>
			</div>
		</div>
		<div id="credit_card_edit" class="hidden_box clear">
			<div id="credit_card_list">
				<div id="loading">
					<?php 
						echo $this->Html->image("loading.gif");
					?>
				</div>
			</div>
		</div>
	</div>
	
</div>