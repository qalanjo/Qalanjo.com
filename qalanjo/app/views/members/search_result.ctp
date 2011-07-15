<?php 
	$this->Html->css("blue/searchresult", "stylesheet", array("inline"=>false));
?>
<div class="content-container">
    <div class="settings-container left">
        <div class="header">
            <h1>Search Results</h1>
        </div>
        <div class="left-container left">
            <div class="left-container-text left">
                <label class="left">
                    Sort by: 
                </label>
                <select class="select142 left">
                    <option></option>
                    <option></option>
                </select>
                <button class="left go-btn">
                	
                </button>
                
            </div>
            <div class="left-container-text right">
                <label class="page left">
                    Showing 
                    Page 1 of 1 
                </label>
                <span class="left"><a href="#" class="textlink-space">Previous</a></span>
                <span class="left"><a href="#" class="textlink">Next</a></span>
            </div>
            <div class="left-container-box left">
            	<?php 
            		if (isset($members)){
            		echo $this->element("blue/members/search/search-result");
            		}
            	?>            
            </div>
            
            <div class="left-container-text left">
                <label class="left">
                    Display: 
                </label>
                <select class="select203 left">
                	<option value="10">10 Matches per page</option>
					<option value="20">20 Matches per page</option>
					<option value="30">30 Matches per page</option>
					<option value="40">40 Matches per page</option>
                </select>
            </div>
            <div class="left-container-text right">
                <label class="page left">
                    Showing 
                    Page 1 of 1 
                </label>
                <span class="left"><a href="#" class="textlink-space">Previous</a></span>
                <span class="left"><a href="#" class="textlink">Next</a></span>
            </div>
            <div class="clear">
            </div>
        </div>
        <div class="right">
	        <div class="right-container left">
	            <div class="magnifier-small ">
	            </div>
	            <div class="blue-rule">
	            </div>
	            <h2>Refine Your Search</h2>
	             <?php 
	             	echo $this->Form->create("Member", array("url"=>"/members/search_result", "id"=>"search-form"));
                 ?>
	            <div class="bottom-container-box left">
	                <div class="right-container-box left">
	                    <div class="form-box-width-1 left">
	                        <label class="left">
	                            I am a 
	                        </label>
	                      	<span class="left clear">
                                <strong>
                                	<?php 
                                		echo $user["Gender"]["value"];
                                	?>
                                </strong>	
                            </span>
	                    </div>
	                    <div class="form-box-width-2 left">
	                        <label class="left">
	                            Seeking 
	                        </label>
	                       <span class="left clear">
                               <strong>
	                               <?php 
	                               		if ($user["Member"]["looking_for_id"]==1){
	                               			echo "Men";
	                               		}else{
	                               			echo "Women";
	                               		}
                                	?>
                               </strong>
                           </span>
	                    </div>
	                    <div class="divider">
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
                                echo $this->Form->input("Member.age_from", array("type"=>"select", "div"=>false, "label"=>false, "options"=>$options,"selected"=>null, "class"=>"select46 left"));	
                              ?>
	                        <label class="spacing left">
	                            and 
	                        </label>
	                        <?php 
	                        	echo $this->Form->input("Member.age_to", array("type"=>"select", "div"=>false, "label"=>false, "options"=>$options,"selected"=>null, "class"=>"select46 left"));
	                        ?>
	                    </div>
	                    <div class="divider">
	                    </div>
	                    <div class="form-box-width-1 left">
	                        <label class="left">
	                            Located within 
	                        </label>
	                        <?php 
	                        	echo $this->Form->input("Member.distance_id", array("type"=>"select", "options"=>$distances, "div"=>false, "label"=>false, "class"=>"select203 left"));
                             ?>
	                    </div>
	                    
	                </div>
	                <div class="right-container-box-gray left">
	                    <div class="form-box-width-1 left">
	                        <label class="left">
	                            Country 
	                        </label>
	                        <?php 
	                        	echo $this->Form->input("Member.country_id", array("type"=>"select", "options"=>$countries, "div"=>false, "label"=>false, "class"=>"select203 left"));
                            ?>
	                    </div>
	                    <div class="divider">
	                    </div>
	                    <div class="form-box-width-1 left">
	                        <label class="left">
	                            State/Province 
	                        </label>
	                        <?php 
	                        	echo $this->Form->input("Member.state", array("type"=>"select", "options"=>$states, "div"=>false, "label"=>false, "class"=>"select203 left"));
                            ?>
	                    </div>
	                    <div class="divider">
	                    </div>
	                    <div class="form-box-width-1 left">
	                        <?php 
	                                    	echo $this->Form->input("online_now", array("type"=>"checkbox", "div"=>false, "label"=>false));
                             ?>
                              <label>
                                  Online Now
                              </label>
	                    </div>
	                    
	                    <p class="right">
	                        <span class="button right">
	                            <button type="submit">
	                                <span>Search</span>
	                            </button>
	                        </span>
	                    </p>
	                </div>
	            </div>
	            <?php 
	            	echo $this->Form->end();
	            ?>
	        </div>
	        <div class="right-container-advice left clear">
	            <h3>Communication Advice</h3>
	            <div class="ads-section-box left">
	                <h4>Ads 1</h4>
	                
	                 <?php 
	               		echo $this->Html->image("/css/img/blue/search/ad-image-small.gif", array("class"=>"left", "alt"=>""));	               		
	               	?><span class="ads-description">Description of goes here, text text text and
	                    more text text text text more and more more more text her text text text
	                    text text asdfasdfafdasfasfasfasfa. Description of goes here, text text
	                    text and.</span>
	                <div class="gray-rule-border">
	                </div>
	            </div>
	            <div class="ads-section-box left">
	                <h4>Ads 1</h4>
	                 <?php 
	               		echo $this->Html->image("/css/img/blue/search/ad-image-small.gif", array("class"=>"left", "alt"=>""));	               		
	               	?><span class="ads-description">Description of goes here, text text text and
	                    more text text text text more and more more more text her text text text
	                    text text asdfasdfafdasfasfasfasfa. Description of goes here, text text
	                    text and.</span>
	                <div class="gray-rule-border">
	                </div>
	            </div>
	            <div class="ads-section-box left">
	                <h4>Ads 1</h4>
	                 <?php 
	               		echo $this->Html->image("/css/img/blue/search/ad-image-small.gif", array("class"=>"left", "alt"=>""));	               		
	               	?><span class="ads-description">Description of goes here, text text text and
	                    more text text text text more and more more more text her text text text
	                    text text asdfasdfafdasfasfasfasfa. Description of goes here, text text
	                    text and.</span>
	                <div class="gray-rule-border">
	                </div>
	            </div>
	        </div>
        </div>
    </div>
</div>
