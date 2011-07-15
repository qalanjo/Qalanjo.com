<?php 
            		foreach($members as $member){
            			?>
            			<div class="search-results-image left">
            				<?php 
			                	if (isset($member["MemberProfile"]["picture_path"])||($member["MemberProfile"]["picture_path"]!="")){
									echo $this->Html->image("uploads/".$member["Member"]["id"]."/default/profile_thumb_".$member["MemberProfile"]["picture_path"], array("url"=>"/members/profile/".$member["Member"]["id"], "class"=>"image-border"));
								}else{
									if ($member["Gender"]["value"]=="Man"){
										echo $this->Html->image($path."default.jpg", array("url"=>"/members/profile/".$member["Member"]["id"]));
									}else{
										echo $this->Html->image($path."woman-default-picture.jpg", array("url"=>"/members/profile/".$member["Member"]["id"]));
									}
								}
			
                			?>
                </div>	
                <div class="search-results-name-box left">
                    <div class="icon right">
                        <a class="messenger" id="member_<?php echo $member["Member"]["id"]?>" href="#">
                        <?php 
                        	echo $this->Html->image("/css/img/blue/search/mail-icon.png", array("class"=>"left mail-icon"))
                        ?>
                        </a>
                        <a class="winker" id="wink_<?php echo $member["Member"]["id"]?>" href="#">
                        <?php 
                        	echo $this->Html->image("/css/img/blue/search/smile-icon.png", array("class"=>"left smile-icon"))
                        ?>
                        </a>
                    </div>
                    <div class="blue-green-rule">
                    </div>
                    <div class="dark-blue-rule">
                    </div>
                    <div class="search-results-name">
                        <h1><?php echo $member["Member"]["firstname"]." ".$member["Member"]["lastname"]?></h1>
                    </div>
                    <div class="blue-green-rule">
                    </div>
                    <div class="dark-blue-rule">
                    </div>
                    <p class="search-results-info">
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
                        <br/>
                        <?php 
                        	echo $member["Country"]["name"];
                        ?> 
                        <br/>
                        Seeking - <?php 
                        	if ($member["Member"]["looking_for_id"]==1){
                        		echo "Men";
                        	}else{
                        		echo "Women";	
                        	} 		
                        
                        ?> 
                        <?php 
                        	if (isset($member["MemberSetting"]["age_from"])){
                        		echo $member["MemberSetting"]["age_from"]." to ".$member["MemberSetting"]["age_to"];
                        	}
                        ?>
                    </p>
                </div>
                <div class="clear">
                </div>
                <div class="percentage left">
                   
                </div>
                <div class="active right">
                    <?php 
                    	if ($member["Member"]["online"]){
                    		echo "<span class='online'>";
                    		if ($member["Member"]["gender_id"]==1){
                    			echo "He is online";
                    		}else{
                    			echo "She is online";	
                    		}
                    		echo "</span>";
                    	}else{
                    		echo "<span class='active'>";
                    		echo "Active last ".$this->Time->timeAgoInWords($member["Member"]["modified"]);
                    		echo "</span>";
                    	}
                    ?>
		                </div>	
            			<?php 
            		}
            	?>