<?php 
	/*
	 * Subscription details
	 * @version 0.0.1
	 * @date 5/24/2011
	 * 
	 */
	$pathGen = "designs/blue/subscription_transactions/general/";
	$pathDetail= "designs/blue/subscription_transactions/details/";
?>

<div class="content-container">
	<div class="photo-header">
		<h2>
			<?php echo $this->Html->image("designs/blue/matches/encourage.jpg")?>
		</h2>
		
		
	</div>
	
	<div class="left" id="content_box">
			<div class="left" id="content">
				<div id="invitation" class="left">
					<p class="instruction message left"><strong>Allanaire</strong>, experience the <strong>Qalanjo difference</strong>.</p>
					<p class="signup message left clear">Sign up now</p>
				</div>
				
				<div id="subscription_detail" class="left clear">
					<div id="subscription_tab" class="left clear">
						
						<div class="tab left">
							<strong>Total</strong>Connect
						</div>
						<div class="content_tab left">
							<div class="left tab-skin-top">
								<span class="promotion-message left">
									<strong>Premium Personality Profile</strong> and other <strong>Basic Plus feature</strong> features. 
								</span>
							</div>
							<div class="left clear subscription-list">
								<?php 
									foreach($types as $type){
										?>
										<div class="left subscription">
											<p>
												<span class="time left">
													<?php 
														if ($type["SubscriptionType"]["months"]==1){
															echo $type["SubscriptionType"]["months"]." month";
														}else{
															echo $type["SubscriptionType"]["months"]." months";
														}
													?>	
												</span>	
												<span class="value left clear">
													<?php echo $type["SubscriptionType"]["name"]?>					
												</span>
												<span class="price left clear">
													$ <?php echo $type["SubscriptionType"]["price"]?>	
												</span>	
												<span class="permonth left clear">
													per month
												</span>
												<span class="joinnow left clear">
													<?php 
														echo $this->Html->link(" ", "/subscription_transactions/checkout/".$type["SubscriptionType"]["id"]);
													?>
												</span>
											</p>
										</div>
										
										
										<?php 
									}
								
								?>
							</div>
						</div>
					</div>
					
					<div id="reasons" class="left">
						<table class="benefits">
							<tr class=" benefits-header">
								<th class="features">
									Membership Plan Features									
								</th>	
								<th class="connect">
									<strong class="connect">Total</strong>Connect Plan									
								</th>	
								<th>
									Free									
								</th>	
								
							</tr>
							
							<tr>
								<td>
									Receive daily personalized match
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Receive daily updates directly to your email
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Wink to express your interest
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check grey.png");
									?>
								
								</td>
							</tr>
							<tr>
								<td>
									Send free ice breakers.
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check grey.png");
									?>
								
								</td>
							</tr>
							<tr>
								<td>
									Organize your contacts using the Connection page
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									See who viewed your profile
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									Find your matches using our custom Single Finder System
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								
								</td>
								<td>
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td>
									Build your personal profile page
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check green.png");
									?>
								
								</td>
								<td>
									<?php 
										echo $this->Html->image($pathDetail."/check grey.png");
									?>
								
								</td>
							</tr>
							
																
						</table>
						
					</div>
					
					
				</div>
				
				<!-- The sidebar -->
				<div id="sidebar" class="left">
					<p class="tagline left">
						The # 1 trusted Dating Website for Somali Singles
						
					</p>
					<div class="left couple">
						
					</div>
					<div id="whyqalanjo" class="left">
						<h3>Why Qalanjo</h3>
						<h4>It Works!</h4>
						<p class="message">
							Qalanjo.com gives you a chance to meet with strangers who will eventually play a very important role in your life. 							
						</p>
						
					</div>
					
					<div id="payment" class="left">
						<span>We accept payment</span>
						<div id="cards" class="left">
							<?php 
								echo $this->Html->image($pathDetail."/visa_s1.png", array("alt"=>"Visa"));
								echo $this->Html->image($pathDetail."/master_s1.png", array("alt"=>"Master"));
								echo $this->Html->image($pathDetail."/amex_s1.png", array("alt"=>"American Express"));
								echo $this->Html->image($pathDetail."/paypal_s1.png", array("alt"=>"Paypal"));
							?>
						</div>
					</div>
				</div>
			</div>
	</div>
	
</div>