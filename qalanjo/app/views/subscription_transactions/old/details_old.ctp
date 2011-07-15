<h1 class="blue_head">You are only few steps away to have all the benefits</h1>
<?php echo $this->Form->create("SubscriptionTransaction", array("id"=>"subscription_form"))?>
<div class="span-24 container">
	<div class="span-18">
		<!-- Plans -->
		<div class="span-9 step_block" id="step-1">
			<div class="header_step span-9">
				<div class="span-1 step_image">
					<?php echo $this->Html->image("designs/subscribe/step1.png")?>
				</div>
				<div class="span-6">
					<h2 class="step_label">Choose your plans and join today!</h2>
				</div>
				
			</div>
			<?php 
				$i = 0;
				foreach($types as $type){
					if ($i==0){
						?>
							<div class="span-9 clear open">
								<div class="span-9 last top">
									<div class="radio">
									<?php 
										echo "<input type='radio'
											name='data[SubscriptionTransaction][subscription_type_id]'
											value='{$type["SubscriptionType"]["id"]}'/>";
											echo $this->Form->label("subscription_type_id", $type["SubscriptionType"]["name"]." ".$type["SubscriptionType"]["description"], array("class"=>"primer_subscription_label"));
															
									?>	
									</div>	
								</div>
								<div class="promotional_message">
									<p>Increase your chances of communicating with that special someone by allowing them to reply back to you.
										<?php echo $this->Html->link("Terms of Use", "#")?>
									</p>
								</div>
							</div>			
						<?php 
					}else{
						?>
							<div class="span-9 clear close_select">
								<div class="radio">
									
								<?php 
									echo "<input type='radio'
										name='data[SubscriptionTransaction][subscription_type_id]'
										value='{$type["SubscriptionType"]["id"]}'/>";
										echo $this->Form->label("subscription_type_id", $type["SubscriptionType"]["name"]." ".$type["SubscriptionType"]["description"], array("class"=>"primer_subscription_label"));
															
								?>
								</div>	
							</div>	
						<?php 
					}
					$i++;
				}
			?>
			<div class="span-9 clear note_bottom">
				<p>All prices include VAT or GST as applicable</p>
			</div>
			
		</div>
		
		
		<!-- Payment Options -->
		<div class="span-9 step_block last" id="step-2">
			<div class="header_step span-9">
				<div class="span-1 step_image">
					<?php echo $this->Html->image("designs/subscribe/step2.png")?>
				</div>
				<div class="span-6">
					<h2 class="step_label">Please select your payment option!</h2>
				</div>
			
			</div>
			
			
			<div class="span-7 append-1 prepend-1" class="form">
				<?php 
				
					foreach($creditTypes as $creditType){
						echo "<div class='span-2'>";
						echo "<input type='radio'
										name='data[SubscriptionTransaction][credit_type_id]'
										value='{$creditType["CreditType"]["id"]}'/>";
						echo $this->Html->image("designs/creditcard/".$creditType["CreditType"]["paypal_name"].".png");
						echo "</div>";
					}
				
				?>
			</div>
			
			<div class="span-7 append-1 prepend-1" class="form">
				<?php 
					echo "<div class='span-7 last'>";
						echo $this->Form->label("CreditCard.cardnumber", "Card Number", array("class"=>"span-3"));
						echo $this->Form->input("CreditCard.cardnumber", array("div"=>"span-6", "label"=>false));
					echo "</div>";
					echo "<div class='span-7 last'>";
						echo $this->Form->label("CreditCard.cardnumber", "Card Verification Code", array("class"=>"span-4"));
						echo $this->Form->input("CreditCard.cv_code", array("div"=>"span-6", "label"=>false));
					echo "</div>";
					
					echo "<div class='span-7 clear last'>";
						echo $this->Form->label("Member.name", "Name as it appears on card", array("class"=>"span-7 last"));
						echo $this->Form->input("Member.firstname", array("div"=>"span-3", "label"=>false));
						echo $this->Form->input("Member.lastname", array("div"=>"span-3 lastname", "label"=>false));
					echo "</div>";
					
					echo "<div class='span-7 clear last'>";
						echo $this->Form->label("CreditCard.expirationdate", "Expiration Date", array("class"=>"span-9 last"));
						echo $this->Form->month('CreditCard.expiration_month', "January", array("div"=>"span-2 append-1", "label"=>false, "empty"=>false));
						echo $this->Form->year('CreditCard.expiration_year', date("Y"), date("Y")+5,date("Y")+1,array("div"=>"span-2 last", "label"=>false, "empty"=>false));
					echo "</div>";			
				?>
			</div>
			
			<div class="span-9">
				<p>When you click 'Confirm', your credit card will be immediately be charged and your service will be renewed automatically after your initial term unless canceled on the Account Settings page</p>
			</div>
		</div>
		
		<!-- The Benefits -->
		<div class="span-18 clear" id="benefits_block">
			<div class="span-18 clear last">
			
				<div class="span-9 append-1 calign">
					<h3 id="benefits_head">
						Benefits of qalanjo.com subscription
					</h3>
				</div>
				<div class="span-4 calign">
					<h3>
						With Subscription
					</h3>
				</div>
				<div class="span-4 last calign">
					<h3>
						Without Subscription
					</h3>
				</div>
				
			</div>
			
			
			
			<!-- Receive daily personalized match -->
			<div class="span-18 last row">
				<div class="prepend-1 span-17 last benefit_section">		
					Advance Match Making Service
				</div>
			</div>
			
			<div class="span-18 clear last row sub">
			
				<div class="span-9 append-1 calign">
					<div class="span-6 inline">	
						Receive daily personalized match
					</div>
				</div>
				<div class="span-4 calign">
					<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						
				</div>
				
			</div>
			
			
			
			<!-- Communicate with singles -->
			<div class="span-18 last row">
				<div class="prepend-1 span-17 last benefit_section">		
					Communicate with singles in the Qalanjo community
				</div>
			</div>
			
			
			<div class="span-18 clear last row row_line sub">
			
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline">	
						Receive daily updates directly to your email
					</div>
				</div>
				<div class="span-4 calign">
					<?php echo $this->Html->image("designs/subscribe/dot.png")?>	
				</div>
				<div class="span-4 last calign">
						
				</div>
			</div>		
			<div class="span-18 clear last row row_line sub">
					
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline">	
						Send and receive a private on-site email inbox
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						
				</div>
				
			</div>
			<div class="span-18 clear last row row_line sub">
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline ">	
						Wink to express your interest	
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
			</div>
			<div class="span-18 clear last row sub">
			
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline sub">	
						Organize your contacts using the Connection page
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						
				</div>
				
			</div>
			
			<!-- Search the site for your Matches -->
			<div class="span-18 last row">
				<div class="prepend-1 span-17 last benefit_section">		
					Search the site for your Matches
				</div>
			</div>
			
			<div class="span-18 clear last row row_line sub">
			
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline">	
						See who viewed your profile
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						
				</div>
			</div>
			
			<div class="span-18 clear last row sub">
			
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline">	
						Find your matches using our custom Single Finder System
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						
				</div>
			</div>
			
			<!-- Build your profile -->
			<div class="span-18 last row">
				<div class="prepend-1 span-17 last benefit_section">		
					Build your personal profile page	
				</div>
			</div>
			
			<div class="span-18 clear last row row_line sub">
			
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline">	
						Receive priority service with our Benefits team
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						
				</div>
			</div>
			<div class="span-18 clear last row sub">
			
				<div class="span-9 append-1">
					<div class="prepend-1 span-6 inline">	
						Create a profile and add photos
					</div>
				</div>
				<div class="span-4 calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
				<div class="span-4 last calign">
						<?php echo $this->Html->image("designs/subscribe/dot.png")?>
				</div>
		
			</div>
							
		</div>
		
	</div>
	
	<!-- Right Sidebar -->
	<div class="span-6 last">
		<div class="span-6 last" id="checkout_box">
		
			<div class="span-6 header_checkout last">
				<h2>
					CHECKOUT
				</h2>
				
			</div>
			
			<div class="span-6 last calign">
				<?php echo $this->Html->image("designs/subscribe/checkoutcart.png")?>
				
			</div>
			<div class="span-6 calign last">
				<div class="checkout_section">
					ORDER DETAILS
				</div>
			</div>
			<div class="span-6 calign last" id="checkout_content">
			
			</div>
			
			<?php echo $this->Ajax->submit("VERIFY CHECKOUT",array("update"=>"checkout", "before"=>"showBillingInfo()", "indicator"=>"loading", "div"=>"span-6 calign last", "class"=>"checkout_section"))?>
		</div>
		
		
		
	</div>
	
		
</div>
<div id="checkout">
	
</div>


<?php
echo $this->Form->end();
