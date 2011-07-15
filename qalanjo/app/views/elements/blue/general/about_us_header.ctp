<div class="left clear about-us-menu">
	<ul class="left">
		<?php 
			if ($page=="aboutus"){
		?>
			<li class="active">
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li>
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li>
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li>
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li>
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li>
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php }else if ($page=="why"){?>
			<li>
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li class="active">
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li>
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li>
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li>
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li>
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php }else if ($page=="services"){?>
			<li>
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li>
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li class="active">
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li>
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li>
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li>
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php }else if ($page=="team"){?>
			<li>
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li>
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li>
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li class="active">
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li>
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li>
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php }else if ($page=="affiliates"){?>
			<li>
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li>
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li>
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li>
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li class="active">
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li>
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php } else if ($page=="contactus"){?>
			<li>
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li>
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li>
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li>
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li>
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li class="active">
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php }else{?>
			<li>
				<?php echo $this->Html->link("About Us", "/aboutus")?>
			</li>
			<li>
				<?php echo $this->Html->link("Why Qalanjo", "/why")?>
			</li>
			<li>
				<?php echo $this->Html->link("Services", "/services")?>
			</li>
			<li>
				<?php echo $this->Html->link("Management Team", "/team")?>
			</li>
			<li>
				<?php echo $this->Html->link("Affiliates", "/affiliates")?>
			
			</li>
			
			<li>
				<?php echo $this->Html->link("Contact Us", "/contactus")?>
			</li>
		<?php }?>
	</ul>
</div>