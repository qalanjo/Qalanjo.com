<h1>Avail for QPoints</h1>
<p class="instruction">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
<?php /*
<div id="coin_avail" class="span-14 form">
	<?php 	
	echo $this->Form->create("CoinAvailTransaction", array("url"=>"/coin_avail_transactions/avail"));
	?>
	<label class="span-2">Quantity </label>
	<?php 
	echo "<div class='span-12 last'>";
		echo $this->Form->input("CoinAvailTransaction.coins", array("div"=>false, "label"=>false, "id"=>"quantity"));
	echo "</div>";
	?>
	<label class="span-2">Rate </label>
	<?php 
	echo "<div class='span-12 last'>";
		echo "0.2 dollars";
	echo "</div>";
	?>
	<label class="span-2">Total Amount </label>
	<?php 
	echo "<div class='span-12 last' id='total'>";
		echo " dollars";
	echo "</div>";
	echo $this->Form->input("member_id", array("value"=>$member["Member"]["id"], "type"=>"hidden"));
	echo $this->Form->submit("Save", array("div"=>"span-12"));			
	echo $this->Form->end();	
	?>		
</div>

*/ ?>

<div id="coin_packages" class="span-24 clear container">
	
	
	
	<?php 
		echo $this->Form->create("CoinAvailTransaction", array("url"=>"/coin_avail_transactions/avail"));
		
		$options = array();
		$out="";
		foreach($packages as $package){
			$out.= "<div class='span-7'>";
				$out.= "<input type=\"radio\" value=\"{$package["CoinPackage"]["id"]}\" name=\"data[CoinAvailTransaction][package]\"/>";
			$out.= "</div>";
		}
		echo $out;
		echo $this->Form->input("member_id", array("value"=>$member["Member"]["id"], "type"=>"hidden"));
		echo $this->Form->submit("Select", array("div"=>"span-12"));			
		echo $this->Form->end();
	
	?>

</div>
<?php echo $this->Javascript->link("custom/coins/avail")?>