<ul>
	<li class="active" id="profile">
  		<?php echo $this->Ajax->link("PROFILE", array("controller"=>"members", "action"=>"home"), array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Notifications", array("controller"=>"notifications", "action"=>"quick"), array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>
	
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Daily Matches", array("controller"=>"members", "action"=>"viewer"), array("update"=>"updatable_div"))?>
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Who viewed me", array("controller"=>"view_activities", "action"=>"index", "full"), array("update"=>"updatable_div", "class"=>"navigation_left"))?>
	</li>
			
    <li id="photos">
    	<?php echo $this->Html->link("PHOTOS", array("controller"=>"photos", "action"=>"index"))?>
	</li>       
	<li id="inbox">
		<?php echo $this->Ajax->link("INBOX", array("controller"=>"receive_messages", "action"=>"inbox", $member["Member"]["id"]), array("update"=>"updatable_div", "class"=>"navigation_left"))?> 	
  	</li>
  	<li class="inner_nav">
		<?php echo $this->Ajax->link("Messages", array("controller"=>"receive_messages", "action"=>"inbox", $member["Member"]["id"]), array("update"=>"updatable_div", "class"=>"navigation_left"))?>			
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Winks", array("controller"=>"receive_messages", "action"=>"inbox", $member["Member"]["id"]), array("update"=>"updatable_div", "class"=>"navigation_left"))?>					
	</li>
	<li class="inner_nav">
		<?php echo $this->Ajax->link("Gifts", array("controller"=>"receive_messages", "action"=>"inbox", $member["Member"]["id"]), array("update"=>"updatable_div", "class"=>"navigation_left"))?>			
	</li>	
  	<li id="action">
  		<?php echo $this->Html->link("ACTION", array("controller"=>"messages", "action"=>"inbox"))?>	
	<li class="inner_nav">
		<?php echo $this->Html->link("Qalanjo Gifts", array("controller"=>"gifts", "action"=>"index"), array("class"=>"navigation_left"))?>			
	</li>	
</ul>

<?php /*?>
<div id="tour_qalanjo" class="calign">
<?php
  		$image = $this->Html->image("designs/member/profile/tour-qalanjo.png");
  		echo $this->Html->link($image, array("action"=>"index", "controller"=>"gifts"), array("escape"=>false));
?>
</div>

<div id="explore_profile" class="calign">
<?php
  		$image = $this->Html->image("designs/member/profile/explore-profile.png");
  		echo $this->Html->link($image, array("action"=>"index", "controller"=>"gifts"), array("escape"=>false));
?>
</div>

<div id="gift-sale" class="calign">
<?php
	$image = $this->Html->image("designs/member/profile/gift.png");
	echo $this->Html->link($image, array("action"=>"index", "controller"=>"gifts"), array("escape"=>false));
?>
</div>
*/
?>