<?php 
$this->Paginator->options(array(
    'update' => '#my_matches',
    'evalScripts' => true
));
?>

<div id="my_matches" class="span-15 last">
	<?php 
		echo $this->element("members/matches/load_match", array("matches"=>$matches));
	 
	?>
</div>
<div class="span-15 last ralign">
	<?php 
		echo $this->Ajax->link("View More Matches", array("controller"=>"matches", "action"=>"index"), array("update"=>"updatable_div", "indicator"=>"indicator_1"));
	?>
</div>