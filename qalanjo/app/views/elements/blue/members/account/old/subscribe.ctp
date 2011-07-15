<?php if (!isset($subscription)){?>
<div class="left clear header-cat">
	<p><span class="left title">Subscription Status</span>
	<span class="right">* Required Fields</span></p>
</div>
<div id="subscribe-btn" class="save-subscribe-btn left clear">
	<span id="subs-button" class="left">
	<?php if ($role==2){?>
	<button id="subscribe">
		<span>Subscribe Now</span>
	</button>
	<?php }?>
	</span>
</div>
<?php }?>