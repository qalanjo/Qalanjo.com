<div class="left" id="content_header">
<?php 
	$path = "designs/blue/members/profile_completion/page14/";
?>
								<h2>Express Yourself cont'</h2>
							</div>
							<div class="left" id="content_main">
								<p class="instruction">Answer the questions briefly.</p>
                                <p class="image_set_top right">
                                
                                	<?php 
									echo $this->Html->image($path."woman1.jpg", array("class"=>"right", "alt"=>"Woman"));
								?>
                                </p>
								<div class="left" id="profile_completion_box">                                	
                                                                                                      
                                    <p>
                                        Tell something briefly about what you are passionate about.
                                    </p>                                    
                                    <p>
                                    	<?php 
                                    		echo $this->Form->input("MemberProfile.passionate_about", array("rows"=>50, "cols"=>5, "div"=>false, "label"=>false));
                                    		
                                    	
                                    	?>
                                    </p>
                                    <p>
                                        Tell something briefly about what you were looking for a match.
                                    </p>                                    
                                    <p>
                                    	<?php 
                                    		echo $this->Form->input("MemberProfile.looking_for_details", array("rows"=>50, "cols"=>5, "div"=>false, "label"=>false));
                                    		
                                    	
                                    	?>
                                    </p>        
                                     <p>
                                        Tell something briefly that you want to say to your match.
                                    </p>                                    
                                    <p>
                                    	<?php 
                                    		echo $this->Form->input("MemberProfile.match_want", array("rows"=>50, "cols"=>5, "div"=>false, "label"=>false));
                                    		
                                    	
                                    	?>
                                    </p>                                                                         
                                </div>
                                
                                <p class="image_set_bottom left">
                                	<span class="button left">
                                    	<button type="submit"><span>Save and Continue</span></button>
                                    </span>
	</p>
</div>