<?php
	echo $this->element("matches/search_bar")
?>
<div>
	<p>
		<?php echo $this->Ajax->link("Daily", "/matches/daily_matches_paginate", array("update"=>"matches", "before"=>"updateSK('daily')"))?>
		<?php echo $this->Ajax->link("Top", "/matches/top_matches", array("update"=>"matches", "before"=>"updateSK('top')"))?>
	</p>
</div>

<div id="matches">

</div>