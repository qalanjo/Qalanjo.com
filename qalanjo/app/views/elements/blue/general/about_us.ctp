<h3>ABOUT US</h3>
<ul>
	<?php 
		if ($page=="aboutus"){
		?>
			<li class="active" >
				<?php 
					echo $this->Html->link("About Qalanjo.com", "/aboutus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Why Qalanjo", "/why");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Services", "/services");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Mngt. Team", "/team");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Affiliates", "/affiliates");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Contact Us", "/contactus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Back To Home", "/");
				?>
			</li>		
		
		<?php 	
		}else if ($page=="why"){
			?>
			<li>
				<?php 
					echo $this->Html->link("About Qalanjo.com", "/aboutus");
				?>
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("Why Qalanjo", "/why");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Services", "/services");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Mngt. Team", "/team");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Affiliates", "/affiliates");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Contact Us", "/contactus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Back To Home", "/");
				?>
			</li>
			<?php 
		}else if ($page=="services"){
			?>
			<li>
				<?php 
					echo $this->Html->link("About Qalanjo.com", "/aboutus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Why Qalanjo", "/why");
				?>
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("Services", "/services");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Mngt. Team", "/team");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Affiliates", "/affiliates");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Contact Us", "/contactus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Back To Home", "/");
				?>
			</li>
			<?php 
		}else if ($page=="team"){
			?>
			<li>
				<?php 
					echo $this->Html->link("About Qalanjo.com", "/aboutus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Why Qalanjo", "/why");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Services", "/services");
				?>
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("Mngt. Team", "/team");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Affiliates", "/affiliates");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Contact Us", "/contactus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Back To Home", "/");
				?>
			</li>
			
			<?php 
		}else if ($page=="affiliates"){
			?>
			<li>
				<?php 
					echo $this->Html->link("About Qalanjo.com", "/aboutus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Why Qalanjo", "/why");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Services", "/services");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Mngt. Team", "/team");
				?>
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("Affiliates", "/affiliates");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Contact Us", "/contactus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Back To Home", "/");
				?>
			</li>
			
			<?php 
		}else if ($page=="contactus"){
			?>
			<li>
				<?php 
					echo $this->Html->link("About Qalanjo.com", "/aboutus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Why Qalanjo", "/why");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Services", "/services");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Mngt. Team", "/team");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Affiliates", "/affiliates");
				?>
			</li>
			<li class="active">
				<?php 
					echo $this->Html->link("Contact Us", "/contactus");
				?>
			</li>
			<li>
				<?php 
					echo $this->Html->link("Back To Home", "/");
				?>
			</li>
			<?php 
		}
	?>
</ul>