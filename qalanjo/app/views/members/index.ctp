<?php 
	$this->Html->css("blue/member-homepage-style", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/ui-dialog", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/icebreaker", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/wink", "stylesheet", array("inline"=>false));
	$this->Html->css("blue/gift-box", "stylesheet", array("inline"=>false));
	
	$this->Javascript->link(array("blue/members/profile_functions", "blue/members/index"), false);
	$path = "/css/img/blue/index/";
?>
<div class="content-container">
	<div class="settings-container left">
		<div class="subscribe-banner left">
			
			<?php
				if ($role==2){ 
					echo $this->Html->image($path."encourage.png", array("alt"=>"Subscribe", "class"=>"left", "url"=>"/subscribe"));
				}
			?>
		</div>
		<div class="left-container left clear">
			<div class="profile-pic left">
				<?php 
					if (isset($member["MemberProfile"]["picture_path"])||($member["MemberProfile"]["picture_path"]!="")){
						echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$member["Member"]["id"]));
					}else{
						if ($member["Gender"]["value"]=="Man"){
							echo $this->Html->image($path."s-men.jpg", array("url"=>"/members/profile/".$member["Member"]["id"]));
						}else{
							echo $this->Html->image($path."s-women.jpg", array("url"=>"/members/profile/".$member["Member"]["id"]));
						}
					}
				?>
				<?php /*?>
				<img src="img/index/silhouette-boy.png" alt="Profile Picure"/>
				*/?>
			</div>
			<div class="profile-info left">
				<h1 class="left"><?php echo $member["Member"]["firstname"]." ".$member["Member"]["lastname"]?></h1>
				<span class="location left clear">
				<?php 
					if ($member["Member"]["city"]==""){
						echo $member["Member"]["state"];
					}else{
						echo $member["Member"]["city"].", ".$member["Member"]["state"];
					}
				
				?></span>
				<div class="left controls-vertical clear">
					<ul class="controls-vertical left">
						<li class="left">
							<?php 
								$img = $this->Html->image($path."edit.gif", array("alt"=>"edit", "class"=>"left"));
								echo $this->Html->link("{$img}<span class=\"left\">Edit Profile</span>", array("controller"=>"Members", "action"=>"edit"), array("escape"=>false));
							?>
						</li>						
					</ul>
				</div>
			</div>
			<div class="profile-controls left clear">
				<ul class="controls left">
					<li class="left">
						<span class="count left">
						<?php 
							echo $this->Html->link("<span class='left' id='inbox-count'>(0)</span><span class=\"left\">Inbox</span>", "/inbox", array("escape"=>false));
						?>
						</span> 
						
					</li>
					<li class="left clear">
						<span class="count left">
						<?php 
							echo $this->Html->link("(0)", "/photos", array("id"=>"photos-count"));
						?>
						</span> <span class="left">Photos</span> <span class="left upload">
							<?php 
								echo $this->Html->link("+ upload", "/photos/upload");
							?>
						</span>
					</li>
				</ul>
			</div>
			<h2 class="clear match-header">
				<span class="matches-header-content clear left">My matches - <span class="matches-header-content-colored">shout out</span></span>
			</h2>
			<div class="clear left match-content-list">
				<?php echo $this->Form->create("Match", array("url"=>"/member_profiles/shout", "id"=>"shoutbox"))?>
					<ul class="left">
						<?php 
						if (isset($loadMatches)){
						foreach($loadMatches as $match){?>
							<li class="left clear">
								<div class="left">
									<?php 
										if (isset($match["Matched"]["MemberProfile"]["picture_path"])||($match["Matched"]["MemberProfile"]["picture_path"]!="")){
											echo $this->Html->image("uploads/".$match["Matched"]["id"]."/default/profile_thumb_".$match["Matched"]["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$match["Matched"]["id"]));
										}else{
											if ($match["Matched"]["gender_id"]==1){
												echo $this->Html->image($path."s-men.jpg", array("url"=>"/members/profile/".$match["Matched"]["id"]));
											}else{
												echo $this->Html->image($path."s-women.jpg", array("url"=>"/members/profile/".$match["Matched"]["id"]));
											}
										}
									?>
								</div>
								<div class="profile-info left">
									<span class="name">
										<?php echo $match["Matched"]["firstname"]." ".$match["Matched"]["lastname"]?>
									</span>
									<?php if ($match["Matched"]["age"]!=""){?>
										<br/>
										<span class="age">
											<?php 
												echo $match["Matched"]["age"]." years old";
											?>
										</span>
									<?php }?>
									<br/>
									<span class="location">
										<?php 
											if ($match["Matched"]["state"]==""){
												echo $match["Matched"]["Country"]["name"];
											}else{
												echo $match["Matched"]["state"].", ".$match["Matched"]["Country"]["name"];
											}
										?>
									</span>
								</div>
								<div class="left clear">
									<p>
										<?php echo $match["Matched"]["MemberProfile"]["status"]?>
									</p>
								</div>
							</li>
						<?php }
						}?>
						<li class="shout-box">
							<dl class="left">
								<dt class="left">
									What's up?
								</dt>
								<dd class="clear">
									<?php 
										echo $this->Form->input("MemberProfile.status", array("value"=>"", "class"=>"shouter left", "id"=>"shouter","rows"=>10, "cols"=>10, "div"=>false, "label"=>false));
										echo $this->Form->input("MemberProfile.id", array("value"=>$member["MemberProfile"]["id"], "type"=>"hidden"));	
									?>
									
								</dd>
							</dl>
						</li>
						<li class="submit">
							<button type="submit" class="right post-button"></button><label class="shout_required"></label>
						</li>
					</ul>
					<?php echo $this->Form->end();?>
			</div>
	
			<div class="match-list-shadow left clear">	
			</div>
			
			<h2 class="clear match-header com-advice-header">
				<span class="matches-header-content clear left">Communication Advice</span>
			</h2>
			<div class="clear left match-content-list advice-content-list">
					<ul>
						<li>
							<?php 
								echo $this->Html->image("/css/img/blue/index/hand.jpg", array("class"=>"left"));
							?>
							<h5 class="left">
								First Date Blunders
							</h5>	
							<div class="left content">
								<p class="left">
									Everyone is guilty of first date blunders! Here are some of the most common dating mistakes - and how to make the best out of a bad situation
								</p>	
							</div>
							<div class="left shadow">
							</div>
						</li>
						<li>
							<?php 
								echo $this->Html->image("/css/img/blue/index/somali.jpg", array("class"=>"left"));
							?>
							<h5 class="left">
								The Power of a Compliment
							</h5>
							<div class="left">
								<p class="left">
									It seems so simple and yet is often overlooked: a genuine compliment offered at the right time, in the right way, can help a budding relationship soar to new heights.
								</p>		
							</div>
							<div class="left shadow">
							</div>
						</li>
					</ul>
			</div>
			
		</div>
		<div class="right-container left">
			<div class="activity">
				<h2 class="left">
					<span class="left">Activity</span>
					<button id="activity-group-button" class="activity-group-button left"></button>
					<?php /*?>
					<button id="activity-list-button" class="activity-list-button left"></button>
					*/?>
				</h2>
				<div class="right date">
					<?php echo date("l, F d, Y h:m A")?>
				</div>
				<div class="left clear activity-controls">
					<div class="right">
						<span class="left filter-by"><strong>Filter by:</strong></span>							
						<div class="left">
							<button id="activity-communication-button" class="header-button">
								<span>
									<?php 
										echo $this->Html->image($path."communication-icon.png", array("class"=>"left", "alt"=>""))									
									?>
									<span id="activity-communication-count" class="left">(0)</span>
								</span>
							</button>
							<button id="activity-gift-button" class="header-button">
								<span class="left">
									<?php 
										echo $this->Html->image($path."gift-icon.png", array("class"=>"left", "alt"=>""))									
									?>
									<span id="activity-gift-count" class="left">(0)</span>
								</span>
							</button>
							<?php /*?>
							<button id="activity-profile-update-button" class="header-button">
								<span class="left">
									<?php 
										echo $this->Html->image($path."profile-icon.png", array("class"=>"left", "alt"=>""))									
									?>
									<span id="activity-profile-update-count" class="left">(0)</span>
								</span>
							</button>
							*/?>
							<?php /*?>
							<button id="activity-photos-update-button" class="header-button">
								<span class="left">
									<?php 
										echo $this->Html->image($path."photo-icon.png", array("class"=>"left", "alt"=>""))									
									?>
									<span id="activity-photo-count" class="left">(0)</span>
								</span>
							</button>
							*/?>
							<button id="activity-who-viewed-me-button" class="header-button">
								<span class="left">
									<?php 
										echo $this->Html->image($path."lens-icon.png", array("class"=>"left", "alt"=>""))									
									?>
									<span id="activity-wvme-count" class="left">(0)</span>
								</span>
							</button>
							
						</div>		
					</div>
				</div>
				
				<div class="left clear match-list">
					<div class="left q">
						<?php 
							echo $this->Html->image($path."q.png", array("class"=>"left", "alt"=>"Qpoints"))									
						?>
					</div>
					<div class="left q-name">
						<?php echo $member["Member"]["firstname"]?>, you have <?php echo $this->Html->link("", "/matches", array("id"=>"match_count"))?>
					</div>
					<div class="left viewer">
						<?php 
							echo $this->Html->link(" ", "/matches", array("class"=>"view"));
						?>
					</div>
				</div>
				
				<div id="activity-content">
					
					<!-- Communication -->
					<div class="left activity-content-block" id="communications-items">
						<div class="edge-left left"></div>
						<div class="edge-right right"></div>
						<h3 class="left">
							<?php 
								echo $this->Html->image($path."communication.png", array("class"=>"communication-icon left", "alt"=>""))									
							?>
							<span class="left">Communication</span>
						</h3>
						<div class="activity-block left" id="communication_accordion_item">
							
						</div>
						
					</div>
					
					<!-- Gifts -->
					<div class="left activity-content-block" id="gift-items">
						<div class="edge-left left"></div>
						<div class="edge-right right"></div>
						<h3 class="left">
							<?php 
								echo $this->Html->image($path."gift.png", array("class"=>"communication-icon left", "alt"=>""))									
							?>
							<span class="left">Gifts</span>
						</h3>
						<div class="activity-block left" id="gift_accordion_item">
							
						</div>
						
					</div>
					<?php /*?>
					<!-- Profile -->
					<div class="left activity-content-block" id="communications-items">
						<div class="edge-left left"></div>
						<div class="edge-right right"></div>
						<h3 class="left">
							<?php 
								echo $this->Html->image($path."profile.png", array("class"=>"communication-icon left", "alt"=>""))									
							?>
							<span class="left">Profile Updates</span>
						</h3>
						<div class="activity-block left" id="profile_accordion_item">
						
						</div>
						
					</div>
					*/?>
					<!-- Photos -->
					<div class="left activity-content-block" id="communications-items">
						<div class="edge-left left"></div>
						<div class="edge-right right"></div>
						<h3 class="left">
							<?php 
								echo $this->Html->image($path."photo.png", array("class"=>"communication-icon left", "alt"=>""))									
							?>
							<span class="left">Photos Updates</span>
						</h3>
						<div class="activity-block left" id="photo_accordion_item"></div>
						
					</div>
					
					<!-- Who Viewed Me -->
					<div class="left activity-content-block" id="wvme-items">
						<div class="edge-left left"></div>
						<div class="edge-right right"></div>
						<h3 class="left">
							<?php 
								echo $this->Html->image($path."lens.png", array("class"=>"communication-icon left", "alt"=>""))									
							?>
							<span class="left">Who Viewed Me?</span>
						</h3>
						<div class="activity-block left" id="whoviewed_accordion_item">
							
						</div>
						
					</div>
				</div>
				
					
			</div>
		</div>
	</div>
</div>
<div id="wink" class="wink-result">
	<div class="wink-question">
		<div class="right breaker-result">
			<h2>
				Do you want to wink at <br/><strong id="wink_name"><?php 
					echo $member["Member"]["firstname"]
				?></strong> ?
			</h2>
		</div>
	</div>
</div>
<div id="message_result"></div>
<div id="gift-box"></div>
<div id="shoutbox-result"></div>