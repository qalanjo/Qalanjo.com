<?php 
	if ($view_member["Gender"]["value"]=="Woman"){
		$pronoun = "her";
		$pronoun_ref = "She";
		$pronoun_self = "her";
		$pronoun_self_prop = "Her";
	}else{
		$pronoun = "him";
		$pronoun_self = "his";
		$pronoun_ref = "He";
		$pronoun_self_prop = "His";
	}
	$path = "designs/blue/members/profile/";
	$this->Html->scriptBlock("
		var member_id = {$member["Member"]["id"]};
		var to_id = {$view_member["Member"]["id"]};
		
	", array("inline"=>false));
	$this->Html->css("blue/ui-dialog", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/message-writer", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/view-profile-style", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/ui-dialog", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/icebreaker", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/subscribe-message", "stylesheet", array("inline"=>false));
	
	$this->Html->css("blue/wink", "stylesheet", array("inline"=>false));
	$this->Javascript->link(array("blue/members/profile_functions", "blue/members/profile"), false);
	$this->Html->scriptBlock("
		var role = {$role};
	", array("inline"=>false));
?>
<div class="content-container">
	<div class="view-profile-page-header">
		<div class="header-left-side">
			<span class="personal-info"><?php
														
			
											echo $view_member["Member"]["firstname"].", ";
											if ($view_member["Member"]["city"]!=""){
												echo $view_member["Member"]["city"].", ";
											}
											if ($view_member["Member"]["state"]!=""){
												echo $view_member["Member"]["state"];
											}
											
											?>
			</span>
			<span class="back-to-my-matches-link">&laquo;<?php echo $this->Html->link("Back to my matches", "/matches")?></span>
		</div>
		<div class="header-right-side">
			<?php
				if (!isset($subscription)){
				?>
					<span>Enjoy all the benefits of Qalanjo - 
					<?php echo $this->Html->link("Subscribe now!", "/subscribe")?>					
					</span>
				<?php 	
				}
			?>
		
			
		</div>
	</div>
	<div class="main-content">
		<div class="left-side">
			<div class="introduction-box">
				<div class="introduction-box-left-side">
					<?php 
						if (isset($view_member["MemberProfile"]["picture_path"])||($view_member["MemberProfile"]["picture_path"]!="")){
							echo $this->Html->image("uploads/".$view_member["Member"]["id"]."/default/profile_thumb_".$view_member["MemberProfile"]["picture_path"]);
						}else{
							if ($view_member["Gender"]["value"]=="Man"){
								echo $this->Html->image($path."default.jpg");
							}else{
								echo $this->Html->image($path."woman-default-picture.jpg");
							}
						}
					?>
				<?php if ($view_member["Member"]["id"]!=$member["Member"]["id"]){?>
					
					<a href="#" class="winker button">Wink</a>
					<?php echo $this->Html->link('Send a Gift', array('controller'=>'gifts'), array('class'=>'button last')); ?>
				<?php }?>
					<br/>
					<p class="status">
					<?php 
						if ($view_member["Member"]["online"]==1){
							echo $this->Html->link("$pronoun_ref is online", "#", array("class"=>"online"));
						}else{
							echo $this->Html->link("$pronoun_ref is last active last ".$this->Time->$this->Time->timeAgoInWords($view_member["Member"]["modified"]), "#", array("class"=>"last-active"));
						}
					?>
					</p>
				</div>
				<div class="introduction-box-right-side">
					<span>The one thing I am most passionate about:</span>
					<div class="passionate-about-box">
						<?php 
							echo $profile["MemberProfile"]["passionate_about"];
						?>
					</div>
					<span>The most important thing I am looking for in a person is:</span>
					<div class="looking-for-a-person">
						<?php 
							echo $profile["MemberProfile"]["looking_for_details"];
						?>
						
					</div>
				</div>
			</div>
			<div class="main-content-tab">
				<div class="main-content-tab-bar">
					<ul>
						<li class="active">
							<a>
								<span class="tab-left"></span>
								<span>About Me</span>
								<span class="tab-right"></span>
							</a>
						</li>
						
					</ul>
				</div>
				<div class="tab-content-container-top">
				</div>
				<div class="tab-content-container-body">
					<div class="next-step-bar">
						<span>Next Step:</span>
						<a class="next-step-button message_link" href="#"></a>
					</div>
					<div class="first-viewed-date">
					<?php 
						if (!empty($firstViewed)){
							echo "You first viewed this information on ".($firstViewed["ViewActivity"]["created"]);
						}else{
							echo "You never viewed his information";
						}
					
					?>
					</div>
					<h2>Basic Information</h2>
					<dl class="basic-information-dl">
						<dt>
							Occupation:
						</dt>
						<dd>
							<?php echo $profile["MemberProfile"]["occupation"]?>
						</dd>
						<dt>
							Age:
						</dt>
						<dd>
							<?php echo $view_member["Member"]["age"]?>
						</dd>
						<dt>
							Height:
						</dt>
						<dd>
							<?php echo $profile["MemberProfile"]["height_ft"]?>'<?php echo $profile["MemberProfile"]["height_inch"]?>"
						</dd>
						
						<dt>
							Kids at Home:
						</dt>
						<dd>
							<?php echo $haveKids["ProfileAnswer"]["answer"]?>
						</dd>
					</dl>
					<dl class="basic-information-dl">
						<dt>
							Drinks:
						</dt>
						<dd>
							<?php echo $drink["ProfileAnswer"]["answer"]?>
						</dd>
						<dt>
							Smokes:
						</dt>
						<dd>
							<?php echo $smoke["ProfileAnswer"]["answer"]?>
						</dd>
						<dt>
							Goes to the gym:
						</dt>
						<dd>
							<?php echo $gym["ProfileAnswer"]["answer"]?>
						</dd>
						<dt>
							Controls diet:
						</dt>
						<dd>
							<?php echo $diet["ProfileAnswer"]["answer"]?>
						</dd>
						
						<dt>
							Match Delivered:
						</dt>
						<dd>
							<?php 
								if (!$match){
									echo "Not a match";
								}else{
									echo date("m/d/Y", strtotime($match["Match"]["created"]));
								}
							?>
						</dd>
						
					</dl>
					
					
					<h2>Physical Appearance</h2>
					<dl class="basic-information-dl">
						<dt>
							Eye Color:
						</dt>
						<dd>
							
							<?php echo $eyes["ProfileAnswer"]["answer"]?>
						</dd>
						<dt>
							Hair Color:
						</dt>
						<dd>
							<?php echo $hairColor["ProfileAnswer"]["answer"]?>
						</dd>
						<dt>
							Hair Length:
						</dt>
						<dd>
							<?php echo $hairLength["ProfileAnswer"]["answer"]?>
						</dd>
						
						<dt>
							Describe <?php echo $pronoun_self?> build as:
						</dt>
						<dd>
							<?php echo $diet["ProfileAnswer"]["answer"]?>
						</dd>
						
						<dt>
							Describe <?php echo $pronoun_self?> appearance as:
						</dt>
						<dd>
							<?php echo $appearance["ProfileAnswer"]["answer"]?>
						</dd>
						
						
					</dl>
					
					<h2>Express Yourself</h2>
					<dl class="in-my-own-words-dl">
						<?php 
							$i=0;
							foreach($own_words as $word){
								if (($word["InMyOwnWordsAnswer"]["answer"]!="")&&($i<=2)){
							?>
								<dt>
									<?php 
										echo $word["InMyOwnWordQuestion"]["question"];
									?>		
								</dt>
								<dd>
									<?php 
										echo $word["InMyOwnWordsAnswer"]["answer"];
									?>
								</dd>
							<?php 							
									$i++;
								}
							}
						?>
						<?php 
						if ($profile["MemberProfile"]["match_want"]!=""){
								
						?>
							<dt>
								Some additional information I want you to know: 
							</dt>
							<dd>
								
								<?php 
										echo $profile["MemberProfile"]["match_want"];	
								?>
							</dd>
						<?php }?>
					</dl>
					<?php if ($profile["MemberProfile"]["leisure_activity"]!=""){?>
						<h2>My Interests</h2>
						<dl class="in-my-own-words-dl">
							<div class="column">
								<dt>
									I typically spend my leisure time:
								</dt>
								<dd>
									<?php echo $profile["MemberProfile"]["leisure_activity"]?>
								</dd>
							</div>
							<div class="column last">
								
							</div>
						</dl>
					<?php }?>
					<?php 
						if (!empty($view_member["FriendSayTrait"])){
					?>
						<h2>According to my friends:</h2>
						<dl class="in-my-own-words-dl">
							<dt>
								My friends describe me as:
							</dt>
							<dd>
								<ul>
								
									<?php 
									
										foreach($view_member["FriendSayTrait"] as $trait){
											?>
												<li><?php echo $trait["value"]?></li>
											<?php 
										}
									?>
								</ul>
							</dd>
							<div class="next-step">
								<dt>
									Next Step:
								</dt>
								<dd>
									<a class="next-step-button message_link" href="#"></a>
								</dd>
								
						
							</div>
						</dl>
					<?php }?>
					
				</div>
			</div>
			<?php 
				if ($view_member["Member"]["id"]!=$member["Member"]["id"]){?>

					<div class="what-to-do-with-this-user">
						<?php echo $this->Html->link("Archive this Match", "/matches/archive/".$view_member["Member"]["id"])?>
					</div>
			<?php 
				}
			?>
		</div>
		<div class="right-side">
			<div class="next-step-panel panel">
				<h2>
					<span>Next Steps</span>
					<span class="links"><a href="#">Need help with this</a></span>
				</h2>
				<div class="content">
					<?php if ($view_member["Member"]["id"]!=$member["Member"]["id"]){?>
						<p>Interested in <?php echo $view_member["Member"]["firstname"]?>'s profile: Send a message and get to know <?php echo $pronoun_self?> better.</p>
						<ul>
							
								<li>
									<div>
										<a class="send-him-a-message-button message_link" href="#">Send <?php echo $pronoun?> a Message</a>
									</div>
								</li>
								<li>
									<div>
										<?php echo $this->Html->image($path."bubble.png")?>
										<a href="#" id="icebreaker_link">Send FREE icebreaker</a>
									</div>
								</li>
								<li>
									<div>
										<?php echo $this->Html->link("View $pronoun_self pictures", "/photos/".$view_member["Member"]["id"])?>
										<a href="#" id="icebreaker_link">Send FREE icebreaker</a>
									</div>
								</li>
								<li>
									<div>
										<?php echo $this->Html->image($path."exit.png")?>
										<?php echo $this->Html->link("Archive this Match", "/matches/archive/".$view_member["Member"]["id"])?>
									</div>
								</li>
							
						</ul>
					<?php }else{
						?>
						<p>You may now manage and upload your photos <?php echo $view_member["Member"]["firstname"]?> to get high chance of getting viewed.</p>
						<ul>
							<li>
								<div>
									<?php 
										echo $this->Html->link("Upload your photos", "/photos", array("class"=>"upload-button"));
										
									?>
								</div>
							</li>
						</ul>
						<?php 
						}?>
				</div>
			</div>
			
			<?php 
				if (!empty($sameInterests)){
			?>
			<div class="topic-opener panel">
				<h2>Topic Opener</h2>
				<div class="content">
					<dl>
						<dt>
							Like me, <?php echo $view_member["Member"]["firstname"]?> also......
						</dt>
						<dd>
						
							<ul>
							<?php 
								foreach($sameInterests as $interest){
									$count = 0;
									foreach($view_member["Interest"] as $member_interest){
										if ($interest==$member_interest["interest_type_id"]){
											$count++;
										}
									}
									$i=0;
									foreach($view_member["Interest"] as $member_interest){
										if ($interest==$member_interest["interest_type_id"]){
											if ($interest==1){
												$class="music";
												$message = "loves music";
											}else if ($interest==2){
												$class="movies";
												$message = "loves movies";
											}else if ($interest==3){
												$class="pets";
												$message = "loves pets";
											}else if ($interest==4){
												$class="books";
												$message = "loves reading books";
											}
											if ($i==0){
											?>
												<li id="<?php echo $class?>">
													<?php echo $message?>, 
													<?php 
														if ($count==1){
															echo "especially ".$member_interest["description"].".";
														}else{
															?>
															<dl>
																<dt>
																	<?php 
																		echo $pronoun_self_prop." favorite ".$class." includes:"
																	?>
																</dt>
																<dd>
																	<ul>
																		<li><?php echo $member_interest["description"]?></li>
															<?php 
														}
													
													?>
											
											<?php
											}else{
												if ($count!=0){
													?>
													<li><?php echo $member_interest["description"]?></li>
													<?php 
												}
											?>
											<?php 
											
											}
											$i++;
										}
									}
									if ($count!=0){
										?>
												</ul>
											</dd>
										</dl>
										<?php 						
									}
									?>
									</li>
									<?php 
								}			
							?>
							</ul>
						
							
						</dd>
					</dl>
				</div>
			</div>			
			<?php }?>
			
		</div>
	</div>
</div>
<?php echo $this->element("blue/members/general/composer")?>
<?php echo $this->element("blue/members/general/wink", array("member"=>$view_member))?>
<?php echo $this->element("blue/members/general/message_result")?>
<div id="icebreaker">
	
</div>