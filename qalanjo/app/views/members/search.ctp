<?php 
	$this->Html->css("blue/search", "stylesheet", array("inline"=>false));
?>
<div class="content-container">
	<div class="settings-container left">
	    <div class="header">
	        <h1>Search your match</h1>
	        <p>
	            Communicate and see photos.
	        </p>
	    </div>
	    <div class="left-container left">
	        <div class="blue-rule">
	        </div>
	        <div class="left-container-box left">
	            <div class="bottom-container-box left">
	                <div class="left-container-text left">
	                    <h2>Start a quick search...</h2>
	                    <p>
	                        Add or change your criteria, or search different locations.
	                    </p>
	                </div>
	                <div class="form-box left">
	                    <?php 
	                    	echo $this->Form->create("Member", array("url"=>"/members/search_result"));
	                    ?>
	                        <fieldset>
	                            <div class="magnifier">
	                            </div>
	                            <div class="form-box-width-1 left">
	                                <label class="left">
	                                    I am a
	                                </label>
	                                <br/>
	                                <span class="left">
	                                	<strong>
	                                	<?php 
	                                		echo $this->data["Gender"]["value"];
	                                	?>
	                                	</strong>	
	                                </span>
	                                
	                            </div>
	                            <div class="form-box-width-2 left">
	                                <label class="left">
	                                    Seeking
	                                </label>
	                                <br/>
	                                <span class="left">
		                               <strong>
			                               <?php 
			                               		if ($this->data["Member"]["looking_for_id"]==1){
			                               			echo "Men";
			                               		}else{
			                               			echo "Women";
			                               		}
		                                	?>
		                               </strong>
		                                
	                                </span>
	                               
	                            </div>
	                            <div class="left">
	                                <label class="left">
	                                    Between ages
	                                </label>
	                                <br/>
	                                <?php 
	                                	$options = array();
	                                	for($i=18;$i<=60;$i++){
	                                		$options[] = $i;
	                                	}
	                                	echo $this->Form->input("Member.age_from", array("type"=>"select", "div"=>false, "label"=>false, "options"=>$options,"selected"=>null, "class"=>"select45 left"));
	                                	
	                                ?>
	                                
	                                <label class="spacing left">
	                                    and
	                                </label>
	                                
	                                <?php 
	                                	
	                                	echo $this->Form->input("Member.age_to", array("type"=>"select", "div"=>false, "label"=>false, "options"=>$options,"selected"=>"60", "class"=>"select45 left"));
	                                	
	                                ?>
	                                
	                            </div>
	                            <div class="divider">
	                                <div class="left">
	                                    <label class="left">
	                                        Located within
	                                    </label>
	                                    <br/>
	                                    <?php 
	                                    	echo $this->Form->input("Member.distance_id", array("type"=>"select", "options"=>$distances, "div"=>false, "label"=>false, "class"=>"select203 left"));
	                                    ?>
	                                    <label class="spacing left">
	                                        of
	                                    </label>
	                                </div>
	                                <div class="form-box-width-3 left">
	                                    <label class="left">
	                                        Country
	                                    </label>
	                                    <br/>
	                                    <?php 
	                                    	echo $this->Form->input("Member.country_id", array("type"=>"select", "options"=>$countries, "div"=>false, "label"=>false, "class"=>"select203 left"));
	                                    ?>
	                                </div>
	                                <div class="form-box-width-4 left">
	                                    <label class="left">
	                                        State
	                                    </label>
	                                    <br/>
	                                    <?php 
	                                    	echo $this->Form->input("Member.state", array("type"=>"select", "options"=>$states, "div"=>false, "label"=>false, "class"=>"select203 left"));
	                                    ?>
	                                </div>
	                                <div class="left">
	                                    <?php 
	                                    	echo $this->Form->input("online_now", array("type"=>"checkbox", "div"=>false, "label"=>false));
	                                    ?>
	                                    <label>
	                                        Online Now
	                                    </label>
	                                </div>
	                                <div class="clear">
	                                </div>
	                                <?php /*?>
	                                <div class="left">
	                                    <input type="checkbox" id="photos_only" name="photos_only" class="left" />
	                                    <label>
	                                        Photos Only
	                                    </label>
	                                </div>
	                                <div class="clear">
	                                </div>
	                                */?>
	                            </div>
	                            <p class="left">
	                                <span class="button left">
	                                    <button type="submit">
	                                        <span>Search</span>
	                                    </button>
	                                </span>
	                            </p>
	                        </fieldset>
	                    <?php echo $this->Form->end();?>
	                </div>
	            </div>
	            <div class="clear">
	            </div>
	        </div>
	    </div>
	    <div class="right-container left">
	        <h3>Newest Qalanjo Members</h3>
	        <div class="newest-match-member-list left">
                <ul class="left">
                	<?php 
                		foreach($new_members as $member){
                			?>
                			<li>
                				<?php 
				                	if (isset($member["MemberProfile"]["picture_path"])||($member["MemberProfile"]["picture_path"]!="")){
										echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"left"));
									}else{
										if ($member["Gender"]["value"]=="Man"){
											echo $this->Html->image($path."default.jpg", array("url"=>"/members/profile/".$member["Member"]["id"]));
										}else{
											echo $this->Html->image($path."woman-default-picture.jpg", array("url"=>"/members/profile/".$member["Member"]["id"]));
										}
									}
				
                				?>
                				<div class="newest-member-profile left">
                        			<p>
                        				 <span class="newest-member-name"><?php echo $this->Html->link($member["Member"]["firstname"]." ".$member["Member"]["lastname"], "/profile/".$member["Member"]["id"])?></span>
                        				 <br/>
                        				<?php 
                        					echo $this->requestAction("/member_profiles/getAgeV2/".$member["Member"]["id"]);
                        				?> years old
                        				 <br/>
                        				 <?php 
                        				 	if ($member["Member"]["city"]!=""){
                        				 		echo $member["Member"]["city"].", ".$member["Member"]["state"].", ".$member["Country"]["country_code"];
                        				 	}else{
                        				 		echo $member["Member"]["state"].", ".$member["Country"]["country_code"]; 	
                        				 	}
                        				 ?>
                        			</p>
                        		</div>
                			</li>
                			<div class="gray-rule">
		                    </div>
                			<?php 
                		}
                	?>
                </ul>
                <p class="right">
                    <a href="#" class="textlink">see more...</a>
                </p>
	        </div>
	    </div>
	    <div class="clear">
	    </div>
	    <div class="ads-section-box left">
	        <div class="ads-wrapper">
	            <div class="ads-section-box-col1 left">
	                <h4>Ads title goes here...........</h4>
	               	<?php 
	               		echo $this->Html->image("/css/img/blue/search/ad-image-small.gif", array("class"=>"left", "alt"=>""));	               		
	               	?>
	               	<span class="ads-description"> Description of goes here, text text text and
	                    more text text text text more and more more more text her text text text
	                    text text asdfasdfafdasfasfasfasfa. Description of goes here, text text 
	                    text and. </span>
	                <div class="clear">
	                </div>
	                <p class="right">
	                    <a href="#" class="textlink r">read more...</a>
	                </p>
	            </div>
	            <div class="ads-section-box-col2 left">
	                <h4>Ads title goes here...........</h4>
	                <?php 
	               		echo $this->Html->image("/css/img/blue/search/ad-image-small.gif", array("class"=>"left", "alt"=>""));	               		
	               	?>
	                <span class="ads-description"> Description of goes here, text text text and
	                    more text text text text more and more more more text her text text text
	                    text text asdfasdfafdasfasfasfasfa. Description of goes here, text text 
	                    text and. </span>
	                <div class="clear">
	                </div>
	                <p class="right">
	                    <a href="#" class="textlink r">read more...</a>
	                </p>
	            </div>
	            <div class="ads-section-box-col3 left">
	                <h4>Ads title goes here...........</h4>
	                <?php 
	               		echo $this->Html->image("/css/img/blue/search/ad-image-small.gif", array("class"=>"left", "alt"=>""));	               		
	               	?>
	                <span class="ads-description"> Description of goes here, text text text and
	                    more text text text text more and more more more text her text text text
	                    text text asdfasdfafdasfasfasfasfa. Description of goes here, text text 
	                    text and. </span>
	                <div class="clear">
	                </div>
	                <p class="right">
	                    <a href="#" class="textlink r">read more...</a>
	                </p>
	            </div>
	            <div class="clear">
	            </div>
	        </div>
	    </div>
	    <div class="clear">
	    </div>
	</div>
</div>